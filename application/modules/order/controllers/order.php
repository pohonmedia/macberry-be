<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @desc Public Controller for Catalogs module
 * @author Isht.Ae <ae.isht@gmail.com>
 */
class Order extends Public_Controller {

    public $_db, $_dbcat;

    public function __construct() {
        parent::__construct();
        $this->load->model('Order_m');
        $this->_db = $this->Order_m;
        // $this->load->model('Catalogs_categories_m');
        // $this->_dbcat = $this->Catalogs_categories_m;
        $this->breadcrumbs->push('Order', 'order');
    }

    public function index() {
        $str = 'List All ' . $this->uri->segment(1);
        $this->set_title(ucwords($str));

        $data_post = $this->_db->get_all(NULL, 'DESC');
        if (!empty($data_post)) {
            foreach ($data_post as $key => $value) {
                $get_img = $this->_db->get_thumb($value->id);
                $data_post[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
            }
        }
        $this->data['catalogs'] = $data_post;
        $this->data['sliders'] = Modules::run('sliders/get_all');

        //SHOW LEFT WIDGETS
        // $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index', $this->data);
    }

    public function add() {
        $this->data['page_desc'] = "Tambah Item Belanja";
        $insert_data = array(
            'id' => $this->input->post('intproductid'),
            'name' => $this->input->post('vcproductname'),
            'price' => $this->input->post('decprice'),
            'qty' => $this->input->post('intqty')
        );

        $this->cart->insert($insert_data);
        $this->template->build('index', $this->data);
    }

    public function checkout() {
        $this->data['page_desc'] = "Rincian Pembayaran";
        $this->data['user_data'] = array(
            'vcfname' => $this->input->post('vcfname'),
            'vclname' => $this->input->post('vclname'),
            'vcstreet' => $this->input->post('vcstreet'),
            'vcstate' => $this->input->post('vcstate'),
            'vccity' => $this->input->post('vccity'),
            'intongkir' => $this->input->post('intongkir'),
            'inttelephone' => $this->input->post('inttelephone'),
            'vcemail' => $this->input->post('vcemail'),
            'vcpayment' => $this->input->post('vcpayment'),
             'nama_state' => $this->input->post('nama_state'),
             'nama_city' => $this->input->post('nama_city'),
             'ongkir' => $this->input->post('ongk')

        );
        $this->data['cart'] = $this->cart->contents();

        // $this->data['user_data'] = $this->user_data->contents();

        $this->template->build('index_checkout', $this->data);
    }

    public function detail() {
        $this->data['page_desc'] = "My Cart";
        $this->data['cart'] = $this->cart->contents();
        $this->template->build('index_cart', $this->data);
    }

    public function payment() {
        $props = array();
        $prop_arr = array(
            'province_id' => 0,
            'province' => 'Pilih Propinsi'
        );
        $this->data['page_desc'] = "Payment";
        $this->data['cart'] = $this->cart->contents();
        $this->data['city'] =  json_decode($this->rajaongkir->city(), true);
        $province = json_decode($this->rajaongkir->province(), true);
        array_push($props, $prop_arr);
        foreach ($province['rajaongkir']['results'] as $val) {
            array_push($props, array(
                'province_id' => $val['province_id'],
                'province' => $val['province']
            ));
        }
        $cart = $this->cart->contents();
        $total = 0;
        if(!empty($cart)) {
            foreach ($cart as $items) {
                $total += ($items['qty']*$items['price']);
            }
        }

        $this->data['province'] =  $props;
        $this->data['total'] =  $total;
        $this->template->build('index_payment', $this->data);
    }

    public function save() {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('auth/member'), 'refresh');
        }
        $this->data['cart'] = $this->cart->contents();
        $this->data['msg'] = 'Tidak ada data di Keranjang';
        $this->data['page_desc'] = "Transaksi Pemesanan";

        if(!empty($this->data['cart'])) {
            $order = array(
                'vcordercode' => '',
                'intmemberid' => $this->user->id,
                'dectotal' => 0,
                'intstatusbayar' => 0,
                'intstatusorder' => 0,
                'intinsertid' => $this->user->id
            );

            $order_id = $this->_db->create($order);
            $total = 0;

            foreach ($this->data['cart'] as $item){
                $order_detail = array(
                    'intorderid' => $order_id,
                    'intproductid' => $item['id'],
                    'intqty' => $item['qty'],
                    'decprice' => $item['price'],
                    'dectotalprice' => $item['price'] * $item['qty']
                );

                $total += $order_detail['dectotalprice'];
                $this->_db->create_detail($order_detail);
            }
            $order_update = array('dectotal' => $total);
            $this->_db->update($order_id, $order_update);
            $this->cart->destroy();

            $this->data['msg'] = 'Order Telah Berhasil';
        }

