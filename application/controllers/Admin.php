<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('backoffice/login');
	}

	public function login(){
		$this->form_validation->set_rules('login','','required');
		$this->form_validation->set_rules('password','','required');

		if($this->form_validation->run() == FALSE){
			$error['error'] = null;
			$this->load->view('backoffice/login');
		}else{
			$login = $this->input->post('login');
			$pass = $this->input->post('password');
			if($this->Administrateur->login($login,$pass) != null){
				$admin = $this->Administrateur->login($login,$pass);	
				$this->session->set_userdata('session',$admin);
				redirect('admin/places');
			}else{
				$error['error'] = 'misy';
				$this->load->view('backoffice/login',$error);
			}
		}
	}

	public function places(){
		if($this->session->userdata('session') != null){
			$data['places'] = $this->Place->getPlaces();
 			$this->load->view('backoffice/place',$data);
		}else{
			redirect('admin');
		}
	}

	public function ajouterplace(){
		$this->Place->add();
		redirect('admin/places');
	}

	public function deleteplace($id){
		$this->Place->delete($id);
		redirect('admin/places');
	}

	public function validation(){
        if( ! $this->session->userdata('session')){
			redirect('admin');
		}else{
				$data['requests'] = $this->Utilisateur->getRequests();
				$this->load->view('backoffice/requests',$data);
			}
    }

	public function validate($id,$id_utilisateur){
		$request = $this->Utilisateur->getRequest($id);
        $utilisateur = $this->Utilisateur->getUtilisateur($id_utilisateur);
        $newsum = $request['amount'] + $utilisateur['money'];
        $this->Administrateur->validate_request($id);
		$this->Administrateur->validate_client($newsum,$id_utilisateur);
		//$this->Administrateur->validate_it($id,$newsum,$id_utilisateur);
        redirect('admin/validation');
    }

	public function simulation(){
		if($this->session->userdata('session') != null){
			$this->load->view('backoffice/formsimulation');
		}else{
			redirect('admin');
		}
	}

	public function simuler(){
		$this->form_validation->set_rules('simul','Date de simulation','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('backoffice/formsimulation');
		}else{
			$simul = $this->input->post('simul');
			$data = array(
				'simul' => $simul,
				'places' => $this->Place->getPlaces()
			);
			$this->load->view('backoffice/resultsimulation',$data);
		}
	}

	public function tarifs(){
		if( ! $this->session->userdata('session')){
			redirect('admin');
		}else{
				$data['tarifs'] = $this->Tarif->getTarifs();
				$this->load->view('backoffice/tarifs',$data);
			}
	}

	public function setnow(){
		if( ! $this->session->userdata('session')){
			redirect('admin');
		}else{
				
				$this->load->view('backoffice/setnow');
			}
	}

	public function specifier(){
		$this->form_validation->set_rules('getnow','GETNOW','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('backoffice/setnow');
		}else{
			$getnow = $this->input->post('getnow');
			$this->Time->specifierGetNow($getnow);
			redirect('admin/places');
		}
	}

	public function retirer(){
		$this->Time->retirer();
		redirect('admin/places');
	}

	public function logout(){
		if($this->session->userdata('session') != null){
			$this->session->unset_userdata('session');
			redirect('admin');
		}else{
			redirect('admin');
		}
		
	}
}
