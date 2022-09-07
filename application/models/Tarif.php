<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Model{
	public function getTarifs(){
		$query = $this->db->get('tarif');
		return $query->result();
	}

	public function getTarif($id){
		$query = $this->db->get_where('tarif',array('id'=>$id));
		return $query->row_array();
	}

	public function add($duree,$prix){
		$data = array(
			'duree' => $duree,
			'prix' => $prix
		);
		$this->db->insert('tarif',$data);
	}

	public function delete($id){
		$this->db->query('DELETE FROM tarif WHERE id='.$id);
	}

	public function getAPayer($duree){
		$query = $this->db->query('SELECT prix FROM tarif WHERE duree='.$duree);
		$result = $query->row_array();
		return $result['prix'];
	}

	public function payerAmende($id_utilisateur,$amende){

		$utilisateur=$this->Utilisateur->getUtilisateur($id_utilisateur);
		
		$newsum =$utilisateur['money'] - $amende;
		$money = array(
			'money' => $newsum
		);
		$this->db->where('id',$id_utilisateur);
		$this->db->update('utilisateur',$money);
		
	}

	public function getAmende($tempsinfraction){
		$amende = 10000;
		$resultat = 10000;
		for($i=25;$i<$tempsinfraction;$i+=25){
			$resultat+=$amende;
			$amende+=$amende;
		}
		return $resultat;
	}
}
