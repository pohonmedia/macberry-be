<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Binary Class
 *
 * This class manage Binary Processing
 *
 * @package		Binary
 * @version		1.0
 * @author 		Isht.Ae <ae.isht@gmail.com>
 * @copyright           Copyright (c) 2016, Isht.Ae
 * @link		https://github.com/isht
 */
class Binary {

    /**
     * Binary Stack
     *
     */
    protected $ci;
    protected $_db;
//    protected $_msg;
    protected $info;
    protected $left;
    protected $right;
    protected $value;
    protected $parent;
    protected $level;

    /**
     * Constructor
     *
     * @access	public
     *
     */
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('Lib_binary_model');
//        $this->ci->load->library('Messages');
        $this->_db = $this->ci->Lib_binary_model;
//        $this->_msg = $this->ci->messages;
//        log_message('debug', "Binary Class Initialized");
    }

    //GET INFO ALL USER or BY USER ID
    public function get_user($user_id = NULL) {
        return $this->_db->get_user($user_id);
    }

    //GET USAHA ALL or BY USER ID
    public function get_combo_usaha($user_id = NULL) {
        return $this->_db->get_combo_usaha($user_id);
    }

    //GET USAHA ALL or BY USER ID
    public function get_usaha($user_id = NULL) {
        return $this->_db->get_usaha($user_id);
    }

    public function get_detail_usaha($id) {
        return $this->_db->get_detail_usaha($id);
    }

    //GET USAHA TEMP or BY USER ID
    public function get_usaha_temp($user_id = NULL) {
        return $this->_db->get_usaha_temp($user_id);
    }

    public function get_usaha_temp_approve($user_id = NULL) {
        return $this->_db->get_usaha_temp_approve($user_id);
    }

    public function get_detail_usaha_temp($id) {
        return $this->_db->get_detail_usaha_temp($id);
    }

    public function get_pending($user_id = NULL) {
        return $this->_db->get_pending($user_id);
    }

    //COUNT ALL USAHA BY ID OR ALL
    public function count_usaha($user_id = NUL) {
        return $this->_db->count_usaha($user_id);
    }

    //Get Last Level of parent
    public function get_last_level_id($id_parent) {
        return 1;
    }

    //BUILDING BINARY TREE
    public function build_tree($usaha_id) {
        $query = $this->_db->get_detail_usaha($usaha_id);
        $result = array(
            'id' => $query->usaha_id,
            'userId' => $query->id,
            'userName' => $query->username,
            'totalReward' => $query->mb_reward_total,
            'child' => $this->_fetch_tree($usaha_id, 0)
        );

        return $result;
    }

    private function _fetch_tree($usaha_id = 0, $init = 0) {
        $query = array();
        $result = array();

        if ($init < 2 && $usaha_id != 0) {
            $query = $this->_db->get_tree_member($usaha_id);
            if (!empty($query)) {
                foreach ($query as $key => $value) {
                    $result[] = array(
                        'id' => $value->usaha_id,
                        'userId' => $value->id,
                        'userName' => $value->username,
                        'totalReward' => $value->mb_reward_total,
                        'child' => $this->_fetch_tree($value->usaha_id, $init + 1)
                    );
                }
            }
        }

        return $result;
    }

    public function add_titik_temp($user_id) {

        $user = $this->_db->get_user($user_id);
        $data_insert = array(
            'mb_user_id' => $user_id,
            'mb_sponsor_id' => $user->parent_id,
            'mb_parent_id' => 0,
            'mb_position_code' => 0
        );

        $this->_db->add_node_temp($data_insert);

        return TRUE;
    }

    public function add_node($user_id, $parent = NULL) {
        $return = array('status' => true, 'msg' => 'Node berhasil ditambahakan.');
        if ($user_id == 0) {
            $return['status'] = false;
            $return['msg'] = 'Pilih dahulu user yang akan dibuat titik usahanya';
            return $return;
        }

        //checking saldo user
        $user = $this->_db->get_user($user_id);
        if ($user->saldo_total < 40000) {
            $return['status'] = false;
            $return['msg'] = 'Saldo user tidak mencukupi';
            return $return;
        }

        if ($user_id != 1 && $parent == 0) {
            $return['status'] = false;
            $return['msg'] = 'Selain user ADMIN, tidak bisa menjadi node utama.';
            return $return;
        }

        $jumlah_titik = $this->_db->check_count_node($parent);
        if ($parent == 0 && $jumlah_titik >= 1) {
            $return['status'] = false;
            $return['msg'] = 'Node Utama hanya mempunyai 1 data admin';
            return $return;
        }
        if ($parent != 0 && $jumlah_titik >= 2) {
            $return['status'] = false;
            $return['msg'] = 'Upline sudah mempunyai 2 downline. Pilih titik usaha yang lain';
            return $return;
        }

//        $detail_titik = $this->_db->get_detail_usaha($parent);

        $data_insert = array(
            'mb_user_id' => $user_id,
            'mb_sponsor_id' => $user->parent_id,
            'mb_parent_id' => $parent,
            'mb_position_code' => $jumlah_titik > 0 ? 'R' : 'L',
            'mb_reward_total' => 0,
            'mb_last_level' => 0,
            'mb_count_child' => 0,
            'mb_user_create' => $this->ci->ion_auth->user()->row()->id,
        );

        $id_titik = $this->_db->add_node($data_insert);
        //UPDATE SALDO USER
        $update_saldo = array(
            'mm_saldo_total' => $user->saldo_total - 40000,
            'mm_usaha_total' => $user->usaha_total + 1
        );
        $this->_db->update_user_info($user_id, $update_saldo);

        //DISTRIBUTE REWARD
        $this->_distribute_reward($id_titik, FALSE);

        $return['id'] = $id_titik;
        return $return;
    }

    public function _distribute_reward($id_titik, $first = TRUE) {
        $detail_usaha = $this->_db->get_detail_usaha($id_titik);

        $this->_checking_level_sponsor($detail_usaha, $first);
        $this->_checking_level_dua($detail_usaha);
        $this->_checking_level_seribu($detail_usaha->mb_user_id, $detail_usaha, 15000);

        $update_node = array(
            'reward_status' => 1
        );

        $this->_db->update_node($id_titik, $update_node);

        return true;
    }

    private function _checking_level_sponsor($detail_usaha, $first) {
        //CHECK JUMLAH TITIK DULU
        if ($first) {
            $this->set_first_sponsor($detail_usaha);
        } else {
            $jumlah_titik = $this->_db->count_usaha($detail_usaha->mb_user_id);
            if ($jumlah_titik == 1) {
                $this->set_first_sponsor($detail_usaha);
            } else {
                $this->set_next_sponsor($detail_usaha);
            }
        }

        return TRUE;
    }

    private function set_first_sponsor($detail_usaha) {
        //*****UPDATE REWARD SPONSOR*****//

        if ($detail_usaha->mb_sponsor_id == 0) {
            $sponsor_detail = $this->_db->get_user(1);

            $update_reward_sponsor = array(
                'mm_reward_total' => $sponsor_detail->reward_total + 15000
            );

            $log_reward_sponsor = array(
                'reward_type' => 1,
                'reward_value' => 15000,
                'reward_user_id' => 1,
                'reward_usaha_id' => 0,
                'reward_from_id' => 1
            );

            $this->_db->update_user_info(1, $update_reward_sponsor);
            $this->_db->add_reward($log_reward_sponsor);
        } else {
            $sponsor_detail = $this->_db->get_user($detail_usaha->mb_sponsor_id);

            $update_reward_sponsor = array(
                'mm_reward_total' => $sponsor_detail->reward_total + 15000
            );

            $log_reward_sponsor = array(
                'reward_type' => 1,
                'reward_value' => 15000,
                'reward_user_id' => $detail_usaha->mb_sponsor_id,
                'reward_usaha_id' => 0,
                'reward_from_id' => $detail_usaha->mb_user_id
            );

            $this->_db->update_user_info($detail_usaha->mb_sponsor_id, $update_reward_sponsor);
            $this->_db->add_reward($log_reward_sponsor);
        }
        //======END REWARD SPONSOR=====//
        return TRUE;
    }

    private function set_next_sponsor($detail_usaha) {
        //*****UPDATE REWARD SPONSOR*****//

        $sponsor_detail = $this->_db->get_user($detail_usaha->mb_user_id);

        $update_reward_sponsor = array(
            'mm_reward_total' => $sponsor_detail->reward_total + 15000
        );

        $log_reward_sponsor = array(
            'reward_type' => 1,
            'reward_value' => 15000,
            'reward_user_id' => $detail_usaha->mb_user_id,
            'reward_usaha_id' => 0,
            'reward_from_id' => $detail_usaha->mb_user_id
        );

        $this->_db->update_user_info($detail_usaha->mb_user_id, $update_reward_sponsor);
        $this->_db->add_reward($log_reward_sponsor);
        //======END REWARD SPONSOR=====//

        return TRUE;
    }

    private function _checking_level_dua($detail_usaha) {
        if ($detail_usaha->mb_parent_id == 0) {
            $this->_set_level2_admin($detail_usaha->mb_user_id);
            return TRUE;
        } else {
            $upline = $this->_db->get_detail_usaha($detail_usaha->mb_parent_id);

            if ($upline->mb_parent_id == 0) {
                $this->_set_level2_admin($detail_usaha->mb_user_id);
                return TRUE;
            }

            $upline_2 = $this->_db->get_detail_usaha($upline->mb_parent_id);

//            if ($upline_2->mb_parent_id == 0) {
//                $this->_set_level2_admin($detail_usaha->mb_user_id);
//                return TRUE;
//            }

            $detail_upline2 = $this->_db->get_user($upline_2->mb_user_id);
            $update_reward_level2 = array(
                'mm_reward_total' => $detail_upline2->reward_total + 10000
            );
            $log_reward_sponsor = array(
                'reward_type' => 2,
                'reward_value' => 10000,
                'reward_user_id' => $upline_2->mb_user_id,
                'reward_usaha_id' => $upline_2->usaha_id,
                'reward_from_id' => $detail_usaha->mb_user_id
            );

            $this->_db->update_user_info($upline_2->mb_user_id, $update_reward_level2);
            $this->_db->add_reward($log_reward_sponsor);
            return TRUE;
        }
    }

    private function _set_level2_admin($mb_user_id) {
        $detail_upline = $this->_db->get_user(1);
        $update_reward_sponsor = array(
            'mm_reward_total' => $detail_upline->reward_total + 10000
        );

        $log_reward_sponsor = array(
            'reward_type' => 2,
            'reward_value' => 10000,
            'reward_user_id' => 1,
            'reward_usaha_id' => 1,
            'reward_from_id' => $mb_user_id
        );

        $this->_db->update_user_info(1, $update_reward_sponsor);
        $this->_db->add_reward($log_reward_sponsor);
        return TRUE;
    }

    private function _checking_level_seribu($id_user, $detail_usaha, $value) {
        $upline = $this->_db->get_detail_usaha($detail_usaha->mb_parent_id);

        if (!$upline) {
            if ($value > 0) {
                //UPDATE TO ADMIN
                $upline = $this->_db->get_user(1);
                $update_reward = array(
                    'mm_reward_total' => $upline->reward_total + $value
                );

                $log_reward_sponsor = array(
                    'reward_type' => 3,
                    'reward_value' => $value,
                    'reward_user_id' => 1,
                    'reward_usaha_id' => 1,
                    'reward_from_id' => $id_user
                );

                $this->_db->update_user_info(1, $update_reward);
                $this->_db->add_reward($log_reward_sponsor);
            }
            return TRUE;
        } else {
            if ($value > 0) {
                $detail_upline = $this->_db->get_user($upline->mb_user_id);

                $update_reward = array(
                    'mm_reward_total' => $detail_upline->reward_total + 1000
                );

                $log_reward_sponsor = array(
                    'reward_type' => 3,
                    'reward_value' => 1000,
                    'reward_user_id' => $upline->mb_user_id,
                    'reward_usaha_id' => $upline->usaha_id,
                    'reward_from_id' => $id_user
                );

                $this->_db->update_user_info($upline->mb_user_id, $update_reward);
                $this->_db->add_reward($log_reward_sponsor);
            } else {
                return TRUE;
            }
        }

        $this->_checking_level_seribu($id_user, $upline, ($value - 1000));
    }

//    public function msg_errors() {
//        $errors = $this->_msg->get("error");
//        $data = "";
//        if ($this->_msg->count("error") >= 1) {
//            foreach ($errors as $value) {
//                $data .= '<li>' . $value . '</li>';
//            }
//            return $data;
//        } else {
//            return NULL;
//        }
//    }
//
//    public function msg_success() {
//        $success = $this->ci->messages->get("success");
//        $data = "";
//        if ($this->ci->messages->count("success") >= 1) {
//            foreach ($success as $value) {
//                $data .= '<li>' . $value . '</li>';
//            }
//            return $data;
//        } else {
//            return NULL;
//        }
//    }
}

/* End of file Binary.php */
/* Location: ./application/libraries/Binary.php */
