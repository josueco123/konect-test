<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();                
                $this->load->model('Product_Model');	
                 
        }

        public function index()
        {
                $data['products'] = $this->Product_Model->getProducts();
                $this->load->view('products', $data);
        }
}