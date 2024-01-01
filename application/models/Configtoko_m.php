<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Configtoko_m extends CI_Model
{
    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_config_toko";
    }

    public function findFirst(string $key, string $id): array
    {
        $query = $this->db->get_where($this->tbl, [$key => $id])->row_array();

        if ($query) {
            return $query;
        } else {
            return array(
                'message' => 'data not found',
            );
        }
    }

    public function update(string $key, string $id, array $data): bool
    {
        $this->db->where($key, $id);
        $this->db->update($this->tbl, $data, [$key => $id]);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Configtoko_m.php */
