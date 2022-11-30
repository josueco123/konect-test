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

    public function getProduct($id_product)
    {
        $this->db->select('*');
        $this->db->from('kc_productos');
        $this->db->where("id_producto",$id_product);
        $this->db->where("deleted_at is null ");        
        
        $query = $this->db->get();

        return $query->result(); 
    }

    public function createProduct($product)
	{
		if($this->db->insert("kc_productos", $product)){   
			$insert_id = $this->db->insert_id();
			return $insert_id;
		  } else {
			return false;
		  }
	}

    public function updateProduct($id_producto,$product)
	{
		$this->db->where('id_producto', $id_producto);
		$this->db->update('kc_productos', $product);
		return $this->db->affected_rows();
	}

    public function deleteProduct ($id_producto)
    {
        $dateTime = date('Y-m-d h:i:s', time());
		$this->db->set('deleted_at', $dateTime); 
		$this->db->where('id_producto', $id_producto);
		$this->db->update('kc_productos'); 
		return $this->db->affected_rows();
    }
}