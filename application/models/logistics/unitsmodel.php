<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitsModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}

	public function get_items($select, $from, $join=false, $where=false)
	{
		$this->db->select($select);
		$this->db->from($from);

		if ($join!=false){
			for ($i=1; $i <= count($join)/2 ; $i++) {
				$this->db->join($join['table'.$i], $join['condition'.$i]);
			}
		}

		if($where!=false){
			$this->db->where($where);
		}

		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}

	public function insert($table, $data)
	{
		$this->db->insert($table, $data);

		$result = $this->db->affected_rows();

		return $result;
	}

	public function update($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);

		$result = $this->db->affected_rows();

		return $result;
	}
}

/* End of file storagemodel.php */
/* Location: ./application/models/logistics/storagemodel.php */