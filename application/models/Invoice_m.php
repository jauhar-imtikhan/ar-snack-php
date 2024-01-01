<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_m extends CI_Model
{
    private $tbl;

    public function __construct()
    {
        parent::__construct();
        $this->tbl = 'tbl_invoice';
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

    public function find(string $key, string $id)
    {
        return $this->db->get_where($this->tbl, [$key => $id])->row_array();
    }

    public function findAll()
    {
        return $this->db->get($this->tbl)->result_array();
    }

    public function findById(string $id): mixed
    {
        $sql = "SELECT * FROM $this->tbl WHERE invoice_user_id = '$id' ";
        $query = $this->db->query($sql)->row_array();


        return $query;
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

    public function count_invoice(string $id): mixed
    {
        $sql = "SELECT COUNT(invoice_user_id) AS notifications FROM $this->tbl WHERE invoice_user_id = '$id' ";
        $query = $this->db->query($sql)->row_array();

        if ($query) {
            return $query['notifications'];
        } else {
            return false;
        }
    }
}

/* End of file Invoice_m.php */
