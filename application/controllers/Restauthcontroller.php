<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Form_validation form_validation
 * @property User_m user_m
 * @property Token_m token_m
 * @property Input input
 * @property Email email
 * @property Sesion session
 * @property Db db
 */

class Restauthcontroller extends RestController
{
    private $ci;
    public function __construct()
    {
        parent::__construct();

        $this->ci = get_instance();
    }

    public function login_post()
    {

        $this->load->model('user_m');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_message("required", "{field} harus diisi");
        $this->form_validation->set_message("valid_email", "{field} harus valid ");
        $this->form_validation->set_message("min_length", "{field} minimal {param} karakter");

        if ($this->form_validation->run() === FALSE) {
            $validation_err = [
                'errors' => [
                    'email' => form_error('email'),
                    'password' => form_error('password'),
                ]
            ];
            $this->response($validation_err, 422);
        } else {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);

            $user = $this->user_m->findFirst($email, 'email');

            if ($user) {
                if ($user['status'] == 1) {
                    if (password_verify($password, $user['password'])) {

                        if ($user['role'] === 'administrator') {
                            $data = [
                                'user_id' => $user['user_id'],
                            ];
                            $this->session->set_userdata($data);
                            $this->response([
                                'status' => 200,
                                'message' => 'Login Success',
                                'url' => base_url('admin')
                            ], RestController::HTTP_OK);
                        } elseif ($user['role'] === 'user') {
                            $data = [
                                'user_id' => $user['user_id'],
                            ];
                            $this->session->set_userdata($data);
                            $this->response([
                                'status' => 200,
                                'message' => 'Login Success',
                                'url' => base_url('user')
                            ], RestController::HTTP_OK);
                        } else {
                            $data = [
                                'user_id' => $user['user_id'],
                            ];
                            $this->session->set_userdata($data);
                            $this->response([
                                'status' => 200,
                                'message' => 'Login Success',
                                'url' => base_url('member')
                            ], RestController::HTTP_OK);
                        }
                    } else {
                        $this->response([
                            'status' => 401,
                            'message' => 'Password atau Email salah'
                        ], RestController::HTTP_UNAUTHORIZED);
                    }
                } else {
                    $this->response([
                        'status' => 401,
                        'message' => 'Anda belum aktivasi akun, Silahkan aktivasi terlebih dahulu'
                    ], RestController::HTTP_UNAUTHORIZED);
                }
            } else {
                $this->response([
                    'status' => 401,
                    'message' => 'Akun tidak ditemukan'
                ], RestController::HTTP_UNAUTHORIZED);
            }
        }
    }


    public function register_post()
    {

        $this->load->model('user_m');
        $this->load->model('token_m');

        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required|min_length[3]');
        $this->form_validation->set_rules('nowhatsapp', 'No. Whatsapp', 'required|min_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        $this->form_validation->set_message("required", "{field} harus diisi");
        $this->form_validation->set_message("valid_email", "{field} harus email valid");
        $this->form_validation->set_message("min_length", "{field} minimal {param} karakter");

        if ($this->form_validation->run() === FALSE) {
            $validation_err = [
                'errors' => [
                    'namalengkap' => form_error('namalengkap'),
                    'nowhatsapp' => form_error('nowhatsapp'),
                    'email' => form_error('email'),
                    'password' => form_error('password'),
                ]
            ];

            $this->response($validation_err, 422);
        } else {
            $nama = $this->input->post('namalengkap', true);
            $email = $this->input->post('email', true);
            $nowa = $this->input->post('nowhatsapp', true);
            $pass = $this->input->post('password', true);
            $role = $this->input->post('role', true);


            $token = "AR_SNACK_" . generateRandomString(64);

            date_default_timezone_set('Asia/Jakarta');
            $data_user = [
                'user_id' => rand(0, 9999),
                'nama_lengkap' => $nama,
                'no_whatsapp' => $nowa,
                'email' => $email,
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'created_at' => time(),
                'status' => 0,
                'role' => $role
            ];

            $data_token = [
                'token_id' => rand(0, 9999),
                'token' => $token,
                'email' => $email,
                'created_at' => time()
            ];

            $create_user = $this->user_m->create($data_user);
            $create_token = $this->token_m->create($data_token);

            if ($create_token == true && $create_user == true) {
                $this->_sendEmail(
                    $email,
                    "Verifikasi Akun AR SNACK",
                    generaterandomint(),
                    "Akun anda telah dibuat",
                    base_url('auth/verify?email=' . $email . '&token=' . $token)
                );
                $msg = [
                    'status' => 201,
                    'message' => "Akun anda telah dibuat",
                ];

                $this->response($msg, 201);
            } else {
                $msg = [
                    'status' => 500,
                    'message' => "Akun anda gagal dibuat",
                ];
                $this->response($msg, 500);
            }
        }
    }

    public function verify_post()
    {
        $this->load->model('user_m');
        $this->load->model('token_m');
        $email = $this->input->post('email');
        $token = $this->input->post('token');

        $user = $this->user_m->findFirst($email, "email");
        $user_token = $this->token_m->findFirst($token, 'token');
        if ($user) {
            if ($user['status'] == 0) {
                if ($user_token) {
                    if ($user_token['token'] === $token) {
                        if (time() - $user_token['created_at']  < (60 * 60 * 24)) {
                            $this->user_m->update($user['user_id'], ['status' => 1]);
                            $this->token_m->delete($user_token['token']);
                            $msg = [
                                'status' => 200,
                                'message' => 'Berhasil aktivasi akun Ar Snack'
                            ];

                            $this->response($msg, 200);
                        } else {
                            $this->token_m->delete($user_token['token']);
                            $msg = [
                                'status' => 401,
                                'message' => 'Token expired, Silahkan coba lagi'
                            ];

                            $this->response($msg, 401);
                        }
                    } else {
                        $msg = [
                            'status' => 400,
                            'message' => 'Ada yang error'
                        ];

                        $this->response($msg, 400);
                    }
                } else {
                    $msg = [
                        'status' => 401,
                        'message' => 'Maaf token tidak valid'
                    ];

                    $this->response($msg, 401);
                }
            } else {
                $msg = [
                    'status' => 202,
                    'message' => 'Anda telah melakukan aktivasi akun'
                ];

                $this->response($msg, 202);
            }
        } else {
            $msg = [
                'status' => 404,
                'message' => "Akun tidak ditemukan",
            ];
            $this->response($msg, 404);
        }
    }



    private function _sendEmail($email, $subject, $message, $msg, $links)
    {

        $email_config = $this->db->get('tbl_config_email')->row_array();
        $config = [
            'protocol' => "smtp",
            'smtp_host' => "ssl://smtp.googlemail.com",
            'smtp_user' => $email_config['send_email'],
            'smtp_pass' => $email_config['key_email'],
            'smtp_port' => 465,
            'mailtype' => "html",
            'charset' => "utf-8",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from($email_config['send_email'], $email_config['name_email']);
        $this->email->to($email);
        $this->email->subject($subject);

        $data_mail['link'] = $message;
        $data_mail['link_to_website'] = $links;
        $view_email = $this->load->view('mail/template_email', $data_mail, true);
        $this->email->message($view_email);
        if (!$this->email->send()) {
            $this->response($this->email->print_debugger(), 400);
            die;
        }
        $this->response([
            'status' => 200,
            'message' => $msg
        ], 200);
    }
}

/* End of file Restauthcontroller.php */
