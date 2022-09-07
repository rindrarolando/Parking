<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Model{
	public function plusduree($date,$duree){
		$query = $this->db->query("SELECT '".$date."'+ ('".$duree."' * interval '1 minute') AS plus");
		$result = $query->row_array();
		return $result['plus'];
	}

	public function getDuree($duree){
		$query = $this->db->query("SELECT '00:00:00'+ ('".$duree."' * interval '1 minute') AS plus");
		$result = $query->row_array();
		return $result['plus'];
	}

	public function getNow(){
		$query = $this->db->query("SELECT isnow::timestamp FROM getnow WHERE id=1");
		$result = $query->row_array();
		if($result['isnow'] != null){
			return $result['isnow'];
		}else{
			return mdate('%Y-%m-%d %H:%i:%s', now());
		}
	}

	public function specifierGetNow($getnow){
		$data = array(
			'isnow' => $getnow
		);
		$this->db->where('id',1);
		$this->db->update('getnow',$data);
	}

	public function retirer(){
		$data = array(
			'isnow' => null
		);
		$this->db->where('id',1);
		$this->db->update('getnow',$data);
	}

}
