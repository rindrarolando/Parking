<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifcontroller extends CI_Controller {

	public function ajout(){
		if( ! $this->session->userdata('session')){
			redirect('admin');
		}else{
				
				$this->load->view('backoffice/ajouttarif');
			}
	}

	public function modification($id){
		$tarif = $this->Tarif->getTarif($id);
		$data = array(
			'id' => $tarif['id'],
			'duree' => $tarif['duree'],
			'prix' =>$tarif['prix']
		);
		$this->load->view('backoffice/modifiertarif',$data);
	}

	public function modifier(){
		$this->form_validation->set_rules('id','','required|numeric');
		$this->form_validation->set_rules('duree','','required|numeric');
		$this->form_validation->set_rules('prix','','required|numeric');

		if($this->form_validation->run() == FALSE){
			
			redirect('admin/tarifs');
		}else{
			$id = $this->input->post('id');
			$duree = $this->input->post('duree');
			$prix = $this->input->post('prix');
			
			$data = array(
				'duree' => $duree,
				'prix' => $prix
			);
			$this->db->where('id',$id);
			$this->db->update('tarif',$data);
			redirect('admin/tarifs');
		}
	}

	public function add(){
		$this->form_validation->set_rules('duree','','required|numeric');
		$this->form_validation->set_rules('prix','','required|numeric');

		if($this->form_validation->run() == FALSE){
			
			$this->load->view('backoffice/ajouttarif');
		}else{
			$duree = $this->input->post('duree');
			$prix = $this->input->post('prix');
			
			$this->Tarif->add($duree,$prix);
			redirect('admin/tarifs');
		}
	}

	public function delete($id){
		$this->Tarif->delete($id);
		redirect('admin/tarifs');
	}

	public function ticket($id_parking){
		$parking = $this->Parking->getParking($id_parking);
		if($parking['amende']==true){
			$amende = '150000 ariary';
		}else{
			$amende = '0 ariary';
		}
		$data = array(
			'fortickets' => $this->Parking->getParkingByUser($this->session->userdata('session_user')),
			'reference' => $parking['id'],
			'immatriculation' => $parking['numero_voiture'],
			'date' => $parking['debut'],
			'lieu' => 'Antananarivo 101',
			'prix' => $this->Tarif->getAPayer($parking['duree']),
			'amende' => $amende

 		);
		if($this->session->userdata('session_user')){
			$this->load->view('frontoffice/ticket',$data);
		}else{
			redirect('welcome');
		}
	}

	public function payeramende($id_parking,$id_utilisateur){
		if($this->Tarif->payerAmende($id_parking,$id_utilisateur)==true){
			redirect('welcome/acceuil?payé=1');
		}else{
			redirect('welcome/alimentation');
		}
	}
}
