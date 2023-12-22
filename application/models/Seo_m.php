<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Seo_m extends CI_Model
{

    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_seo";
    }
    public function findFirst(): array
    {
        $query = $this->db->get_where($this->tbl, ['seo_id' => 1])->row_array();

        if ($query) {
            return $query;
        } else {
            return ["not found"];
        }
    }


    public function update(array $data): bool
    {
        $this->db->where('seo_id', '1');
        $this->db->update($this->tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Seo_m.php */
