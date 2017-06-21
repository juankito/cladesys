<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('logistics/usermodel');
	}

    public function index()
    {
    	$select = array(
    		'id'     => 'id', 
    		'nombre' => 'name',
            'email'  => 'email',
            'tipo'   => 'type'
    	);

    	$from = array('table' => 'user');
    	$where = array('flagstate' => 1);

        $users = $this->usermodel->get_items($select, $from, $where);

        $data  = array('user' => $users);
        
        $this->load->view('logistics/user/index', $data);
    }

    public function create()
    {
        $select = array(
            'id'    => 'location.id',
            'name'  => 'location.name'
            );
        $from = array('table' => 'location');
        $where = array('location.flagstate' => 1);

        $locations = $this->usermodel->get_items($select, $from, $where);

        $data = array('location' => $locations);

        return $this->load->view('logistics/user/create', $data);
    }

    public function show($id)
    {
        $select = array(
            'name'      => 'user.name as user',
            'password'  => 'user.password',
            'email'     => 'user.email',
            'type'      => 'user.type',
            'update'    => 'user.updated_at',
            'added'     => 'user.added_at'
            );
        $from = array('table' => 'user');
        $where = array('id' => $id);

        $users = $this->usermodel->get_items($select, $from, $where);

        $select = array(
            'id'        => 'id',
            'location'  => 'name as location'
            );
        $from   = array('table' => 'location');
        $where  = array('location.userid' => $id);

        $locations = $this->usermodel->get_items($select, $from, $where);

        $data = array(
            'user' => $users,
            'location' => $locations
            );

        return $this->load->view('logistics/user/show', $data);
    }

    public function edit($id)
    {
        $select = array(
            'name'      => 'name',
            'password'  => 'password',
            'email'     => 'email',
            'type'      => 'type'
            );
        $from = array('table' => 'user' );
        $where = array('id' => $id);

        $users = $this->usermodel->get_items($select, $from, $where);

        $data = array('user' => $users);

        return $this->load->view('logistics/user/edit', $data);
    }

    public function store()
    {
        $result = $this->store->insert('store', $_POST);

        echo $result;
    }

    public function update($id)
    {
        $where  = array('flagstate' => 1, 'id' => $id);
        $result = $this->brand_m->update('user', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('id' => $id);
        $state  = array('flagstate' => 0);
        $result =  $this->brand_m->update('user', $where, $state);
        echo $result;
    }
}
