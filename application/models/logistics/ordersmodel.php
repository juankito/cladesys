<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_items($select, $from, $join = false, $where = false, $group = false)
	{
		$this->db->select($select);
		$this->db->from($from);
		if ($join != false){
			for($i = 1; $i <= count($join)/2; $i++){
				$this->db->join($join['table'.$i], $join['condition'.$i]);
			}
		}
		if ($where != false){
			$this->db->where($where);
		}
		if ($group != false){
			$this->db->group_by($group);
		}

		$query = $this->db->get();

		if ($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}

}

/* End of file ordersmodel.php */
/* Location: ./application/models/logistics/ordersmodel.php */