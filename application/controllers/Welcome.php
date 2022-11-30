<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
  	{
      parent::__construct();
	  $this->load->model('Product_Model');
  	}
	

	public function index()
	{
		$data['highStock'] = $this->Product_Model->getHighStock();
		$data['highSell'] = $this->Product_Model->getProductHighSell();
		$this->load->view('layouts/header');
		$this->load->view('welcome_message', $data);
		$this->load->view('layouts/footer');
	}
}
