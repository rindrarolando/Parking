<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parking extends CI_Model{
	public function getParkingOccupe($id_utilisateur,$id_place,$numero){
		$query = $this->db->query("SELECT * FROM parking WHERE id_utilisateur=".$id_utilisateur." AND id_place=".$id_place." AND numero_voiture='".$numero."' AND debut<='".$this->Time->getNow()."'::timestamp AND statut=false");
		return $query->row_array();
	}

	public function getParking($id){
		$query = $this->db->query("SELECT * FROM parking WHERE id=".$id);
		return $query->row_array();
	}

	public function getParkingByUser($id_utilisateur){
		$query = $this->db->query("SELECT * FROM parking WHERE id_utilisateur=".$id_utilisateur." AND statut=TRUE AND pay=TRUE ORDER BY fin DESC LIMIT 5");
		return $query->result();
	}

	public function getAmendesByUser($id_utilisateur){
		$query = $this->db->get_where('parking',array('id_utilisateur'=>$id_utilisateur,'amende'=>true));
		return $query->result();
	}
}
