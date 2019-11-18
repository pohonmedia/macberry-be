<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Models for Catalogs Module
 *
 * @author Isht.Ae
 */
class Order_m extends CI_Model {

    public $user;

    function __construct() {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row();
    }

    public function count_all($params) {
        $sql = "SELECT MO.*";
        $sql .= " FROM md_order MO ";

        $dt_binding = array();
        if ($params != null) {
            foreach ($params as $key => $val) {
                if ($key == 0) {
                    $sql .= "WHERE " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                } else {
                    $sql .= "AND " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                }

                array_push($dt_binding, $val['value']);
            }
        }
        $sql .= "ORDER BY MO.id ASC";

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->num_rows();
    }

    public function get_all($params, $orders = 'ASC', $limit = NULL, $offset = NULL) {
        $sql = "SELECT MO.*, AU1.username as vcmembername, AU2.username as vcuserinsert, ";
        $sql .= "CASE WHEN MO.intstatusbayar = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusbayar = 1 THEN 'Konfirmasi'  WHEN MO.intstatusbayar = 2 THEN 'Pembayaran Diterima' ELSE 'Tidak ada status' END as vcstatusbayar, ";
        $sql .= "CASE WHEN MO.intstatusorder = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusorder = 1 THEN 'Proses Order' WHEN MO.intstatusorder = 2 THEN 'Pengiriman'  WHEN MO.intstatusorder = 3 THEN 'Selesai' ELSE 'Tidak ada status' END as vcstatusorder";
        $sql .= " FROM md_order MO ";
        $sql .= "LEFT JOIN app_users AU1 ON AU1.id = MO.intmemberid ";
        $sql .= "LEFT JOIN app_users AU2 ON AU2.id = MO.intinsertid ";

        $dt_binding = array();
        if ($params != null) {
            foreach ($params as $key => $val) {
                if ($key == 0) {
                    $sql .= "WHERE " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                } else {
                    $sql .= "AND " . $val['field'] . " " . ($val['operator'] != "" ? trim($val['operator']) : "=") . " ? ";
                }

                array_push($dt_binding, $val['value']);
            }
        }

        if ($limit != NULL && $offset != NULL) {
            $sql .= "ORDER BY MO.id " . $orders . " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $sql .= "ORDER BY MO.id " . $orders;
        }

        if ($params != null) {
            $query = $this->db->query($sql, $dt_binding);
        } else {
            $query = $this->db->query($sql);
        }
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_detail($field, $value) {
        $sql = "SELECT MO.*, AU1.username as vcmembername, AU1.address as vcmemberalamat, AU2.username as vcuserinsert, ";
        $sql .= "CASE WHEN MO.intstatusbayar = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusbayar = 1 THEN 'Konfirmasi'  WHEN MO.intstatusbayar = 2 THEN 'Pembayaran Diterima' ELSE 'Tidak ada status' END as vcstatusbayar, ";
        $sql .= "CASE WHEN MO.intstatusorder = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusorder = 1 THEN 'Proses Order' WHEN MO.intstatusorder = 2 THEN 'Pengiriman'  WHEN MO.intstatusorder = 3 THEN 'Selesai' ELSE 'Tidak ada status' END as vcstatusorder";
        $sql .= " FROM md_order MO ";
        $sql .= "LEFT JOIN app_users AU1 ON AU1.id = MO.intmemberid ";
        $sql .= "LEFT JOIN app_users AU2 ON AU2.id = MO.intinsertid ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY MO.id";

        $query = $this->db->query($sql, array($value));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function get_detail_order($field, $value) {
        // $sql = 'SELECT OD.*';
        $sql = "SELECT OD.*, MP.prod_name as vcnamaproduct ";
        // $sql .= "CASE WHEN MO.intstatusbayar = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusbayar = 1 THEN 'Konfirmasi'  WHEN MO.intstatusbayar = 2 THEN 'Pembayaran Diterima' ELSE 'Tidak ada status' END as vcstatusbayar, ";
        // $sql .= "CASE WHEN MO.intstatusorder = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusorder = 1 THEN 'Proses Order' WHEN MO.intstatusorder = 2 THEN 'Pengiriman'  WHEN MO.intstatusorder = 3 THEN 'Selesai' ELSE 'Tidak ada status' END as vcstatusorder";
        $sql .= " FROM md_order_detail OD ";
        $sql .= " JOIN md_product MP ON MP.id = OD.intproductid ";
        $sql .= "WHERE " . $field . " = ? ";
        $sql .= "ORDER BY OD.id";

        $query = $this->db->query($sql, array($value));

        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function create($data) {
        $data['user_create'] = $this->user->id;
        $data['date_create'] = mdate('%Y-%m-%d %H:%i:%s', now());
        $this->db->insert('md_order', $data);
        return $this->db->insert_id();
    }

    public function create_detail($data) {
        $this->db->insert('md_order_detail', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('md_order', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_product');
        return $this->db->affected_rows();
    }

    public function insert_product_img($data) {
        $this->db->insert('md_product_img', $data);
        return $this->db->insert_id();
    }

    public function delete_image($id) {
        $this->db->where('id', $id);
        $this->db->delete('md_product_img');
        return $this->db->affected_rows();
    }

    public function get_image($id) {
        $sql = "SELECT MPI.*";
        $sql .= " FROM md_product_img MPI ";
        $sql .= "WHERE prod_id = ? ";
        $sql .= "ORDER BY MPI.id";

        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }

    public function get_detail_img($id) {
        $sql = "SELECT MPI.*";
        $sql .= " FROM md_product_img MPI ";
        $sql .= "WHERE id = ? ";
        $sql .= "ORDER BY MPI.id";

        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function get_thumb($id) {
        $sql = "SELECT MPI.*";
        $sql .= " FROM md_product_img MPI ";
        $sql .= "WHERE prod_id = ? ";
        $sql .= "ORDER BY MPI.id";

        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row();
    }

    public function count_image($id) {
        $sql = "SELECT MPI.*";
        $sql .= " FROM md_product_img MPI ";
        $sql .= "WHERE prod_id = ? ";
        $sql .= "ORDER BY MPI.id ASC";

        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            return 0;
        }

        return $query->num_rows();
    }

    public function get_featured() {
        $sql = "SELECT MP.*, MPC.ct_name, MPT.type_name, AU.username";
        $sql .= " FROM md_product MP ";
        $sql .= "LEFT JOIN md_product_cat MPC ON MP.prod_category = MPC.id ";
        $sql .= "LEFT JOIN md_product_type MPT ON MP.prod_type = MPT.id ";
        $sql .= "LEFT JOIN app_users AU ON MP.user_create = AU.id ";
        $sql .= "ORDER BY MP.id DESC LIMIT 5";

        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->result();
    }


    public function get_order($userid) {
        $sql = "SELECT MO.*,";
        $sql .= "CASE WHEN MO.intstatusbayar = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusbayar = 1 THEN 'Konfirmasi'  WHEN MO.intstatusbayar = 2 THEN 'Pembayaran Diterima' ELSE 'Tidak ada status' END as vcstatusbayar, ";
        $sql .= "CASE WHEN MO.intstatusorder = 0 THEN 'Tunggu Pembayaran' WHEN MO.intstatusorder = 1 THEN 'Proses Order' WHEN MO.intstatusorder = 2 THEN 'Pengiriman'  WHEN MO.intstatusorder = 3 THEN 'Selesai' ELSE 'Tidak ada status' END as vcstatusorder";
        $sql .= " FROM md_order MO ";
        $sql .= "WHERE user_create = ? ";
        $sql .= "ORDER BY MO.dtorderdate";

        $query = $this->db->query($sql, array($userid));
        if ($query->num_rows() == 0) {
            return array();
        }

        return $query->result();
    }

}
