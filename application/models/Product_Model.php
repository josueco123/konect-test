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

    public function updateStock ($id_producto,$stock)
    {
        $dateTime = date('Y-m-d h:i:s', time());
        $this->db->set('stock_producto', $stock); 
		$this->db->set('updated_at', $dateTime); 
		$this->db->where('id_producto', $id_producto);
		$this->db->update('kc_productos'); 
		return $this->db->affected_rows();
    }

    public function getHighStock()
	{
		$sql = "SELECT *
                FROM kc_productos
                WHERE
                    stock_producto = (SELECT 
                            MAX(stock_producto)
                        FROM
                            kc_productos WHERE deleted_at IS NULL)
                            AND deleted_at IS NULL;";

        $query = $this->db->query($sql);

        return $query->result(); 
	}

    public function getProductHighSell ()
    {
        $sql = "SELECT SUM(cantidad_venta) AS cantidad, kc_productos.nombre_producto AS nombre 
                    FROM kc_ventas 
                    INNER JOIN kc_productos ON kc_productos.id_producto =kc_ventas.id_producto 
                    WHERE kc_productos.deleted_at IS NULL 
                    GROUP BY kc_ventas.id_producto 
                    ORDER BY cantidad DESC 
                    LIMIT 1;";

        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
}