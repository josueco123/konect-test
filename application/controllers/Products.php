<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();                
                $this->load->model('Product_Model');	
                $this->load->library('form_validation');
        }

        public function index()
        {
                $this->load->view('layouts/header');
                $this->load->view('products');
                $this->load->view('layouts/footer');
        }

        public function getProducts(){

                $products = $this->Product_Model->getProducts();
		echo json_encode($products);
        
        }

        public function add_products()
        {
                $data['editing'] = false;
                $this->load->view('layouts/header');
                $this->load->view('form_products', $data);
                $this->load->view('layouts/footer');
        }

        public function save_product ()
        {
                $dateTime = date('Y-m-d h:i:s', time());

                $product = array(
			'nombre_producto' => $this->input->post('nombre_producto'),
			'categoria_producto' => $this->input->post('categoria_producto'),
			'referencia_producto' => $this->input->post('referencia_producto'),
			'precio_producto' => $this->input->post('precio_producto'),
			'peso_producto' => $this->input->post('peso_producto'),
			'stock_producto' => $this->input->post('stock_producto'),			
			'created_at' => $dateTime,
		);

                $response = $this->Product_Model->createProduct($product);

                if($response > 0){
                        echo json_encode(array("status_code" => 200, "mensaje" => "Producto agreado correctamente.", "id" => $response ));
                }else {
                        echo json_encode(array("status_code" => 500, "mensaje" => "Ups, ocurrió un error tratanto de guardar este producto"));
                }
                
                
        }

        public function edit_product ($id_product)
        {
                $data['editing'] = true;
                $data['product'] = $this->Product_Model->getProduct($id_product)[0];

                $this->load->view('layouts/header');
                $this->load->view('form_products', $data);
                $this->load->view('layouts/footer');
        }

        public function update_product ($id_product)
        {
                $dateTime = date('Y-m-d h:i:s', time());

                $product = array(
			'nombre_producto' => $this->input->post('nombre_producto'),
			'categoria_producto' => $this->input->post('categoria_producto'),
			'referencia_producto' => $this->input->post('referencia_producto'),
			'precio_producto' => $this->input->post('precio_producto'),
			'peso_producto' => $this->input->post('peso_producto'),
			'stock_producto' => $this->input->post('stock_producto'),			
			'updated_at' => $dateTime,
		);

                $response = $this->Product_Model->updateProduct($id_product,$product);

                if($response > 0){
                        echo json_encode(array("status_code" => 200, "mensaje" => "se actualizo el producto correctamente." ));
                }else {
                        echo json_encode(array("status_code" => 500, "mensaje" => "Ups, ocurrió un error tratanto de actualizar este producto"));
                }
                
                
        }

        public function delete_product ($id_product)
        {
                $response = $this->Product_Model->deleteProduct($id_product);

		if ($response > 0){
			
			echo json_encode(array("status_code" => 200, "mensaje" => "Producto elimindo con exito"));
		}else
			echo json_encode(array("status_code" => 401, "mensaje" => "Ups, ocurrió un error tratanto de eliminar este producto"));
        }

}