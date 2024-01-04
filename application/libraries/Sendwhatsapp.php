<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendwhatsapp
{
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function _send(string $phone, string $msg)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $_ENV["WA_ENDPOINT"] . '/api/v1/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "phone=$phone&message=$msg",
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $_ENV["WA_TOKEN"],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
