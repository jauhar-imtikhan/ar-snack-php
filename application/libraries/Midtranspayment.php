<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans.php';

\Midtrans\Config::$serverKey = $_ENV["MIDTRANS_SERVER_KEY"];
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = $_ENV['MIDTRANS_ENVIRONTMENT'] == 'production' ? true : false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
class Midtranspayment
{
    public function get_snap_payment(
        int $price,
        string $first_name,
        string $email,
        string $phone,
    ): array {
        $params = array(
            'transaction_details' => array(
                'order_id' => generaterandomint(8),
                'gross_amount' => $price,
            ),
            'customer_details' => array(
                'first_name' => $first_name,
                'email' => $email,
                'phone' => $phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        if ($snapToken) {
            $json = [
                'token' => $snapToken
            ];
            return $json;
        } else {
            return "error";
        }
    }
}
