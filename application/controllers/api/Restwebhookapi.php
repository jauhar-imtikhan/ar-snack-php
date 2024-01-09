<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property Pengiriman $pengiriman 
 */

class Restwebhookapi extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pengiriman');
    }

    public function webhookBiteship_get()
    {
        $datas = [
            "order_id" => "AbSASD12213dadas",
            "courier_tracking_id" => "AbSASD12213dadas",
            "courier_waybill_id" => "abc-1234",
            "event" => 'order.waybill_id',
            "status" => "picked"
        ];
        $query = $this->pengiriman->webhook($datas);

        if ($query) {
            $response = [
                'status' => true,
                'message' => 'test',
                'data' => $query
            ];
            $this->response($response, RestController::HTTP_OK);
        }
    }
}
