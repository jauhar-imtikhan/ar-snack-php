<?php
if (!function_exists('set_json')) {
    function set_json($data, $code)
    {
        $ci = get_instance();
        if ($code == null) {
            $result = $ci->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            return $result;
        } else {
            $result = $ci->output
                ->set_status_header($code)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            return $result;
        }
    }
}

if (!function_exists('user_login')) {
    function user_login($id)
    {
        $ci = get_instance();
        $user = $ci->db->get_where('user', ['user_id' => $id])->row_array();
        return $user;
    }
}
function check_already_login()
{
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    if ($user_session) {
        redirect('admin');
    }
}
function check_not_login()
{
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('auth');
    }
}

function user_login()
{
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    $user = $ci->db->get_where('user', ['user_id' => $user_session])->row_array();
    return $user;
}

function Rp($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp ' . $rupiah;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
function generaterandomint($length = 6)
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
