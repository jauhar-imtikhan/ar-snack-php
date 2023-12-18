<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Token_m extends CI_Model
{

    private $tbl;

    public function __construct()
    {
        $this->tbl = "tbl_token";
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

    public function findFirst(string $id, string $key): mixed
    {
        $query = $this->db->get_where($this->tbl, [$key => $id])->row_array();
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    public function delete(string $id): bool
    {
        $this->db->delete($this->tbl, ['token' => $id]);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Token_m.php */
