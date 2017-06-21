<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('logistics/categorymodel');
	}

    public function index()
    {
    	$select = array(
    		'id'     => 'id', 
    		'nombre' => 'name'
    	);

    	$table = array('table' => 'category');
    	$where = array('flagstate' => 1);

        $categories = $this->categorymodel->get_items($select, $table, $where);

        $data  = array('category' => $categories);

        return $this->load->view('logistics/category/index', $data);
    }

    public function store()
    {
        $result = $this->categorymodel->insert('category', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $select = array('nombre' => 'name');
        $table  = array('table' => 'category');
        $where  = array('flagstate' => 1, 'id' => $id);

        $category  = $this->categorymodel->get_items($select, $table, $where);

        echo json_encode($category);
    }

    public function update($id)
    {
        $where  = array('flagstate' => 1, 'id' => $id);
        $result = $this->categorymodel->update('category', $where, $_POST);

        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('id' => $id);
        $state  = array('flagstate' => 0);

        $result =  $this->categorymodel->update('category', $where, $state);
        echo $result;
    }
}
