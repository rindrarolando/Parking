<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timecontroller extends CI_Controller{
	public function getNow(){
		echo $this->Time->getNow();
	}
}
