<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function login(){
		$this->form_validation->set_rules('login','','required');
		$this->form_validation->set_rules('password','','required');

		if($this->form_validation->run() == FALSE){
			$error['error'] = null;
			$this->load->view('frontoffice/login');
		}else{
			$login = $this->input->post('login');
			$pass = $this->input->post('password');
			if($this->Utilisateur->login($login,$pass) != null){
				$utilisateur = $this->Utilisateur->login($login,$pass);	
				$this->session->set_userdata('session_user',$utilisateur->id);
                
                redirect('welcome/acceuil');

			}else{
				$error['error'] = 'misy';
				$this->load->view('frontoffice/login',$error);
			}
		}
	}

	public function inscription(){
		$this->form_validation->set_rules('nom','','required');
		$this->form_validation->set_rules('prenom','','required');
		$this->form_validation->set_rules('login','','required');
		$this->form_validation->set_rules('password','','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('frontoffice/inscription');
		}else{
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$this->Utilisateur->register($nom,$prenom,$login,$password);
			redirect('welcome');
		}
	}

	public function parknow($id_place){
		if($this->session->userdata('session_user') != null){
			$id_utilisateur = $this->session->userdata('session_user');
			$data['fortickets'] = $this->Parking->getParkingByUser($id_utilisateur);
			$data['id'] = $id_place;
			$data['tarifs'] = $this->Tarif->getTarifs();
			$data['error'] = null;
			$this->load->view('frontoffice/formnow',$data);
		}else{
			redirect('welcome');
		}
		
	}

	public function validnow(){
		$this->form_validation->set_rules('id','','required|numeric');
		$this->form_validation->set_rules('numero','Numero','required|alpha_numeric');
		$this->form_validation->set_rules('duree','Durée envisagée','required|numeric');

		if($this->form_validation->run() == FALSE){
			$data['error'] = "not null";
			$this->load->view('frontoffice/formnow',$data);
		}else{
			//numero de la voiture
			$numero = $this->input->post('numero');

			//place choisie
			$id_place = $this->input->post('id');

			if($this->session->userdata('session_user') != null){
				if($this->Place->checkVoitureNow($id_place) == false){

					//utilisateur connecté
					$user = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user'));

					//tarif correspondant
					$duree = $this->input->post('duree');

					//insertion dans la table parking
					try{
						$this->Utilisateur->parknow($user['id'],$id_place,$numero,$duree);
						redirect('welcome/acceuil');
					}catch(Exception $e){
						redirect('welcome/acceuil?erreuranh');
					}
				}else{
					redirect('welcome/acceuil?tsyafaka');
				}
				
			}else{
				redirect('welcome');
			}

		}
	}

	public function parklater($id_place){
		if($this->session->userdata('session_user') != null){
			$id_utilisateur = $this->session->userdata('session_user');
			$data['fortickets'] = $this->Parking->getParkingByUser($id_utilisateur);
			$data['id'] = $id_place;
			$data['tarifs'] = $this->Tarif->getTarifs();
			$data['error'] = null;
			$this->load->view('frontoffice/formlater',$data);
		}else{
			redirect('welcome');
		}
	}

	

	public function validlater(){
		$this->form_validation->set_rules('id','','required|numeric');
		$this->form_validation->set_rules('numero','Numero','required|alpha_numeric');
		$this->form_validation->set_rules('debut','Début du stationnement','required');
		$this->form_validation->set_rules('duree','Durée envisagée','required|numeric');

		if($this->form_validation->run() == FALSE){
			$data['error'] = "not null";
			$data['tarifs'] = $this->Tarif->getTarifs();
			$this->load->view('frontoffice/formlater',$data);
		}else{
			//numero de la voiture
			$numero = $this->input->post('numero');

			//debut du stationnement
			$debut = $this->input->post('debut');

			//tarif correspondant
			$duree = $this->input->post('duree');

			//place choisie
			$id_place = $this->input->post('id');

			

			if($this->session->userdata('session_user') != null){
				//utilisateur connecté
				$user = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user'));
				if($this->Utilisateur->sipeutpayer($duree,$this->session->userdata('session_user'))==true){
					if($this->Place->checkVoitureLater($id_place,$debut,$duree) == false){

						//insertion dans la table parking
						try{
							$this->Utilisateur->soustraire_argent_client($duree,$this->session->userdata('session_user'));
							$this->Utilisateur->parklater($user['id'],$id_place,$numero,$debut,$duree);
							redirect('welcome/acceuil?nety=1');
						}catch(Exception $e){
							redirect('welcome/acceuil?erreuranh=1');
						}
					}else{
						redirect('welcome/acceuil?tsyafaka=1');
					}
				}else{
					redirect('welcome/alimentation');
				}
				
			}else{
				redirect('welcome');
			}

		}
	}

	public function logout(){
		if($this->session->userdata('session_user') != null){
			$this->session->unset_userdata('session_user');
			redirect('welcome');
		}else{
			redirect('welcome');
		}
		
	}
	
}







