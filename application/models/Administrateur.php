<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateur extends CI_Model{
	public $id;
	public $login;
	public $password;

	public function __construct()
	{
		
	}

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of login
	 */ 
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * Set the value of login
	 *
	 * @return  self
	 */ 
	public function setLogin($login)
	{
		$this->login = $login;

		return $this;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	public function login($login,$password){
		$query = $this->db->get_where('administrateur',array('login'=>$login,'password'=>md5($password)));
		$res = $query->row_array();
		if($res!=null){
			$admin = new Administrateur();
			$admin->setId($res['id']);
			$admin->setLogin($res['login']);
			$admin->setPassword($res['password']);
			return $admin;
		}else{
			return null;
		}
	}

	public function validate_request($id){
		$updata=array(
			'statut' => true
		);
		$this->db->where('id',$id);
		$this->db->update('validation',$updata);
    }

	public function validate_client($newsum,$id_utilisateur){
        $updata=array(
			'money' => $newsum
		);
		$this->db->where('id',$id_utilisateur);
		$this->db->update('utilisateur',$updata);
	}

	public function validate_it($idrequest,$newsum,$id_utilisateur){
		$updata=array(
			'statut' => TRUE
		);
		$this->db->where('id',$idrequest);
		$this->db->update('validation',$updata);

		$updat=array(
			'money' => $newsum
		);
		$this->db->where('id',$id_utilisateur);
		$this->db->update('utilisateur',$updat);
	}
}
