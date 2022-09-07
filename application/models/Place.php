<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Model{
	public function getPlaces(){
		$query = $this->db->get('place');
		return $query->result();
	}

	public function getParks(){
		$query = $this->db->get('park');
		return $query->result_array();
	}

	public function getEtatPlace($id){
		$query = $this->db->query("SELECT * FROM parking WHERE id_place=".$id." AND debut<='".$this->Time->getNow()."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))>='".$this->Time->getNow()."'::timestamp AND statut=false");
		if($query->result() != null && $this->getEtatInfraction($id)==false){
			return "occupé";
		}if($this->getEtatInfraction($id)==true){
			return "infraction";
		}if($query->result() == null){
			return "disponible";
		}
	}

	public function simulerEtat($id_place,$dateheure){
		$query = $this->db->query("SELECT * FROM parking WHERE id_place=".$id_place." AND debut<='".$dateheure."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))>='".$dateheure."'::timestamp AND statut=false");
		if($query->result() != null){
			return "occupé";
		}else{
			return "disponible";
		}
	}

	public function getEtatInfraction($id){
		$query = $this->db->query("SELECT *,extract(epoch FROM('".$this->Time->getNow()."'::timestamp - debut::timestamp)) AS temps FROM parking WHERE id_place=".$id." AND debut<='".$this->Time->getNow()."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))<='".$this->Time->getNow()."'::timestamp AND statut=false");
		$result = $query->row_array();
		if($result != null){
			if($result['temps'] <= $result['duree']*60){
				return false;
			}if($result['temps'] > $result['duree']*60){
				return true;
			}
		}else{
			return false;
		}
	}

	public function getTempsRestant($id){
		if($this->getEtatPlace($id)=="occupé"){
			$query = $this->db->query("SELECT ((duree * '1 minute'::interval) + debut::timestamp)-('".$this->Time->getNow()."'::timestamp) AS temps FROM parking WHERE id_place=".$id." AND debut<='".$this->Time->getNow()."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))>='".$this->Time->getNow()."'::timestamp AND statut=false");
			$result = $query->row_array();
			return "Se termine dans: ".$result['temps'];
		}elseif($this->getEtatPlace($id)=="infraction"){
			$query = $this->db->query("SELECT '".$this->Time->getNow()."'::timestamp - ((duree * '1 minute'::interval) + debut::timestamp) AS temps FROM parking WHERE id_place=".$id." AND debut<='".$this->Time->getNow()."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))>='".$this->Time->getNow()."'::timestamp AND statut=false");
			$result = $query->row_array();
			return "En infraction de: ".$result['temps'];
		}elseif($this->getEtatPlace($id)=="disponible"){
			return null;
		}
	}

	public function getTempsInfraction($id_parking){
		$parking = $this->Parking->getParking($id_parking);
		if($this->getEtatPlace($parking['id_place'])=="infraction"){
			$query = $this->db->query("SELECT extract(epoch FROM(('".$this->Time->getNow()."'::timestamp)-((duree * '1 minute'::interval) + debut::timestamp))) AS temps FROM parking WHERE id=".$id_parking." AND statut=false");
			$result = $query->row_array();
			return $result['temps']/60;
		}
	}

	public function getVoiture($id){
		if($this->getEtatPlace($id)=="occupé" || $this->getEtatPlace($id)=="infraction"){
			$query = $this->db->get_where("parking",array('id_place' => $id));
			$result = $query->row_array();
			return $result['numero_voiture'];
		}else{
			return null;
		}
	}

	public function getArrivee($id){
		if($this->getEtatPlace($id)=="occupé" || $this->getEtatPlace($id)=="infraction"){
			$query = $this->db->get_where("parking",array('id_place' => $id));
			$result = $query->row_array();
			return $result['debut'];
		}else{
			return null;
		}
	}

	public function checkVoitureNow($id_place){
		$query = $this->db->query("SELECT * FROM parking WHERE id_place=".$id_place." AND debut<='".$this->Time->getNow()."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval))>='".$this->Time->getNow()."'::timestamp AND statut=false");
		$result = $query->result();
		if($result != null){
			return true;
		}else{
			return false;
		}
	}
	
	public function checkVoitureLater($id_place,$debut,$duree){
		//$query = $this->db->query("SELECT * FROM parking WHERE id_place=".$id_place." AND debut<='".$debut."'::timestamp AND (debut::timestamp + (duree * '1 minute'::interval) >= '".$debut."'::timestamp) OR ('".$debut."'::timestamp + ('".$duree."' * '1 minute'::interval)) >= debut::timestamp AND '".$debut."'::timestamp + ('".$duree."' * '1 minute'::interval)) <= (debut::timestamp + (duree * '1 minute'::interval))) AND statut=false");
		//$result = $query->result();
		if(1>2){
			return true;
		}else{
			return false;
		}
	}

	public function add(){
		$data = array(
			'description' => 'place'
		);
		$this->db->insert('place',$data);
	}

	public function delete($id){
		$this->db->query('DELETE FROM place WHERE id='.$id);
	}

}
