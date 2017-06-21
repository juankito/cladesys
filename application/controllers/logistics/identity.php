<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identity extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        $this->load->model('logistics/identitymodel');
	}

    public function index()
    {
        $select = array(
            'id'          => 'id',
            'abreviacion' => 'abbreviation',
            'nombre'      => 'name'
        );

        $from          = array('table' => 'identity');
        $where         = array('flagstate' => 1);

        $identities = $this->identitymodel->get_items($select, $from, $where);

        $data       = array('identity' => $identities);

        return $this->load->view('logistics/identity/index', $data);
    }

    public function store()
    {
        $result = $this->identitymodel->insert('identity', $_POST);
        echo $result;
        //echo "<pre>"; print_r($_POST); echo "</pre>";
    }

    public function edit($id)
    {
        $select = array(
            'abreviacion' => 'abbreviation',
            'nombre'      => 'name'
        );

        $from  = array('table' => 'identity');

        $where  = array(
            'flagstate' => 1, 
            'id' => $id
        );

        $identity  = $this->identitymodel->get_items($select, $from, $where);

        echo json_encode($identity);
    }

    public function update($id)
    {
        $where  = array('flagstate' => 1, 'id' => $id);

        $result = $this->identitymodel->update('identity', $where, $_POST);

        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('id' => $id);
        $data   = array('flagstate' => 0);

        $result =  $this->identitymodel->update('identity', $where, $data);

        echo $result;
    }
}
