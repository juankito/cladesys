<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('logistics/inputmodel');
	}

	public function index()
	{
		$select = array(
			'id' 		=> 'input.id',
			'supplier'	=> 'supplier.companyname',
			'ticket'	=> 'ticket.name as ticket',
			'number'	=> 'input.ticketnumber',
			'date'		=> 'input.date',
			'status'	=> 'input.status',
			'price'		=> 'sum(inputdetail.quantity*inputdetail.unitprice) as price'
			);
		$from = array('table' => 'input');
		$join = array(
			'table1' 		=> 'supplier',
			'condition1'	=> 'supplier.id = input.supplierid',
			'table2'		=> 'ticket',
			'condition2'	=> 'ticket.id = input.ticketid',
			'table3'		=> 'inputdetail',
			'condition3'	=> 'inputdetail.inputid = input.id'
			);
		$group = array('group' => 'inputdetail.inputid');

		$inputs = $this->inputmodel->get_items($select, $from, $join, false, $group);

		$data = array('input' => $inputs);

		return $this->load->view('logistics/input/index', $data);
	}

	public function show($id)
	{
		$select = array(
			'id' 		=> 'input.id',
			'ticket'	=> 'ticket.name as ticket',
			'number'	=> 'input.ticketnumber',
			'date'		=> 'input.date',
			'status'	=> 'input.status',
			'company'	=> 'supplier.companyname',
			'supplier'	=> 'supplier.contactname',
			'phone'		=> 'supplier.phone',
			'total'		=> 'sum(inputdetail.quantity*inputdetail.unitprice) as total'
			);
		$from = array('table' => 'input');
		$join = array(
			'table1' 		=> 'ticket',
			'condition1' 	=> 'ticket.id = input.ticketid',
			'table2'		=> 'supplier',
			'condition2'	=> 'supplier.id = input.supplierid',
			'table3'		=> 'inputdetail',
			'condition3'	=> 'inputdetail.inputid = input.id'
			);
		$where = array('input.id' => $id);

		$inputs = $this->inputmodel->get_items($select, $from, $join, $where, false);

		$select = array(
			'detailid'	=> 'inputdetail.id',
			'productid'	=> 'inputdetail.productid',
			'detail'	=> 'product.detail',
			'brand'		=> 'brand.name as brand',
			'unitprice' => 'inputdetail.unitprice',
			'quantity'	=> 'inputdetail.quantity',
			'lot'		=> 'inputdetail.lot'
			);
		$from = array('table' => 'inputdetail');
		$join = array(
			'table1' 		=> 'product',
			'condition1'	=> 'product.id = inputdetail.productid',
			'table2'		=> 'brand',
			'condition2'	=> 'brand.id = product.brandid',
			);
		$where = array('inputdetail.inputid' => $id);

		$details = $this->inputmodel->get_items($select, $from, $join, $where, false);

		$data = array(
			'input'     => $inputs,
			'detail'	=> $details
			);

		return $this->load->view('logistics/input/show', $data);
	}

	public function viewdetail($id)
	{
		$select = array(
			'productid' => 'inputdetail.productid', 
			'detail'	=> 'product.detail',
			'brand'		=> 'brand.name as brand',
			'quantity'	=> 'inputdetail.quantity',
			'fabdate'	=> 'inputdetail.fabdate',
			'expire'	=> 'inputdetail.expiredate',
			'lot'		=> 'inputdetail.lot'
			);
		$from = array('table' => 'inputdetail');
		$join = array(
			'table1'		=> 'product',
			'condition1'	=> 'product.id',
			'table2'		=> 'brand',
			'condition2'	=> 'brand.id = product.brandid'
			);
		$where = array('inputdetail.productid' => $id);

		$products = $this->inputmodel->get_items($select, $from, $join, $where, false);

		$select = array(
			'id' 		=> 'stock.id as stockid',
			'location'	=> 'location.name as local',
			'quantity'	=> 'stock.quantity as stockq',
			'shelf'		=> 'stock.shelf',
			'update'	=> 'stock.updated_at'
			);
		$from = array('table' => 'stock');
		$join = array(
			'table1' 		=> 'location',
			'condition1'	=> 'location.id = stock.locationid',
			'table2'		=> 'inputdetail',
			'condition2'	=> 'inputdetail.id = stock.inputdetailid'
			);
		$where = array('inputdetail.productid' => $id);

		$stocks = $this->inputmodel->get_items($select, $from, $join, $where, false);

		$data = array(
			'product'  	=> $products,
			'stock'		=> $stocks
			);

		return $this->load->view('logistics/input/viewdetail', $data);
	}

	public function create()
	{
		$select = array(
			'supplierid' 	=> 'supplier.id as supplierid',
			'companyname'	=> 'supplier.companyname'
			);
		$from = array('table' => 'supplier');
		$where = array('supplier.flagstate' => 1);

		$suppliers = $this->inputmodel->get_items($select, $from, false, $where, false);

		$select = array(
			'ticketid' 	=> 'ticket.id as ticketid',
			'ticket' 	=> 'ticket.name'
			);
		$from = array('table' => 'ticket');
		$where = array('ticket.flagstate' => 1);

		$tickets = $this->inputmodel->get_items($select, $from, false, $where, false);

		$select = array(
			'productid' => 'product.id as productid',
			'detail'	=> 'product.detail'
			);
		$from = array('table' => 'product');
		$where = array('product.flagstate' => 1);

		$products = $this->inputmodel->get_items($select, $from, false, $where, false);

		$data = array(
			'supplier' 	=> $suppliers, 
			'ticket'	=> $tickets,
			'product'	=> $products
			);

		return $this->load->view('logistics/input/create', $data);
	}

	public function store()
	{
		$input = array(
			'ticketid' 		=> $this->input->post('ticket'),
			'supplierid'	=> $this->input->post('supplier'),
			'ticketnumber'	=> $this->input->post('ticketnumber'),
			'date'			=> $this->input->post('regdate')
			);

		$productid = $this->input->post('product');
		$unitprice = $this->input->post('price');
		$quantity = $this->input->post('quantity');
		$fabdate = $this->input->post('fabdate');
		$expiredate = $this->input->post('expiredate');
		$lot = $this->input->post('lot');

		try {
			$this->db->trans_begin();

			$this->db->insert('input', $input);
			for($i = 0; $i < count($productid); $i++){

				$inputdetail = array();
				$inputdetail = array('id' => $inputid[0]->id) + $inputdetail;
				$inputdetail['productid'] = $productid[$i];
				$inputdetail['unitprice'] = $unitprice[$i];
				$inputdetail['quantity'] = $quantity[$i];
				$inputdetail['fabdate'] = $fabdate[$i];
				$inputdetail['expiredate'] = $expiredate[$i];
				$inputdetail['lot']	= $lot[$i];

				$this->inputmodel->insert('inputdetail', $inputdetail);
			}

			if($this->db->trans_status() == FALSE){
				throw new Exception('Error al ingresar. Por favor vuelva a intentar.');
			}
			else{
				$this->db->trans_commit();
				echo $inputid[0]->id;
			}
		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo $e->getMessage();
		}
	}
}

/* End of file input.php */
/* Location: ./application/controllers/logistics/input.php */