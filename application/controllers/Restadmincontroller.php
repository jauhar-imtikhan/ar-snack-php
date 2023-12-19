<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property User_m user_m
 * @property Input input
 * @property Form_validation form_validation
 */

class Restadmincontroller extends RestController
{

    public function update_profile_post()
    {
        $this->load->model('user_m');
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

        $this->load->model('user_m');

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
}

/* End of file Restadmincontroller.php */
