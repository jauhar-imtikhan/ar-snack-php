<?php


if (!function_exists('set_json')) {
    function set_json($data, $code)
    {
        /** @var \CodeIgniter $ci */
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
        /** @var \CodeIgniter $ci */
        $ci = get_instance();
        $user = $ci->db->get_where('user', ['user_id' => $id])->row_array();
        return $user;
    }
}
function check_already_login()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    if ($user_session) {
        redirect('admin');
    }
}
function check_not_login()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('login');
    }
}

function user_login()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $user_session = $ci->session->userdata('user_id');
    $user = $ci->db->get_where('tbl_users', ['user_id' => $user_session])->row_array();
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


function countUser()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $sql = "SELECT COUNT('user_id') AS total_user FROM tbl_users";
    $user = $ci->db->query($sql)->row();
    return $user->total_user;
}

function countPaymentTotal()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $sql = "SELECT COUNT('sales_data_id') AS total_payment FROM tbl_sales_data";
    $user = $ci->db->query($sql)->row();
    return $user->total_payment;
}

function countTotalPendapatan()
{
    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $sql = "SELECT SUM(sales_data_total) AS total FROM tbl_sales_data";
    $total = $ci->db->query($sql)->row();

    if ($total->total == null) {
        return 0;
    } else {
        return $total->total;
    }
}

function cleanString(string $string)
{
    $cleanedString = preg_replace('/[^0-9]/', '', $string);
    return $cleanedString;
}

function GenerateInvoiceCode(string $preffix, int $length = 10)
{
    return $preffix . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

function check_role()
{

    /** @var \CodeIgniter $ci */
    $ci = get_instance();
    $user = $ci->session->userdata('role');
    if ($user !== 'administrator') {
        header('location: ' . base_url());
    }
}
