<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{
    private $tbl;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_kategori";
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

    public function findFirst(string $key, string $id): mixed
    {
        $query = $this->db->get_where($this->tbl, [$key => $id])->row_array();

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
}

/* End of file Kategori_m.php */
