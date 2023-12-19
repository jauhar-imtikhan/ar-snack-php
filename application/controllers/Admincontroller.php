<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @property Session session
 * @property Upload upload
 * @property User_m user_m
 * @property Product_m Product_m
 * @property Configtoko_m Configtoko_m
 * @property Kategori_m Kategori_m
 * @property Form_validation form_validation
 */

class Admincontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Product_m');
        $this->load->model('Kategori_m');
        $this->load->model('Configtoko_m');
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'page' => 'home'
        ];
        $this->load->view('admin/main', $data);
    }

    public function profile()
    {

        $data_user = $this->user_m->findFirst(user_login()['user_id'], 'user_id');
        $data = [
            'title' => 'Profile',
            'page' => 'profile',
            'data_user' => $data_user
        ];
        $this->load->view('admin/main', $data);
    }

    public function kategori()
    {
        $data = [
            'title' => 'Kategori',
            'page' => 'kategori'
        ];
        $this->load->view('admin/main', $data);
    }

    public function produk()
    {
        $data = [
            'title' => 'Produk',
            'page' => 'produk'
        ];
        $this->load->view('admin/main', $data);
    }

    public function add_produk()
    {
        $data = [
            'title' => 'Tambah Produk',
            'page' => 'add_produk'
        ];
        $this->load->view('admin/main', $data);
    }

    public function settings()
    {

        $data_toko = $this->Configtoko_m->findFirst('config_toko_id', 1);
        $data = [
            'title' => 'Setting',
            'page' => 'setting',
            'data_toko' => $data_toko
        ];
        $this->load->view('admin/main', $data);
    }

    public function update_foto_profile()
    {
        $config['upload_path']          = FCPATH . 'uploads/user-profile/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 500;
        $config['max_height']           = 500;
        $config['encrypt_name']           = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img_profile')) {

            $users = $this->user_m->findFirst(user_login()['user_id'], 'user_id');
            if ($users['img_profile'] !== $_FILES['img_profile']['name']) {
                unlink(FCPATH . 'uploads/user-profile/' . $users['img_profile']);
                $data = [
                    'img_profile' => $this->upload->data()['file_name']
                ];
                $query =  $this->user_m->update('user_id', user_login()['user_id'], $data);
                if ($query == true) {
                    $data = [
                        'status' => 200,
                        'message' => 'Foto profile berhasil diubah'
                    ];
                    set_json($data, 200);
                } else {

                    $data = [
                        'status' => 500,
                        'message' => 'Foto profile gagal diubah'
                    ];
                    set_json($data, 500);
                }
            } elseif ($users['img_profile'] !== 'default.png') {
                unlink(FCPATH . 'uploads/user-profile/' . $users['img_profile']);
            }
        } else {
            $data = [
                'error' => $this->upload->display_errors()
            ];
            set_json($data, 400);
        }
    }



    public function update_product($id)
    {
        $products = $this->Product_m->findViewById($id);
        $kategpories = $this->Kategori_m->findMany();
        $data = [
            'title' => 'Edit Produk',
            'page' => 'edit_produk',
            'products' => $products,
            'kategories' => $kategpories
        ];
        $this->load->view('admin/main', $data);
    }
}
