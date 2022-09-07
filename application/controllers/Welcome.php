<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function test(){
		echo $this->Tarif->getAmende($this->Place->getTempsInfraction(6));
	}

	public function index()
	{
		if( ! $this->session->userdata('session_user')){
			$this->load->view('frontoffice/login');
		}else{
		
		redirect('welcome/acceuil');
		}
		
	}

	public function inscription(){
		$this->load->view('frontoffice/inscription');
	}

	public function acceuil(){
		
		if($this->session->userdata('session_user')!=null){
			$id_utilisateur = $this->session->userdata('session_user');
			$data['fortickets'] = $this->Parking->getParkingByUser($id_utilisateur);
			$data['amendes'] = $this->Parking->getAmendesByUser($id_utilisateur);
			$data['nblibre'] = 0;
			$data['nboccupe'] = 0;
			$data['nbinfraction']= 0;
		}else{
			$data['fortickets'] = null;
			$data['amendes'] = null;
			$data['nblibre'] = 0;
			$data['nboccupe'] = 0;
			$data['nbinfraction']= 0;
		}
		
		$data['places'] = $this->Place->getPlaces();
		$this->load->view('frontoffice/acceuil',$data);
	}

	public function alimentation(){
		if( ! $this->session->userdata('session_user')){
			redirect('welcome');
		}else{
			$id = $this->session->userdata('session_user');
			$utilisateur = $this->Utilisateur->getUtilisateur($id);
			$data['money'] = $utilisateur['money'];
			$id_utilisateur = $this->session->userdata('session_user');
			$data['fortickets'] = $this->Parking->getParkingByUser($id_utilisateur);
			if($this->session->flashdata('cannotpayamend')!=null){
				$data['flash'] = $this->session->flashdata('cannotpayamend');
			}else{
				$data['flash'] = null;
			}
			$this->load->view('frontoffice/ajoutargent',$data);
		
		}
	}

	public function alimenter(){
		$this->form_validation->set_rules('money','Montant','required|numeric');
        if($this->form_validation->run() == FALSE){
			
			$this->load->view('frontoffice/ajoutargent');
		}else{
            $money=$this->input->post('money');
            $id = $this->session->userdata('session_user');
			$utilisateur = $this->Utilisateur->getUtilisateur($id);
            try{
                $this->Utilisateur->add_money($utilisateur['id'],$money);
                redirect('welcome/alimentation');
            }catch(Exception $e){
				$data['money'] = $utilisateur['money'];
                $this->load->view('frontoffice/ajoutargent',$data);
            }
            
		}
	}

	public function exit($id){
		if( ! $this->session->userdata('session_user')){
			redirect('welcome');
		}else{
			//echo "ito : ".$id;
			$data['id'] = $id;
			$data['error'] = null;
			$id_utilisateur = $this->session->userdata('session_user');
			$data['fortickets'] = $this->Parking->getParkingByUser($id_utilisateur);
			$parking = $this->Parking->getParking($id);
			$data['amende'] = $this->Tarif->getAmende($this->Place->getTempsInfraction($parking['id']));
			$data['tempsinfraction'] = $this->Place->getTempsInfraction($parking['id']);
			$this->load->view('frontoffice/formexit',$data);
		}
	}

	public function quitter(){
		$this->form_validation->set_rules('id','','required|numeric');
		$this->form_validation->set_rules('fin','Heure de départ','required');
        if($this->form_validation->run() == FALSE){
			$data['error'] = 'not null';
			$this->load->view('frontoffice/formexit',$data);
		}else{
            $id_parking = $this->input->post('id');
			$parking = $this->Parking->getParking($id_parking);
			$fin = $this->input->post('fin');
			$utilisateur = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user'));
            try{
                if($this->Place->getEtatInfraction($parking['id_place'])==false){
					$this->Utilisateur->exitWithoutInfraction($parking['id'],$fin);
					redirect('welcome/acceuil?exit=1');
				}else{
					$amende = $this->Tarif->getAmende($this->Place->getTempsInfraction($parking['id']));
					if($this->Utilisateur->sipeutpayeramende($utilisateur['id'],$amende)==false){
						$this->session->set_flashdata('cannotpayamend','Solde insuffisant pour amende , veuillez avoir '.$amende.'ariary');
						redirect('welcome/alimentation');
					}else{
						$this->Utilisateur->exitWithInfraction($parking['id'],$fin);
						$this->Tarif->payerAmende($utilisateur['id'],$amende);
						redirect('welcome/acceuil?exit='.$amende.'ariary');
					}
				}
            }catch(Exception $e){
				redirect('welcome/acceuil?mbolatsyexit=1');
            }
            
		}
	}
}
