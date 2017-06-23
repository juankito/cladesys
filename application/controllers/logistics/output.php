<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        // $this->load->model('logistics/inputmodel');
	}
    public function index()
    {
        // obtener los tickets
        $tickets = $this->db->query("SELECT * FROM ticket")->result();

        // obtener las localicaciones
        $locations = $this->db->query("SELECT * FROM location")->result();

        // obtener productos
        $products = $this->db->query("SELECT * FROM product")->result();

        // echo "<pre>";
        // exit(var_dump($products));

        $this->load->view('header');
        $this->load->view('topmenu');
        $this->load->view('sidemenu');
        $this->load->view('logistics/output/index', [
            'tickets' => $tickets,
            'locations' => $locations,
            'products' => $products
        ]);
        $this->load->view('footer');
        $this->load->view('logistics/output/scripts');
    }
    public function get()
    {
        // var_dump($this->db->query('SELECT VERSION()')->result());
        $registros = $this->db->query(
            "SELECT output.*, ticket.name AS 'ticketName', l_out.name AS 'storageNameOut', l_in.name AS 'storageNameIn' FROM output 
            LEFT JOIN ticket ON output.ticketid = ticket.id 
            LEFT JOIN location as l_out ON output.storageid_out = l_out.id 
            LEFT JOIN location as l_in ON output.storageid_in = l_in.id"
        )->result();
        exit(json_encode($registros));
    }
}