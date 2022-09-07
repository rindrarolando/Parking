<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Model{
	public $id;
	public $nom;
	public $prenom;
    public $login;
	public $password;
    public $money;

	public function __construct()
	{
		
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}
	
	public function getNom()
	{
		return $this->nom;
	}

	public function setNom($nom)
	{
		$this->nom = $nom;

		return $this;
	}

	public function getPrenom()
	{
		return $this->prenom;
	}

	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;

		return $this;
	}

	public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }
    
	public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

	public function getUtilisateur($id){
        $query = $this->db->get_where('utilisateur',array('id' => $id));
        return $query->row_array();
    }

	public function getRequest($id){
        $query = $this->db->get_where('validation',array('id' => $id));
        return $query->row_array();
    }

    public function login($login,$password){
		$query = $this->db->get_where('utilisateur',array('login'=>$login,'password'=>md5($password)));
		$res = $query->row_array();
		if($res!=null){
			$utilisateur = new Utilisateur();
			$utilisateur->setId($res['id']);
            $utilisateur->setNom($res['nom']);
			$utilisateur->setPrenom($res['prenom']);
			$utilisateur->setLogin($res['login']);
			$utilisateur->setPassword($res['password']);
            $utilisateur->setMoney($res['money']);
			return $utilisateur;
		}else{
			return null;
		}
	}

    public function register($nom,$prenom,$login,$password){
        $data = array(
            'nom' => $nom,
			'prenom' => $prenom,
            'login' => $login,
            'password' => md5($password),
            'money' => 0 
        );
        $this->db->insert('utilisateur',$data);
    }

	public function add_money($id_utilisateur,$amount){
        $this->load->helper('date');
        $data = array(
            'id_utilisateur' => $id_utilisateur,
            'amount' => $amount,
            'statut' => false,
            'quand' => mdate('%Y-%m-%d %H:%i:%s', now())
        );
        $this->db->insert('validation',$data);
    }

	public function getAllRequestsToValidate(){
        $query = $this->db->query("SELECT *,m.id AS idreq FROM validation m JOIN utilisateur c ON m.id_utilisateur=c.id WHERE statut=FALSE");
        return $query->result();
    }

	public function getRequests(){
		$query = $this->db->query("SELECT *,m.id AS idreq FROM validation m JOIN utilisateur c ON m.id_utilisateur=c.id WHERE statut=false");
		return $query->result();
	}

	public function parknow($id_utilisateur,$id_place,$numero,$duree){
		$this->load->helper('date');
		$data = array(
			'id_utilisateur' => $id_utilisateur,
			'id_place' => $id_place,
			'numero_voiture' => $numero,
			'debut' => mdate('%Y-%m-%d %H:%i:%s', now()),
			'duree' => $duree,
			'fin' => null,
			'statut' => false,
			'pay' => true,
			'amende' => false
		);
		$this->db->insert('parking',$data);
	}

	public function parklater($id_utilisateur,$id_place,$numero,$debut,$duree){
		$data = array(
			'id_utilisateur' => $id_utilisateur,
			'id_place' => $id_place,
			'numero_voiture' => $numero,
			'debut' => $debut,
			'duree' => $duree,
			'fin' => null,
			'statut' => false,
			'pay' => true,
			'amende' => false
		);
		$this->db->insert('parking',$data);
	}

	public function checkMyPlace($id_utilisateur,$id_place){
		$query = $this->db->query("SELECT * FROM parking WHERE id_utilisateur=".$id_utilisateur." AND id_place=".$id_place." AND debut<='".$this->Time->getNow()."' AND statut=FALSE");
        $result= $query->result();
		if($result!=null){
			return true;
		}else{
			return false;
		}
	}

	public function soustraire_argent_client($duree,$id_utilisateur){
		$utilisateur = $this->Utilisateur->getUtilisateur($id_utilisateur);
		$argent = $this->Tarif->getAPayer($duree);

			$newsum = $utilisateur['money'] - $argent;
			$data = array(
				'money' => $newsum
			);
			$this->db->where('id',$id_utilisateur);
			$this->db->update('utilisateur',$data);
			return true;
	}

	public function sipeutpayer($duree,$id_utilisateur){
		$apayer = $this->Tarif->getAPayer($duree);
		$utilisateur = $this->Utilisateur->getUtilisateur($id_utilisateur);
		if($apayer>$utilisateur['money']){
			return false;
		}else{
			return true;
		}
	}

	public function sipeutpayeramende($id_utilisateur,$amende){
		$utilisateur = $this->Utilisateur->getUtilisateur($id_utilisateur);
		if($amende>$utilisateur['money']){
			return false;
		}else{
			return true;
		}
	}

	public function exitWithoutInfraction($id_parking,$fin){
		$data = array(
			'fin' => $fin,
			'statut' => true
		);
		$this->db->where('id',$id_parking);
		$this->db->update('parking',$data);
	}

	public function exitWithInfraction($id_parking,$fin){
		$data = array(
			'fin' => $fin,
			'statut' => true,
			'amende' =>true
		);
		$this->db->where('id',$id_parking);
		$this->db->update('parking',$data);
	}
    
}
