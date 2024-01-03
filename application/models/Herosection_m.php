<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Herosection_m extends CI_Model
{

    private $tbl;

    public function __construct()
    {
        parent::__construct();
        $this->tbl = "tbl_hero_section";
    }

    public function findAll(): array
    {
        return $this->db->get($this->tbl)->result_array();
    }

    public function findById(string $id): mixed
    {
        $query = $this->db->get_where($this->tbl, ['hero_Section_id' => $id])->row_array();
        if ($query) {
            return $query;
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

    public function create(array $data)
    {
        $this->db->insert($this->tbl, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Herosection_m.php */
