<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('logistics/stockmodel');
	}

	public function index()
	{	
		//This part retunrs the distinct locations are in the db
		$select = array(
			'id' 	=> 'location.id as locationid',
			'name'	=> 'location.name'
			);
		$from = array('table' => 'location');

		$locations = $this->stockmodel->get_items($select, $from, false, false, false);

		//This makes the query asking for the product with all the details, the prices and calculates
		//directly the unitprice for each case.
		$select = array(
			'id' 		=> 'stock.id as stockid',
			'location' 	=> 'stock.locationid as local',
			'productid'	=> 'inputdetail.productid',
			'product'	=> 'product.detail',
			'brand'		=> 'brand.name as brand',
			'quantity'	=> 'stock.quantity as quantity',
			'pricesum'	=> 'sum(stock.quantity * inputdetail.unitprice) as pricetotal',
			'quantsum'	=> 'sum(stock.quantity) as totalquantity',
			'stock'		=> 'stock.shelf'
			);
		$from = array('table' => 'stock');
		$join = array(
			'table1'		=> 'inputdetail',
			'condition1'	=> 'inputdetail.id = stock.inputdetailid',
			'table2'		=> 'product',
			'condition2'	=> 'product.id = inputdetail.productid',
			'table3'		=> 'brand',
			'condition3'	=> 'brand.id =  product.brandid'
			);
		$group = array(
			'group1' 		=> 'stock.locationid', 
			'group2'		=> 'inputdetail.productid'
			);

		$stocks = $this->stockmodel->get_items($select, $from, $join, false, $group);

		$data = array(
			'location'	=> $locations,
			'stock' 	=> $stocks);

		$this->load->view('logistics/stock/index', $data);
	}

	public function show($productid, $locationid)
	{
		$select = array(
			'stockid' 	=> 'stock.id',
			'productid' => 'inputdetail.productid',
			'detail' 	=> 'product.detail',
			'brand'		=> 'brand.name',
			'quantity'	=> 'stock.quantity',
			'pricet' 	=> 'unit_price.pri_qua',
			'quant'		=> 'unit_price.total_q',
			'lot'		=> 'inputdetail.lot',
			'fabdate'	=> 'inputdetail.fabdate',
			'expire'	=> 'inputdetail.expiredate'
			);
		$from = array('table' => 'stock');
		$join = array(
			'table1'		=> 'inputdetail',
			'condition1'	=> 'inputdetail.id = stock.inputdetailid',
			'table2'		=> 'product',
			'condition2'	=> 'product.id = inputdetail.productid',
			'table3'		=> 'brand',
			'condition3'	=> 'brand.id = product.brandid',
			'table4'		=> 'unit_price',
			'condition4'	=> 'unit_price.productid = inputdetail.productid'
			);
		$where = array('');
	}
}

/* End of file stock.php */
/* Location: ./application/controllers/logistics/stock.php */