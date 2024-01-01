<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_m extends CI_Model
{

    private $tbl;
    private $tbl_detail;
    public function __construct()
    {
        parent::__construct();
        $this->tbl = 'tbl_products';
        $this->tbl_detail = 'tbl_detail_products';
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

    public function findView(): array
    {
        $query = $this->db->query("SELECT * FROM result_product")->result_array();
        if ($query) {
            return $query;
        } else {
            return ["not found"];
        }
    }

    public function findViewById(mixed $id): array
    {
        $query = $this->db->query("SELECT * FROM result_product WHERE id_produk = '$id'")->row_array();
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

    public function createDetail(array $data): bool
    {
        $this->db->insert($this->tbl_detail, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDetail(string $id, array $data): bool
    {
        $this->db->where('product_detail_id', $id);
        $this->db->update($this->tbl_detail, $data);
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

    public function deleteDetail(string $key, string $id): bool
    {
        $this->db->where($key, $id);

        $this->db->delete($this->tbl_detail);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function query(string $query): mixed
    {
        $querys = $this->db->query($query);
        if ($this->db->affected_rows() > 0) {
            return $querys;
        } else {
            return false;
        }
    }

    public function findAndLimit(int $limit): mixed
    {
        $sql = "SELECT * FROM result_product LIMIT $limit";
        $query = $this->db->query($sql)->result_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function paginate($limit,  $offest): mixed
    {
        $query = $this->db->get('result_product', $limit, $offest);

        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function search($keyword): mixed
    {
        $sql = "SELECT * FROM result_product WHERE nama_produk LIKE '%$keyword%'";
        $query = $this->db->query($sql)->result_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function count_product(): int
    {
        $query = $this->db->get('result_product')->num_rows();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
}

/* End of file Product_m.php */
