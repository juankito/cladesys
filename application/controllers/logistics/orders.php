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

}

/* End of file orders.php */
/* Location: ./application/controllers/logistics/orders.php */