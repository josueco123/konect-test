<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Product_Model extends CI_model
{


	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

	}

    public function getProducts()
    {
        $this->db->select('*');
        $this->db->from('kc_productos');
        $this->db->where("deleted_at is null ");
        $this->db->order_by('id_producto','DESC');
        
        $query = $this->db->get();

        return $query->result();    
    }
}