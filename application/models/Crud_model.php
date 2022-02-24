<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function getDetail($tbl, $field, $id)
	{
		return $this->db->where($field, $id)->get($tbl);
	}

	function getData($tbl,$key,$sort)
	{
		return $this->db->order_by($key, $sort)->get($tbl);
	}

	function insertData($tbl,$data)
	{
		$this->db->insert($tbl, $data);
	}

	function delData($tbl,$field,$key)
	{
		$this->db->where($field, $key);
		$this->db->delete($tbl);
	}

	function updateData($tbl,$field,$key,$data)
	{
		$this->db->where($field, $key);
		$this->db->update($tbl, $data);
	}

	function updateMoreWhere($tbl,$arrField,$data)
	{
		$num = count($arrField);
		for ($i = 0; $i < $num; $i++) {
			$this->db->where(array_keys($arrField)[$i], array_values($arrField)[$i]);
		}
		$this->db->update($tbl, $data);
	}

	function getMoreWhere($tbl,$arr)
	{
		$num = count($arr);

		for ($i = 0; $i < $num; $i++) {

			$this->db->where(array_keys($arr)[$i], array_values($arr)[$i]);	
		}
		return $this->db->get($tbl);
	}

	function moreWhereIn($tbl,$fld,$in,$arr)
	{
		$num = count($arr);

		$this->db->where_in($fld, $in);

		for ($i = 0; $i < $num; $i++) {

			$this->db->where(array_keys($arr)[$i], array_values($arr)[$i]);

		}

		return $this->db->get($tbl);
	}

	function whereIn($tbl,$fld,$inn,$ord,$by)
	{
		$this->db->where_in($fld, $inn);

		$this->db->order_by($ord, $by);

		return $this->db->get($tbl);
	}

}

/* End of file Crud_model.php */
/* Location: ./application/models/Crud_model.php */