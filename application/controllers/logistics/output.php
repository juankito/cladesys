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
        // exit(var_dump($this->input->get('search')));
        // var_dump($this->db->query('SELECT VERSION()')->result());
        $search = $this->input->get('search');
        $registros = $this->db->query(
            "SELECT output.*, ticket.name AS 'ticketName', l_out.name AS 'storageNameOut', l_in.name AS 'storageNameIn' 
            FROM output 
            LEFT JOIN ticket ON output.ticketid = ticket.id 
            LEFT JOIN location as l_out ON output.storageid_out = l_out.id 
            LEFT JOIN location as l_in ON output.storageid_in = l_in.id 
            WHERE ticket.name LIKE '%$search%' OR l_out.name LIKE '%$search%' OR l_in.name LIKE '%$search%'
            ORDER BY output.date DESC"
        )->result();
        exit(json_encode($registros));
    }
    public function create()
    {
        // exit(var_dump($this->input->post()));
        
        // params
        $params = $this->input->post();
        
        // validate
        // print_r($params);
        // exit;
        if(isset($params['detalles'])){
            // guardando en base de datos

            $cabecera = $params['cabecera'];
            if($cabecera['date'] === ''){
                $cabecera['date'] = date('y-m-d');
            }

            $this->db->query(
                "INSERT INTO `output` 
                (`id`, `ticketid`, `storageid_out`, `storageid_in`, `date`, `status`, `updated_at`, `added_at`) 
                VALUES 
                (NULL, '$cabecera[ticketId]', '$cabecera[storageIdOut]', '$cabecera[storageIdIn]', '$cabecera[date]', '1', NULL, CURRENT_TIMESTAMP);"
            );

            // obtener ultimo id
            $outputId = $this->db->insert_id();

            // registrar detalles
            $detalles = $params['detalles'];
            $sql = "INSERT INTO `outputdetail` 
                (`id`, `outputid`, `productid`, `unitprice`, `quantity`, `lot`, `updated_at`) 
                VALUES";
            foreach ($detalles as $key => $value) {
                $productId = $value['product']['id'];
                $sql .= "(NULL, '$outputId', '$productId', '$value[unitPrice]', '$value[quantity]', '$value[lot]', CURRENT_TIMESTAMP),";
            }
            $sql = substr($sql, 0, strlen($sql)-1) . ";";
            // exit($sql);
            $this->db->query($sql);
        }else{
            $this->output->set_status_header('400'); //Triggers the jQuery error callback
            exit("Error: no hay detalles de salida");
        }
    }
    public function delete()
    {
        if($this->input->get('id')){
            $id = $this->input->get('id');
            $this->db->query(
                "UPDATE `output` SET `status` = '0', `updated_at` = NULL WHERE `output`.`id` = $id;"
            );
        }
    }
    public function detail(){
        if($this->input->get('id')){
            $id = $this->input->get('id');
            $registros = $this->db->query(
                "SELECT output.*, ticket.name AS 'ticketName', l_out.name AS 'storageNameOut', l_in.name AS 'storageNameIn' 
                FROM output 
                LEFT JOIN ticket ON output.ticketid = ticket.id 
                LEFT JOIN location as l_out ON output.storageid_out = l_out.id 
                LEFT JOIN location as l_in ON output.storageid_in = l_in.id 
                WHERE output.id = '$id'
                ORDER BY output.date DESC"
            )->result()[0];
            $detalles = $this->db->query(
                "SELECT outputdetail.*, product.detail FROM outputdetail
                LEFT JOIN product ON outputdetail.productid = product.id
                WHERE outputdetail.outputid = 1"
            )->result();
            exit(json_encode([
                'cabecera' => $registros,
                'detalles' => $detalles
            ]));
        }
    }
}