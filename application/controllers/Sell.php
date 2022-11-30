<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sell extends CI_Controller 
{
        public function __construct()
        {
                parent::__construct();                
                $this->load->model('Sell_Model');
                $this->load->model('Product_Model');	
                $this->load->library('form_validation');
        }

        public function update_stock ($id_producto,$cantidad)
        {
            $product = $this->Product_Model->getProduct($id_producto)[0];

            $stock_actual = $product->stock_producto - $cantidad;

            if($stock_actual >= 0){
                $update = $this->Product_Model->updateStock($id_producto,$stock_actual);
                return true;
            }else {
                return false;
            }
        }

        public function save_sell ()
        {
            $cantidad = $this->input->post('cantidad');
            $id_producto = $this->input->post('id_producto');
            
            if($this->update_stock($id_producto,$cantidad)){

                $dateTime = date('Y-m-d h:i:s', time());

                $sell = array(
                    'id_producto' => $id_producto,
                    'cantidad_venta' => $cantidad,                    		
                    'created_at' => $dateTime,
                );

                $response = $this->Sell_Model->createSell($sell);

                if($response > 0){
                    echo json_encode(array("status_code" => 200, "mensaje" => "Venta realizada correctamente.", "id" => $response ));
                }else {
                    echo json_encode(array("status_code" => 500, "mensaje" => "Ups, ocurrió un error tratanto de realizar esta venta"));
                }      
            }else {
                echo json_encode(array("status_code" => 400, "mensaje" => "No hay esa cantidad de productos disponibles para realizar la venta"));
            }
                                      
        }

        
	public function get_all_sell()
	{
		$data = $this->Sell_Model->getAllSells();
		echo json_encode($data);
	}
}