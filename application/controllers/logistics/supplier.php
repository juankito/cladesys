<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('logistics/suppliermodel');
	}

    public function index()
    {
        $select = array(
            'id'            => 'supplier.id',
            'companyname'   => 'supplier.companyname',
            'contactname'   => 'supplier.contactname',
            'abbreviation'  => 'identity.abbreviation',
            'number'        => 'supplier.idn_number',
            );

        $from = array('table' => 'supplier');

        $join = array(
            'table1'        => 'identity', 
            'condition1'    => 'identity.id = supplier.identityid'
            );

        $where = array('supplier.flagstate' => 1);

        $suppliers = $this->suppliermodel->get_items($select, $from, $join, $where);

        $data = array('supplier' => $suppliers);

        return $this->load->view('logistics/supplier/index', $data);
    }

    public function show($id)
    {
        $select = array(
            'id'        => 'supplier.id',
            'company'   => 'supplier.companyname',
            'contact'   => 'supplier.contactname',
            'address'   => 'supplier.address',
            'phone'     => 'supplier.phone',
            'postalcode'=> 'supplier.postalcode',
            'region'    => 'supplier.region',
            'country'   => 'supplier.country',
            'homepage'  => 'supplier.homepage',
            'email'     => 'supplier.email'
            );

        $from = array('table' => 'supplier');

        $where = array('supplier.flagstate' => 1, 'supplier.id' => $id);

        $suppliers = $this->suppliermodel->get_items($select, $from, false, $where);

        if(!empty($suppliers)){
            $data = array('supplier' => $suppliers);
            return $this->load->view('logistics/supplier/show', $data);
        }
    }

    public function edit($id)
    {
        $select = array(
            'id'        => 'supplier.id',
            'idcard'    => 'identity.id',
            'idnumber'  => 'supplier.idn_number',
            'company'   => 'supplier.companyname',
            'contact'   => 'supplier.contactname',
            'address'   => 'supplier.address',
            'phone'     => 'supplier.phone',
            'postalcode'=> 'supplier.postalcode',
            'region'    => 'supplier.region',
            'country'   => 'supplier.country',
            'homepage'  => 'supplier.homepage',
            'email'     => 'supplier.email'
            );

        $from = array('table' => 'supplier');

        $join = array(
            'table1'        => 'identity',
            'condition1'    => 'identity.id = supplier.identityid'
            );

        $where = array(
            'supplier.flagstate' => 1,
            'supplier.id'=> $id
            );

        $suppliers = $this->suppliermodel->get_items($select, $from, $join, $where);

        if(!empty($suppliers)){
            $this->load->model('logistics/identitymodel');

            $select = array(
                'id'            => 'identity.id',
                'abbreviation'  => 'identity.abbreviation'
                );

            $from = array('table' => 'identity');

            $where = array('identity.flagstate' => 1);

            $identities = $this->identitymodel->get_items($select, $from, $where);

            $data = array(
                'supplier' => $suppliers, 
                'identity' => $identities
                );
            return $this->load->view('logistics/supplier/edit', $data);
        }
    }

    public function store()
    {
        $data = array(
            'id'    => $this->input->post('identity'), 
            'idn_number'    => $this->input->post('numberI'),
            'companyname'   => $this->input->post('company'),
            'contactname'   => $this->input->post('contact'),
            'address'       => $this->input->post('address'),
            'postalcode'    => $this->input->post('zip'),
            'country'       => $this->input->post('country'),
            'region'        => $this->input->post('region'),
            'phone'         => $this->input->post('phone'),
            'homepage'      => $this->input->post('web'),
            'email'         => $this->input->post('email')
            );

        $result = $this->suppliermodel->insert('supplier', $data);
        echo $result;
    }

    public function create()
    {
        $this->load->model('logistics/identitymodel');

        $select = array(
            'id'            => 'id', 
            'abbreviation'  => 'abbreviation'
            );

        $from = array('table'   => 'identity');

        $where = array('flagstate' => 1);

        $identities = $this->identitymodel->get_items($select, $from, $where);

        $data = array('identity' => $identities);

        return $this->load->view('logistics/supplier/create', $data);
    }

    public function update($id)
    {
        $data = array(
            'id'            => $this->input->post('identity'), 
            'idn_number'    => $this->input->post('numberI'),
            'companyname'   => $this->input->post('company'),
            'contactname'   => $this->input->post('contact'),
            'address'       => $this->input->post('address'),
            'postalcode'    => $this->input->post('zip'),
            'country'       => $this->input->post('country'),
            'region'        => $this->input->post('region'),
            'phone'         => $this->input->post('phone'),
            'homepage'      => $this->input->post('web'),
            'email'         => $this->input->post('email')
            );

        $where = array('flagstate' => 1, 'id'   => $id);

        $restult = $this->suppliermodel->update('supplier', $where, $data);

        echo $result;
    }

    public function destroy($id)
    {
        $where = array('id' => $id);

        $data = array('flagstate'   => 0);

        $restul = $this->suppliermodel->update('supplier', $where, $data);

        echo $result;
    }
}