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
 * @property Seo_m Seo_m
 * @property Stock_m Stock_m
 * @property Db db
 * @property Herosection_m Herosection_m
 * @property Iconfontawesome Iconfontawesome
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
        $this->load->model('User_m');
        $this->load->model('Seo_m');
        $this->load->model('Stock_m');
        $this->load->model('Herosection_m');
        $this->load->library('iconfontawesome');
        check_role();
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

        $data_user = $this->User_m->findFirst(user_login()['user_id'], 'user_id');
        $data = [
            'title' => 'Profile',
            'page' => 'profile',
            'data_user' => $data_user,

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
        $seo = $this->Seo_m->findFirst();
        $temp_email = $this->db->get_where('tbl_template_mail', ['template_email_id' => '1'])->row_array();
        $sender_email = $this->db->get('tbl_config_email')->row_array();
        $data_favicon = $this->db->get_where('tbl_favicon', ['favicon_id' => '1'])->row_array();
        $data = [
            'title' => 'Setting',
            'page' => 'setting',
            'data_toko' => $data_toko,
            'data_seo' => $seo,
            'data_template_email' => $temp_email,
            'data_sender_email' => $sender_email,
            'data_favicon' => $data_favicon
        ];
        $this->load->view('admin/main', $data);
    }

    public function preview_template_email()
    {
        $this->load->view('mail/template_email');
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
            'kategories' => $kategpories,
        ];
        $this->load->view('admin/main', $data);
    }

    public function add_kategori()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'page' => 'add_kategori'
        ];
        $this->load->view('admin/main', $data);
    }

    public function edit_kategori($id)
    {
        $kategories = $this->Kategori_m->findFirst('kategori_id', $id);
        $data = [
            'title' => 'Tambah Kategori',
            'page' => 'edit_kategori',
            'kategories' => $kategories
        ];
        $this->load->view('admin/main', $data);
    }

    public function stock()
    {
        $data = [
            'title' => 'Stock',
            'page' => 'stock'
        ];
        $this->load->view('admin/main', $data);
    }
    public function wa()
    {

        $data = [
            'title' => 'Whatsapp Gateway',
            'page' => 'wa_gateway',

        ];
        $this->load->view('admin/main', $data);
    }

    public function wa_auto_reply()
    {

        $data = [
            'title' => 'Whatsapp BOT Auto REply',
            'page' => 'wa_auto_reply',

        ];
        $this->load->view('admin/main', $data);
    }

    public function hero_section()
    {
        $data_hero_Section = $this->Herosection_m->findById('1');
        $data = [
            'title' => 'Hero Section',
            'page' => 'hero_section',
            'hero_section' => $data_hero_Section
        ];
        $this->load->view('admin/main', $data);
    }

    public function social_link()
    {

        $data = [
            'title' => 'Sosial Media Link',
            'page' => 'social_link',
        ];
        $this->load->view('admin/main', $data);
    }

    public function social_link_edit()
    {

        $data = [
            'title' => 'Sosial Media Link',
            'page' => 'social_link_edit',
        ];
        $this->load->view('admin/main', $data);
    }
}
