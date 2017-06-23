<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('logistics/ordersmodel');
	}

	public function index()
	{
		$select = array(	
			'id' 			=> 'orders.id',
			'location' 		=> 'location.name as location',
			'date' 			=> 'orders.date',
			'shippingdate' 	=> 'orders.shippingdate',
			'status' 		=> 'orders.status'
		);	
		$from = array(	
			'table' 	=> 'orders'
		);	
		$join = array(	
			'table1' 		=> 'location',
			'condition1' 	=> 'location.id = orders.locationid'
		);

		$gotten =  $this->ordersmodel->get_items($select, $from, $join, false, false);

		$data = array('orders' => $gotten);

		return $this->load->view('logistics/orders/index', $data);
	}

	public function create(){
		$select = array(
			'productid' => 'product.id',
			'detail'	=> 'product.detail',
			'brand'		=> 'brand.name as brand',
			'unitprice'	=> '(unit_price.pri_qua / unit_price.total_q)'
			);

		$from = array('table' => 'product');

		$join = array(
			'table1' 		=> 'brand',
			'condition1'	=> 'brand.id =  product.brandid',
			'table2'		=> 'unit_price',
			'condition2'	=> 'unit_price.productid = product.id'
			);
		$where = array(
			'product.flagstate' => 1,
			'unit_price.locationid' => 1
			);


		
	}

}

/* End of file orders.php */
/* Location: ./application/controllers/logistics/orders.php */