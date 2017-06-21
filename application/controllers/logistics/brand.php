<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('logistics/brandmodel');
	}

    public function index()
    {
    	$select = array(
    		'id'     => 'id', 
    		'nombre' => 'name'
    	);

    	$from = array('table' => 'brand');
    	$where = array('flagstate' => 1);

        $brands = $this->brandmodel->get_items($select, $from, $where);

        $data = array('brand' => $brands);

        $this->load->view('logistics/brand/index', $data);
    }

    public function store()
    {
        $result = $this->brandmodel->insert('brand', $_POST);

        echo $result;
    }

    public function edit($id)
    {
        $select = array('nombre' => 'name');
        $from  = array('table' => 'brand');
        $where  = array('flagstate' => 1, 'id' => $id);

        $brand  = $this->brandmodel->get_items($select, $from, $where);

        echo json_encode($brand);
    }

    public function update($id)
    {
        $where  = array('flagstate' => 1, 'id' => $id);
        $result = $this->brandmodel->update('brand', $where, $_POST);

        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('id' => $id);
        $state  = array('flagstate' => 0);

        $result =  $this->brandmodel->update('brand', $where, $state);

        echo $result;
    }

}
