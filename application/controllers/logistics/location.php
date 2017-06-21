<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('logistics/locationmodel');
	}

	public function index()
	{
		$select = array(
			'id' 		=> 'location.id', 
			'name'		=> 'location.name',
			'user'		=> 'user.name as user'
			);
		$from = array('table' => 'location');
		$join = array(
			'table1'	 => 'user',
			'condition1' => 'user.id = location.userid'
			);
		$where = array('location.flagstate' => 1);

		$locations = $this->locationmodel->get_items($select, $from, $join, $where);

		$data = array('location' => $locations);

		$this->load->view('logistics/location/index', $data);
	}

	public function store()
	{
		$result = $this->locationmodel->insert('location', $_POST);

		echo $result;
	}

	public function edit($id)
	{
		$select = array('name' => 'location.name');
		$from	= array('table' => 'location');
		$where	= array('location.flagstate' => 1, 'location.id' => $id);

		$location = $this->locationmodel->get_items($select, $from, false, $where, false);

		echo json_encode($location);
	}

	public function update($id)
	{
		$where = array('location.flagstate' => 1, 'location.id' => $id);
		$result = $this->locationmodel->update('location', $where, $_POST);

		echo $result;
	}

	public function destroy($id)
	{
		$where = array('id' =>$id);
		$state = array('flagstate' => 0);

		$result = $this->locationmodel->update('location',$where, $state);

		echo $result;
	}
}

/* End of file location.php */
/* Location: ./application/controllers/logistics/location.php */