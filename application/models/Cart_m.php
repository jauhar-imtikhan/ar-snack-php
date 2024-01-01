<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_m extends CI_Model
{
    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_carts";
    }

    public function findFirst(string $key, string $id): mixed
    {
        $this->db->where($key, $id);
        $query = $this->db->get($this->tbl)->result_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function findById(string $id): mixed
    {
        $query = $this->db->get_where($this->tbl, ['cart_id' => $id])->row_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function create(array $data): bool
    {
        $this->db->insert($this->tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update(string $key, string $id, array $data): bool
    {
        $this->db->where($key, $id);
        $this->db->update($this->tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(string $key, string $id): bool
    {
        $this->db->where($key, $id);
        $this->db->delete($this->tbl);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function count_cart(string $id)
    {
        $sql = "SELECT COUNT(*) AS total FROM tbl_carts WHERE cart_user_id = '$id'";
        $query = $this->db->query($sql)->row_array();
        if ($query) {
            return $query['total'];
        } else {
            return false;
        }
    }

    public function count_total(string $id)
    {
        $sql = "SELECT SUM(cart_subtotal * cart_qty) AS total_harga FROM tbl_carts WHERE cart_user_id = '$id'";
        $query = $this->db->query($sql)->row_array();
        if ($query) {
            return $query['total_harga'];
        } else {
            return false;
        }
    }

    public function count_weight(string $id)
    {
        $sql = "SELECT SUM(cart_weight * cart_qty) AS total_berat FROM tbl_carts WHERE cart_user_id = '$id'";
        $query = $this->db->query($sql)->row_array();
        if ($query) {
            return $query['total_berat'];
        } else {
            return false;
        }
    }
}

/* End of file Cart_m.php */
