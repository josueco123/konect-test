<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sell_Model extends CI_model
{
    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

	}

    public function createSell($venta)
	{
		if($this->db->insert(" kc_ventas", $venta)){   
			$insert_id = $this->db->insert_id();
			return $insert_id;
		  } else {
			return false;
		  }
	}

	public function getAllSells()
    {
		$this->db->select('kc_productos.nombre_producto AS nombre, SUM(cantidad_venta) AS cantidad');
		$this->db->from('kc_ventas');
		$this->db->join("kc_productos", "kc_productos.id_producto =kc_ventas.id_producto ");
		$this->db->where("kc_productos.deleted_at IS NULL");
		$this->db->group_by("kc_ventas.id_producto");
        
        $query = $this->db->get();
                
        return $query->result();
    }
}