<?php

use chriskacerguis\RestServer\RestController;


defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Cart_m $Cart_m
 * @property User_m $User_m
 * @property Session $session
 * @property Form_validation $form_validation
 * @property Configtoko_m $Configtoko_m
 * @property Input $input
 * @property Checkout_m $Checkout_m
 * @property Invoice_m $Invoice_m
 * @property Midtranspayment $midtranspayment
 * @property sendwhatsapp $sendwhatsapp
 * @property Db $db
 * @property pengiriman $pengiriman
 */

class Restshopcontroller extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_m');
        $this->load->model('User_m');
        $this->load->model('Configtoko_m');
        $this->load->model('Checkout_m');
        $this->load->model('Invoice_m');
        $this->load->library('midtranspayment');
        $this->load->library('sendwhatsapp');
        $this->load->library('pengiriman');
    }

    public function count_cart_get()
    {
        $query = $this->Cart_m->count_cart($this->session->userdata('user_id'));
        $this->response($query, RestController::HTTP_OK);
    }

    public function updateProfile_post()
    {
        $nama = $this->input->post('namalengkap', true);
        $wha = $this->input->post('nowhatsapp', true);
        $alamat = $this->input->post('alamat', true);
        $alamatpengiriman = $this->input->post('alamatpengiriman', true);

        $data = [
            'nama_lengkap' => $nama,
            'no_whatsapp' => $wha,
            'alamat' => $alamat,
            'alamat_pengiriman' => $alamatpengiriman
        ];

        $query = $this->User_m->update('user_id', $this->session->userdata('user_id'), $data);
        if ($query == true) {
            $msg = [
                'status' => 200,
                'message' => 'Berhasil mengupdate profil',
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Gagal mengupdate profil',
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function orderList_get()
    {
        $user_id = $this->session->userdata('user_id');
        $sql = "SELECT invoice_id, invoice_user_id, invoice_waybill, invoice_payment_method, invoice_expedition_code, invoice_midtrans_code FROM tbl_invoice WHERE invoice_user_id = '$user_id'";

        $query = $this->Invoice_m->query($sql)->result_array();
        if ($query) {
            $this->response($query, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Gagal mengambil data order',
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function delete_cart_post()
    {
        $id = $this->input->post('id', true);
        $query = $this->Cart_m->delete('cart_id', $id);
        if ($query) {
            $msg = [
                'status' => 200,
                'message' => 'Berhasil menghapus item keranjang',
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Gagal menghapus item keranjang',
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function cek_ongkir_post()
    {
        $origin = $this->Configtoko_m->findFirst('config_toko_id', '1');
        $data = [];
        $carts = $this->Cart_m->findFirst('cart_user_id', $this->session->userdata('user_id'));

        foreach ($carts as $cart) {
            $datas = [
                'name' => $cart['cart_product_name'],
                'description' => $cart['cart_product_variant'],
                'value' => $cart['cart_subtotal'] * $cart['cart_qty'],
                'weight' => $cart['cart_weight'] * $cart['cart_qty'],
                'quantity' => $cart['cart_qty'],
            ];
            array_push($data, $datas);
        }
        $val = json_encode($data);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.biteship.com/v1/rates/couriers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{ 
                "origin_area_id": "' . $origin['id_lokasi_toko'] . '",
                "destination_area_id":"' . user_login()['kode_kota_pengiriman'] . '",
                "couriers":"jne,j&t,sicepat,anteraja,tiki,pos,ninja,idexpress",
                "items": ' . $val . ' 
              }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $_ENV['BITESHIP_API_KEY'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $this->response($err, RestController::HTTP_INTERNAL_ERROR);
        } else {
            $this->response($response, RestController::HTTP_OK);
        }
    }

    public function add_to_cart_post()
    {
        $nama = $this->input->post('nama', true);
        $variant = $this->input->post('variant', true);
        $harga = $this->input->post('harga', true);
        $berat = $this->input->post('berat', true);
        $qty = $this->input->post('qty', true);
        $img = $this->input->post('img', true);
        $id_barang = $this->input->post('id_barang', true);
        $var = json_encode($variant);

        $data = [
            'cart_id' => generaterandomint(8),
            'cart_product_name' => $nama,
            'cart_product_id' => $id_barang,
            'cart_product_variant' => $var,
            'cart_qty' => $qty,
            'cart_weight' => $berat,
            'cart_subtotal' => $harga,
            'cart_user_id' => $this->session->userdata('user_id'),
            'cart_product_img' => $img
        ];
        $query = $this->Cart_m->create($data);
        if ($query == true) {
            $msg = [
                'status' => 200,
                'message' => 'Berhasil menambahkan produk ke keranjang'
            ];

            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Gagal menambahkan produk ke keranjang'
            ];

            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    private function __curl(string $url, string $method, string $req = null): mixed
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $req,
            CURLOPT_HTTPHEADER => array(
                "key: " . $_ENV["RAJAONGKIR_API_KEY"]
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
    public function get_province_get()
    {
        $query = $this->__curl('province', 'GET');
        $this->response($query, RestController::HTTP_OK);
    }

    public function get_city_get($id)
    {
        $query = $this->__curl('city?province=' . $id, 'GET');
        $this->response($query, RestController::HTTP_OK);
    }


    public function get_areas_get()
    {
        $url = urldecode($_GET['query']);

        $biteship = $this->pengiriman->get_areas($url);
        $this->response($biteship, RestController::HTTP_OK);
    }

    public function update_alamat_post()
    {
        $this->form_validation->set_rules('namapenerima', 'Nama Penerima', 'trim|required');
        $this->form_validation->set_rules('nowhatsapp', 'No. Whatsapp', 'trim|required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('numeric', '{field} harus angka');
        if ($this->form_validation->run() === FALSE) {
            $err = [
                'errors' => [
                    'namapenerima' => form_error('namapenerima'),
                    'nowhatsapp' => form_error('nowhatsapp'),
                    'alamat' => form_error('alamat'),
                ]
            ];
            $this->response($err, RestController::HTTP_NOT_ACCEPTABLE);
        } else {

            $city_id = $this->input->post('city_id', true);
            $alamat = $this->input->post('alamat', true);

            $data = [
                'alamat_pengiriman' => $alamat,
                'kode_kota_pengiriman' => $city_id
            ];
            $query = $this->User_m->update('user_id', $this->session->userdata('user_id'), $data);
            if ($query == true) {
                $msg = [
                    'status' => 200,
                    'message' => 'Berhasil menyimpan alamat pengiriman'
                ];

                $this->response($msg, RestController::HTTP_OK);
            } else {
                $msg = [
                    'status' => 500,
                    'message' => 'Gagal menyimpan alamat pengiriman'
                ];

                $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
            }
        }
    }

    public function update_qty_post()
    {
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        $check_qty = $this->Cart_m->findById($id);
        if ($type == 'add') {
            $data = [
                'cart_qty' => ($check_qty['cart_qty'] + 1)
            ];
            $query = $this->Cart_m->update('cart_id', $id, $data);
            if ($query == true) {
                $msg = [
                    'status' => 200,
                    'message' => 'Berhasil menambahkan jumlah qty item '
                ];
                $this->response($msg, RestController::HTTP_OK);
            } else {
                $msg = [
                    'status' => 500,
                    'message' => 'Gagal menambahkan jumlah qty item '
                ];
                $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
            }
        } else {
            $data = [
                'cart_qty' => $check_qty['cart_qty'] - 1
            ];
            $query = $this->Cart_m->update('cart_id', $id, $data);
            if ($query == true) {
                $msg = [
                    'status' => 200,
                    'message' => 'Berhasil mengurangi jumlah qty item '
                ];
                $this->response($msg, RestController::HTTP_OK);
            } else {
                $msg = [
                    'status' => 500,
                    'message' => 'Gagal mengurangi jumlah qty item '
                ];
                $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
            }
        }
    }

    public function create_order_post()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->form_validation->set_rules('detailnamapenerima', 'Nama Penerima', 'trim|required');
        $this->form_validation->set_rules('detailnowhatsapp', 'No. Whatsapp', 'trim|required');
        $this->form_validation->set_rules('detailkodepos', 'Kode Pos', 'trim|required|max_length[5]|min_length[5]');
        $this->form_validation->set_rules('detailemail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('detailalamat', 'Alamat Lengkap', 'trim|required');
        $this->form_validation->set_rules('detailcatatanalamat', 'Catatan Alamat', 'trim|required');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('valid_email', '{field} harus valid email');
        $this->form_validation->set_message('max_length', '{field} minimal {param} angka');
        $this->form_validation->set_message('min_length', '{field} minimal {param} angka');

        if ($this->form_validation->run() === FALSE) {
            $errors = [
                'errors' => [
                    'detailnamapenerima' => form_error('detailnamapenerima'),
                    'detailnowhatsapp' => form_error('detailnowhatsapp'),
                    'detailkodepos' => form_error('detailkodepos'),
                    'detailemail' => form_error('detailemail'),
                    'detailalamat' => form_error('detailalamat'),
                    'detailcatatanalamat' => form_error('detailcatatanalamat'),
                ]
            ];
            $this->response($errors, RestController::HTTP_NOT_ACCEPTABLE);
        } else {
            $data = array();
            $conf_toko = $this->Configtoko_m->findFirst('config_toko_id', '1');
            $carts = $this->Cart_m->findFirst('cart_user_id', $this->session->userdata('user_id'));
            $nama_penerima = $this->input->post('detailnamapenerima', true);
            $wa = $this->input->post('detailnowhatsapp', true);
            $alamat = $this->input->post('detailalamat', true);
            $kode_pos = $this->input->post('detailkodepos', true);
            $email = $this->input->post('detailemail', true);
            $detail_alamat = $this->input->post('detailcatatanalamat', true);
            $note = $this->input->post('detailcatatankurir', true);
            $cuorier_company = $this->input->post('courier_company', true);
            $courier_type = $this->input->post('courier_type', true);
            $delivery_date = date('Y-m-d');
            $delivery_time = date('H:i');

            foreach ($carts as $cart) {
                $datas = [
                    'name' => $cart['cart_product_name'],
                    'description' => $cart['cart_product_variant'],
                    'value' => $cart['cart_subtotal'] * $cart['cart_qty'],
                    'weight' => $cart['cart_weight'] * $cart['cart_qty'],
                    'quantity' => $cart['cart_qty'],
                    'sku' => $cart['cart_product_id'],
                ];
                array_push($data, $datas);
            }
            $val = json_encode($data);
            $field = '{
            "origin_contact_name":"' . $conf_toko['nama_toko'] . '", 
            "origin_contact_phone":"' . $conf_toko['nomor_wa_toko'] . '", 
            "origin_address":"' . $conf_toko['alamat_toko'] . '", 
            "origin_postal_code":' . $conf_toko['kode_pos'] . ', 
            "destination_contact_name":"' . $nama_penerima . '", 
            "destination_contact_phone":"' . $wa . '",
            "destination_contact_email":"' . $email . '",
            "destination_address":"' . $alamat . '", 
            "destination_postal_code":' . $kode_pos . ', 
            "destination_note":"' . $detail_alamat . '",
            "courier_company":"' . $cuorier_company . '", 
            "courier_type":"' . $courier_type . '",  
            "delivery_type":"later", 
            "delivery_date":"' . $delivery_date . '", 
            "delivery_time":"' . $delivery_time . '",
            "order_note": "' . $note . '", 
            "items": ' . $val . '
        }';

            $biteship = $this->pengiriman->create_order($field);
            $this->response($biteship, RestController::HTTP_OK);
        }
    }

    public function create_invoice_post()
    {
        date_default_timezone_set('Asia/Jakarta');
        $cekStatus = $this->Checkout_m->cekStatusChekout($this->session->userdata('user_id'), 'pending');
        if ($cekStatus['checkout_status'] == 'pending') {
            $msg = [
                'status' => 400,
                'message' => 'Maaf, Anda belum melakukan transaksi. Silahkan selesasikan transaksi sebelumnya terlebih dahulu.'
            ];
            $this->response($msg, RestController::HTTP_BAD_REQUEST);
        } else {
            $invoice_code = GenerateInvoiceCode('ARSNACK-', 20);
            $checkout_id = generaterandomint(10);
            $expedition = $this->input->post('expedition', true);
            $expedition_id = $this->input->post('expedition_id', true);
            $date = date('Y-m-d');
            $total_price = cleanString($this->input->post('total_price', true));
            $product_byid = $this->input->post('product_by_id', true);

            $data = [
                'checkout_id' => $checkout_id,
                'checkout_invoice_code' => $invoice_code,
                'checkout_user_id' => $this->session->userdata('user_id'),
                'checkout_expedition' => $expedition,
                'checkout_expedition_id' => $expedition_id,
                'checkout_date' => $date,
                'checkout_total_price' => $total_price,
                'checkout_product_by_id' => json_encode($product_byid),
                'checkout_status' => 'pending'
            ];
            $query = $this->Checkout_m->create($data);
            if ($query == true) {

                $msg = [
                    'status' => 200,
                    'message' => 'Berhasil membuat invoice'
                ];

                $this->response($msg, RestController::HTTP_OK);
            } else {
                $msg = [
                    'status' => 500,
                    'message' => 'Gagal membuat invoice'
                ];

                $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
            }
        }
    }

    public function midtranspayment_post()
    {
        $amount = cleanString($this->input->post('total_price', true));
        $name = user_login()['nama_lengkap'];
        $email = user_login()['email'];
        $phone = user_login()['no_whatsapp'];
        $response = $this->midtranspayment->get_snap_payment(
            $amount,
            $name,
            $email,
            $phone
        );
        if ($response) {
            $this->response($response, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 400,
                'message' => 'Gagal membuat invoice'
            ];
            $this->response($msg, RestController::HTTP_BAD_REQUEST);
        }
    }

    public function updateCheckout_post()
    {
        $payment_method = $this->input->post('payment_method', true);
        $status = 'processing';
        $data = [
            'checkout_status' => $status,
            'checkout_payment_method' => $payment_method
        ];
        $query = $this->Checkout_m->update('checkout_user_id', $this->session->userdata('user_id'), $data);
        if ($query == true) {
            $this->Cart_m->delete('cart_user_id', $this->session->userdata('user_id'));
            $us = $this->session->userdata('user_id');
            $sql = "SELECT * FROM tbl_checkouts WHERE checkout_user_id = '$us'";
            $d = $this->Checkout_m->query($sql)->row_array();
            $items = array();

            foreach (json_decode($d['checkout_product_by_id']) as $ds) {
                $s = [
                    'id' => $ds->sku,
                    'qty' => $ds->quantity,
                    'name' => $ds->name
                ];
                array_push($items, $s);
            }
            $data_invoice = [
                'invoice_id' => $d['checkout_invoice_code'],
                'invoice_user_id' => $d['checkout_user_id'],
                'invoice_payment_method' => $this->input->post('payment_method', true),
                'invoice_date' => $d['checkout_date'],
                'invoice_total_price' => $d['checkout_total_price'],
                'invoice_expedition_id' => $d['checkout_expedition_id'],
                'invoice_expedition_code' => $d['checkout_expedition'],
                'invoice_product' => json_encode($items),
                'invoice_midtrans_code' => $this->input->post('midtrans_code', true)
            ];

            $inv = $this->Invoice_m->create($data_invoice);
            if ($inv == true) {
                $this->Checkout_m->delete('checkout_user_id', $this->session->userdata('user_id'));
                $this->__sendWa($this->session->userdata('user_id'));
            }
            $msg = [
                'status' => 200,
                'message' => 'Berhasil membuat invoice'
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Gagal membuat invoice'
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    private function __sendWa($id)
    {

        $phone = $this->db->query("SELECT no_whatsapp FROM tbl_users WHERE role = 'administrator'")->row_array();
        $invoice = $this->Invoice_m->findById($id);
        $user = $this->User_m->findFirst($invoice['invoice_user_id'], 'user_id');
        $barang = "";
        $no = 1;
        foreach (json_decode($invoice['invoice_product']) as $b) {
            $barang .= $no++ . '. ' . $b->name . ' (x' . $b->qty . ')' . "\n";
        }
        $pesan = 'Pesan Otomatis Dari Website Ar Snack

Ada Pesanan Yang harus di packing. 
Barang yang di beli :
' . "\n" . $barang . '
Alamat Pengiriman : ' . $user['alamat_pengiriman'] . "\n" . '
Nama Penerima : ' . $user['nama_lengkap'] . "\n" . '
No Whatsapp : ' . $user['no_whatsapp'] . "\n" . ' 
No Invoice: ' . $invoice['invoice_id'] . "\n" . '
Total Pesanan : ' . Rp($invoice['invoice_total_price']) . ' 
';
        $response =  $this->sendwhatsapp->_send($phone['no_whatsapp'], $pesan);

        $this->response($response, RestController::HTTP_OK);
    }


    public function tracking_paket_get($waybil, $kurir)
    {
        $bitreship = $this->pengiriman->tracking($waybil, $kurir);
        $this->response($bitreship, RestController::HTTP_OK);
    }

    public function save_sales_data_post()
    {
        $user_id = $this->input->post('_id', true);
        $datas = $this->db->get_where(
            'tbl_invoice',
            ['invoice_id' => $user_id, 'invoice_user_id' => $this->session->userdata('user_id')]
        )->row_array();

        $data = [
            'sales_data_customer_id' => $datas['invoice_user_id'],
            'sales_data_total' => $datas['invoice_total_price'],
            'sales_date' => $datas['invoice_date'],
            'sales_data_product' => $datas['invoice_product'],
        ];

        $this->db->insert('tbl_sales_data', $data);
        if ($this->db->affected_rows() > 0) {
            $this->db->delete('tbl_invoice', ['invoice_user_id' => $this->session->userdata('user_id'), 'invoice_id' => $user_id]);
            $msg = [
                'status' => 200,
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function delete_akun_get($password, $ids)
    {
        $id = urlencode($ids);
        $pass = urlencode($password);
        $users = $this->User_m->findFirst($id, 'user_id');
        if (password_verify($pass, $users['password'])) {
            $this->User_m->delete($id, 'user_id');
            $this->session->unset_userdata('user_id', 'role');
            $msg = [
                'status' => 200,
                'url' => base_url(),
                'message' => 'Akun Berhasil Dihapus'
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 400,
                'message' => 'Password salah'
            ];
            $this->response($msg, RestController::HTTP_BAD_REQUEST);
        }
    }
}

/* End of file Restshopctroller.php */
