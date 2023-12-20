<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Stock_m extends CI_Model
{
    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_product_stock";
    }

    public function findMany(): array
    {
        $query = $this->db->get($this->tbl)->result_array();

        if ($query) {
            return $query;
        } else {
            return ["not found"];
        }
    }

    public function update(string $id, array $data): bool
    {
        $this->db->where('product_stock_id', $id);
        $this->db->update($this->tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(string $id): bool
    {
        $this->db->where('product_stock_id', $id);
        $this->db->delete($this->tbl);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Stock_m.php */
