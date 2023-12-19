<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_m user_m
 * @property Product_m Product_m
 * @property Input input
 * @property Form_validation form_validation
 * @property Kategori_m Kategori_m
 * @property Upload upload
 */

class Restadmincontroller extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_m');
        $this->load->model('Kategori_m');
        $this->load->model('user_m');
    }
    public function update_profile_post()
    {

        $nama = $this->input->post('namalengkap', true);
        $nowhatsapp = $this->input->post('nowhatsapp');
        $alamat = $this->input->post('alamat', true);

        $data = [
            'nama_lengkap' => $nama,
            'no_whatsapp' => $nowhatsapp,
            'alamat' => $alamat
        ];

        $query = $this->user_m->update('user_id', user_login()['user_id'], $data);
        if ($query == true) {
            $msg = [
                'status' => 200,
                'message' => 'Update Profile Berhasil'
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'message' => 'Update Profile Gagal'
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function update_password_post()
    {
        $passlama = $this->input->post('password_lama', true);
        $passbaru = $this->input->post('password_baru', true);

        $users = $this->user_m->findFirst(user_login()['user_id'], 'user_id');
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|min_length[6]');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('min_length', '{field} minimal {param} karakter');
        if ($this->form_validation->run() === FALSE) {
            $validation = [
                'errors' => [
                    'password_lama' => form_error('password_lama'),
                    'password_baru' => form_error('password_baru'),
                ]
            ];
            $this->response($validation, RestController::HTTP_NOT_ACCEPTABLE);
        } else {
            if (password_verify($passlama, $users['password'])) {

                $pass = [
                    'password' => password_hash($passbaru, PASSWORD_DEFAULT)
                ];
                $query = $this->user_m->update('user_id', user_login()['user_id'], $pass);
                if ($query == true) {
                    $msg = [
                        'status' => 200,
                        'message' => 'Update Password Berhasil'
                    ];
                    $this->response($msg, RestController::HTTP_OK);
                } else {
                    $msg = [
                        'status' => 500,
                        'message' => 'Update Password Gagal'
                    ];
                    $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
                }
            } else {
                $msg = [
                    'status' => 401,
                    'message' => 'Password lama salah'
                ];
                $this->response($msg, RestController::HTTP_UNAUTHORIZED);
            }
        }
    }

    public function kategori_get()
    {

        $data = $this->Kategori_m->findMany();
        $this->response(['data' => $data], RestController::HTTP_OK);
    }

    public function create_product_post()
    {
        $config['upload_path'] = FCPATH . '/uploads/foto-product';  // Sesuaikan dengan path penyimpanan file
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('kodeproduk', 'Kode Produk', 'required|is_unique[tbl_products.product_barcode]');
        $this->form_validation->set_rules('namaproduk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('hargajualproduk', 'Harga Jual Produk', 'required|numeric');
        $this->form_validation->set_rules('hargabeliproduk', 'Harga Beli Produk', 'required|numeric');
        $this->form_validation->set_rules('kategoriproduk', 'Kategori Produk', 'required');


        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('is_unique', '{field} sudah ada');
        $this->form_validation->set_message('numeric', '{field} hanya boleh angka');

        $checkImageProduct = array();
        $checkGalleryProduct = array();

        if (empty($_FILES['imageproduct']['name']) && empty($_FILES['galleryproduct']['name'])) {
            $this->form_validation->set_rules('imageproduct', 'Gambar Produk', 'required');
            $this->form_validation->set_rules('galleryproduct', 'Gallery Produk', 'required');
        } else {
            $checkImageProduct[] = $_FILES['imageproduct']['name'];
            $checkGalleryProduct[] = $_FILES['galleryproduct']['name'];
        }

        if ($this->form_validation->run() === FALSE) {
            $validation = [
                'errors' => [
                    'kodeproduk' => form_error('kodeproduk'),
                    'namaproduk' => form_error('namaproduk'),
                    'hargajualproduk' => form_error('hargajualproduk'),
                    'hargabeliproduk' => form_error('hargabeliproduk'),
                    'kategoriproduk' => form_error('kategoriproduk'),
                    'imageproduct' => form_error('imageproduct'),
                    'galleryproduct' => form_error('galleryproduct'),
                ]
            ];
            $this->response($validation, RestController::HTTP_NOT_ACCEPTABLE);
        } else {
            $id_product = generaterandomint(8);
            $kode = $this->input->post('kodeproduk', true);
            $name = $this->input->post('namaproduk', true);
            $price = $this->input->post('hargajualproduk', true);
            $price_buy = $this->input->post('hargabeliproduk', true);
            $category = $this->input->post('kategoriproduk', true);

            $gallery = $_FILES['galleryproduct'];


            if (!$this->upload->do_upload('imageproduct')) {
                $msg = [
                    'status' => 400,
                    'message' => $this->upload->display_errors()
                ];
                $this->response($msg, RestController::HTTP_BAD_REQUEST);
            } else {
                $converted_image = $this->__uploadMultipleFile($gallery, 'uploads\foto-product\\');
                $data_upload = [
                    'product_id' => $id_product,
                    'product_barcode' => $kode,
                    'product_name' => $name,
                    'product_price_sell' => $price,
                    'product_price_buy' => $price_buy,
                    'product_category' => $category,
                    'product_img' => $this->upload->data()['file_name']
                ];
                $data_detail_product = [
                    'product_detail_id' => $id_product,
                    'img_detail' => json_encode($converted_image)
                ];

                $query1 = $this->Product_m->create($data_upload);
                $query2 = $this->Product_m->createDetail($data_detail_product);

                if ($query1 == true && $query2 == true) {
                    $msg = [
                        'status' => 200,
                        'message' => 'Produk berhasil ditambahkan'
                    ];
                    $this->response($msg, RestController::HTTP_OK);
                } else {
                    $msg = [
                        'status' => 500,
                        'message' => 'Produk gagal ditambahkan'
                    ];
                    $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
                }
            }
        }
    }

    private function __uploadMultipleFile(array $fieldName, string $path): array
    {
        if (count($fieldName['name']) > 0) {
            for ($i = 0; $i < count($fieldName['name']); $i++) {
                $result[] = $fieldName['name'][$i];
                move_uploaded_file($fieldName['tmp_name'][$i], FCPATH . $path . $fieldName['name'][$i]);
            }
        }
        return $result;
    }

    public function get_product_get()
    {
        $query = $this->Product_m->findView();
        if ($query) {
            $msg = [
                'status' => 200,
                'data' => $query
            ];
            $this->response($msg, RestController::HTTP_OK);
        } else {
            $msg = [
                'status' => 500,
                'data' => $query
            ];
            $this->response($msg, RestController::HTTP_INTERNAL_ERROR);
        }
    }

    public function pro_update_product_post()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('namaproduk', true);
        $harga = $this->input->post('hargajualproduk', true);
        $harga_beli = $this->input->post('hargabeliproduk', true);
        $kategory = $this->input->post('kategoriproduk', true);
        $sql = "SELECT * FROM result_product WHERE id_produk = '$id'";
        $datas_old = $this->Product_m->query($sql)->row_array();

        if (
            $datas_old['id_produk'] === $id && $datas_old['nama_produk'] === $nama && $datas_old['harga_jual'] === $harga &&
            $datas_old['harga_beli'] === $harga_beli && $datas_old['nama_kategori'] === $kategory
        ) {
            $msg = [
                'status' => 304,
                'message' => 'Tidak ada perubahan'
            ];
            $this->response($msg, RestController::HTTP_NOT_MODIFIED);
        } else {
            $msg = [
                'status' => 200,
                'message' => 'next state'
            ];
            $this->response($msg, RestController::HTTP_OK);
        }
    }
}

/* End of file Restadmincontroller.php */
