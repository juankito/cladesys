<?php if ( ! defined('BASEPATH')) exit('no direct script access allowed');

class ProductModel extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_items($select, $from, $join = false, $where = false, $group = false)
	{
		$this->db->select($select);
		$this->db->from($from);

		if($join != false)
		{
			for($i = 1; $i <= count($join)/2; $i++)
			{
				$this->db->join($join['table'.$i],$join['condition'.$i]);
			}
		}

		if($where != false)
		{
			$this->db->where($where);
		}

		if($group != false)
		{
			$this->db->group_by($group);
		}

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return false;
	}

	public function insert($table, $data)
	{
		$this->db->insert($table, $data);

		$restult = $this->db->affected_rows();

		return $result;
	}

	public function update($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);

		$result = $this->db->affected_rows();

		return $result;
	}

	public function delete($table, $where)
	{
		$this->db->delete($table, $where);

		$result = $this->db->affected_rows();

		return $result;
	}

	public function get_sum($select, $sum, $from, $where = false, $group = false)
	{
		$this->db->select($select);
		$this->db->select_sum($sum);
		$this->db->from($from);
		if ($where !=  false){
			$this->db->where($where);
		}
		if ($group != false){
			$this->db->group_by($group);
		}

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return false;
	}

}