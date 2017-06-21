<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PackingModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}

	public function get_items($select, $from, $join = false, $where = false, $group = false)
	{
		$this->db->select($select);
		$this->db->from($from);

		if ($join!=false){
			for ($i=1; $i <= count($join)/2 ; $i++) {
				$this->db->join($join['table'.$i], $join['condition'.$i], 'left');
			}
		}

		if ($where!=false){
			$this->db->where($where);
		}

		if ($group!=false){
			$this->db->group_by($group);
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