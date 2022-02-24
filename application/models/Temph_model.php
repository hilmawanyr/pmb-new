<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temph_model extends CI_Model {

	function cek_regist($e,$t)
	{
		return $this->db->where('email', $e)->or_where('tlp', $t)->get('tbl_regist');
	}

	function cekGelombang()
	{
		$this->dbsia = $this->load->database('sia', TRUE);
		$this->dbsia->where('status', 1);
		return $this->dbsia->get('tbl_gelombang_pmb')->row()->gelombang;;
	}

	function angkatan()
	{
		$this->dbsia = $this->load->database('sia', TRUE);
		$this->dbsia->where('status', 1);
		return $this->dbsia->get('tbl_tahunakademik')->row_array();
	}

	function lastUser($exp)
	{
		error_reporting(0);
		$this->db->select('userid');
		$this->db->from('tbl_regist');
		$this->db->like('userid', $exp, 'after');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row()->userid;
	}

	function vrify_log($u)
	{
		$pass = crypt(sha1($u), regkey);
		$this->db->select('*');
		$this->db->from('tbl_user_login');
		$this->db->where('userid',$u);
		$this->db->where('password',$pass);
		return $this->db->get();
	}

	function cek_login($em,$pw)
	{
		$pass = md5($pw.regkey);
		$this->db->select('a.*,b.*, c.nm_depan, c.nm_belakang');
		$this->db->from('tbl_user_login a');
		$this->db->join('tbl_aktivasi b', 'a.userid = b.userid');
		$this->db->join('tbl_regist c', 'a.userid = c.userid');
		$this->db->where('a.email',$em);
		$this->db->where('b.flag', 1);
		$this->db->where('a.password',$pass);
		return $this->db->get();
	}

	function load_log($usr)
	{
		return $this->db->select('b.nm_depan,b.nm_belakang')
						->from('tbl_user_login a')
						->join('tbl_regist b','a.userid = b.userid')
						->where('a.userid',$usr)
						->get();
	}

	function chk_account($e,$p)
	{
		return $this->db->select('*')
						->from('tbl_regist')
						->where('email',$e)
						->where('tlp',$p)
						->where('status', 1)
						->get();
	}

	function load_account($e)
	{
		return $this->db->where('email', $e)->get('tbl_user_login');
	}

	function cek_vrif_log($u)
	{
		$this->db->select('*');
		$this->db->from('tbl_user_login');
		$this->db->where('email',$u);
		return $this->db->get();
	}

	function cek_status_valid($u)
	{
		$this->db->select('*');
		$this->db->from('tbl_regist');
		$this->db->where('email',$u);
		return $this->db->get();
	}

	function getdetail($tbl, $field, $id)
	{
		return $this->db->where($field, $id)
						->get($tbl);
	}

	function cek_akun($email){
		$this->db->select('lg.email as mail');
		$this->db->from('tbl_regist rg');
		$this->db->join('tbl_user_login lg', 'lg.userid = rg.userid', 'left');
		$this->db->where('rg.email', $email);
		$query = $this->db->get();

		return $query;
	}

	function cek_aktivasi($em)
	{
		return $this->db->select('flag')
						->from('tbl_aktivasi')
						->where('email',$em)
						->get();
	}

	function cariselisih($u,$p)
	{
		if ($p == 'MB') {
			$q = $this->db->query("SELECT tipe from tbl_fileupload where NOT EXISTS (SELECT * from tbl_fileupload where userid = '".$u."' and tipe IN )");	
		} elseif ($p == 'RM') {
			$q = $this->db->query("SELECT tipe from tbl_fileupload where userid = '".$u."' ")->result();
			$arr = array(1,2,3,7,11,12,13);
			
		} else {

		}
	}

}

/* End of file Temph_model.php */
/* Location: ./application/models/Temph_model.php */