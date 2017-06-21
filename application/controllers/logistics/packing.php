<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packing extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('logistics/packingmodel');
	}

    public function index()
    {
        $select = array(
            'id'            => 'packing.id', 
            'packname'      => 'packs.name', 
            'factor'        => 'packing.factor',
            'parentid'      => 'packing.packingid', 
            'parnameid'     => 'p2.id',
            'parent'        => 'p3.name as parent'
            );

        $from = array('table'=>'packing');
        $join = array(
            'table1'        => 'packs',
            'condition1'    => 'packs.id = packing.packsid',
            'table2'        => 'packing as p2',
            'condition2'    => 'p2.id = packing.packingid',
            'table3'        => 'packs as p3',
            'condition3'    => 'p3.packsid = p2.packsid'
        );
        
        $group = array('group' => 'packing.id');

        $packings =  $this->packingmodel->get_items($select, $from, $join, false, $group);

        $data = array('packing' => $packings);

        return $this->load->view('logistics/packing/index', $data);
    }

    public function create()
    {

        $select = array(
            'id'            => 'packing.id', 
            'packname'      => 'packs.name', 
            'factor'        => 'packing.factor',
            'parent'        => 'p3.name as parent'
            );

        $from = array('table'=>'packing');
        $join = array(
            'table1'        => 'packs',
            'condition1'    => 'packs.id = packing.packsid',
            'table2'        => 'packing as p2',
            'condition2'    => 'p2.id = packing.packingid',
            'table3'        => 'packs as p3',
            'condition3'    => 'p3.id = p2.packsid'
        );
        
        $group = array('group' => 'packing.id');

        $packings =  $this->packingmodel->get_items($select, $from, $join, false, $group);

        $select1 = array(
                'id'    => 'packs.id',
                'name'  => 'packs.name'
            );
        $from1 = array('table' => 'packs');
        $where1 = array('packs.flagstate' => 1);

        $packs = $this->packingmodel->get_items($select1, $from1, false, $where1, false);

        $data = array(
            'packing'   => $packings,
            'pack'      => $packs
            );

        return $this->load->view('logistics/packing/create', $data);
    }

    public function storepack()
    {
        $result =$this->packingmodel->insert('packs', $_POST);
        echo $result;
    }

    public function store()
    {
        $data = array(
            'packid'         => $this->input->post('packs'),
            'factor'         => $this->input->post('factorC'),
            'packingid'      => $this->input->post('packings')
            );

        $result = $this->packingmodel->insert('packing', $data);
        echo $result;
    }

    public function edit($id)
    {
                
    }

    public function update($id)
    {
        $where  = array('flagstate' => 1, 'packsid' => $id);
        $result = $this->packingmodel->update('packs', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('packsid' => $id);
        $state  = array('flagstate' => 0);
        $result =  $this->packingmodel->update('packs', $where, $state);
        echo $result;
    }

}
