<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_m extends CI_Model
{
    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_checkouts";
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

    public function query($query)
    {
        return $this->db->query($query);
    }

    public  function delete(string $key, string $id)
    {
        $this->db->where($key, $id);
        $this->db->delete($this->tbl);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekStatusChekout(string $user_id, string $id = null)
    {
        $sql = "SELECT * FROM $this->tbl WHERE checkout_user_id = '$user_id' AND checkout_status = '$id'";
        $query = $this->db->query($sql)->row_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
}

/* End of file Checkout_m.php */