        $this->template->build('index_success', $this->data);
    }

    public function delete($id) {
        if ($id=="all")
        {
            $this->cart->destroy();
        }
        else
        {
            $data = array('rowid' => $id,
                          'qty' =>0);

            $test = $this->cart->update($data);
        }
        
        redirect('order/detail');
    }

    public function update() {
        $post = $this->input->post(null, true);

        $data = array('rowid' => $post['id'],
                      'qty' => $post['qty']);

        $test = $this->cart->update($data);

        echo json_encode(array('success' => true, 'msg' => 'Data Pendfaran Disimpan', 'data' => null));
    }

    

    public function category($slug = null) {
        // SHOW READ METHOD
        if ($slug == null) {
            redirect('read/category/error');
        }
        $this->breadcrumbs->push('Categories', 'catalogs/categories');


        $detail = $this->_dbcat->get_detail('ct_slug', $slug);

        if ($detail === FALSE) {
            $this->breadcrumbs->push('Not Found', 'catalogs/category/' . $slug);
            $this->set_title('Category Not Found');
            $this->data['not_found'] = 'Category Not Found';
            $this->data['not_found_msg'] = "Sorry, Category you're looking for doesn't exist";
        } else {
            $this->breadcrumbs->push($detail->ct_name, 'catalogs/category/' . $slug);
            $data_barang = array();
            $par[] = array('field' => 'ct_parent', 'param' => '', 'operator' => '', 'value' => $detail->id);
            $is_parent = $this->_dbcat->get_all($par);

            $this->set_title('All Product under ' . $detail->ct_name);
            if ($is_parent) {
                $param[] = array('field' => 'prod_category', 'param' => '', 'operator' => '', 'value' => $detail->id);
            } else {
                $param[] = array('field' => 'prod_subcategory', 'param' => '', 'operator' => '', 'value' => $detail->id);
            }
            $data_barang = $this->_db->get_all($param);
            if (!empty($data_barang)) {
                foreach ($data_barang as $key => $value) {
                    $get_img = $this->_db->get_thumb($value->id);
                    $data_barang[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
                }
            }
            $data_post = $data_barang;
            $this->data['result'] = $data_post;
        }
        //SHOW LEFT WIDGETS
        $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index_category', $this->data);
    }

    public function product($id = null) {
        // SHOW READ METHOD
        if ($id == null) {
            redirect('catalog/error');
        }

        $detail = $this->_db->get_detail('MP.id', $id);
        if ($detail === FALSE) {
            $this->breadcrumbs->push('Not Found', 'catalogs/categories');
            $this->set_title('Product Not Found');
            $detail = array('prod_name' => 'Product not found', 'prod_desc' => "Sorry, Product you're looking for doesn't exist");
            $this->data['product'] = (object) $detail;
        } else {
            $this->breadcrumbs->push($detail->prod_name, 'catalogs/product/' . $id);
            $this->set_title($detail->prod_name);
            $detail->img = $this->_db->get_image($id);
            $this->data['product'] = $detail;
        }
        //SHOW LEFT WIDGETS
//        $this->data['left_widgets'] = $this->widget->show_widget('left');

        $this->template->build('index_detail', $this->data);
    }

    public function get_featured() {
        // RETURN ALL FEATURED PRODUCTS
        $result = $this->_db->get_featured();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $get_img = $this->_db->get_thumb($value->id);
                $result[$key]->img_thumb = $get_img == null ? 'assets/modules/catalogs/default-image.jpg' : $get_img->prod_thumb_url;
            }
        }
        return $result;
    }

    public function test(){
        $provinces = $this->rajaongkir->province();
        $city = json_decode($this->rajaongkir->city(), true);
        $cost = $this->rajaongkir->cost(444, 22, 1000, "jne");
        $tracking = $this->rajaongkir->waybill("waybill","jne");
        var_dump($city);
    }

    public function getongkir($kotatujuan) {
        $ongkir = $this->rajaongkir->cost(444, $kotatujuan, 1000, "jne");
        $ongkir = json_decode($ongkir, true);

        // var_dump($ongkir);
        echo json_encode($ongkir);
    }

    public function getcity($idprop) {
        $city = $this->rajaongkir->city($idprop, NULL);
        $city = json_decode($city, true);

        // json_encode($city));
        echo json_encode($city['rajaongkir']['results']);
    }

}

/* End of file catalogs.php */
/* Location: ./application/modules/catalogs/controllers/catalogs.php */