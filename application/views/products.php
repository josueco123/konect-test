<div class="container bg-secondary" style="--bs-bg-opacity: .15;">
    <div class="row justify-content-center">
        <div class="col-md-12">

			<div class="card  shadow-lg p-3 mb-5 bg-body rounded" style="margin-top: 15px;">
				
				<div class="card-body">
					<h3 class="card-title text-center">Lista de Productos</h3>
          <button type="button" class="btn btn-primary btn-sm float-right evt-agregar">Agregar Producto</button>
					<hr>
					<div class="table-responsive">
          <table class="table"  id="products">
            <thead class="table-dark">
            <tr>
              <th>Nombre</th>
              <th>Referencia</th> 
              <th>Categoria</th>     
              <th>Peso</th>              
              <th>Stock</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
            </thead>
           
          </table>
				  </div>
				
			</div>
		
		</div>  
    </div>
</div>
     <!-- Modal vender producto -->
<div class="modal fade" id="venderModal" tabindex="-1" aria-labelledby="venderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="venderModalLabel">Vender Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-venta" name="form-venta" method="post">
          <div class="mb-3 ">
            <p class="fs-6 name_product"> </p>
          </div>
          <div class="mb-3">
            <p class="fs-6 referencia_producto"> </p>
          </div>
          <div class="mb-3">
            <p class="fs-6 stock"> </p>
          </div>
          <div class="mb-3">
            <p class="fs-6 precio_producto"> </p>
          </div>
          <div class="mb-2">
          <label for="cantidad">Cantidad</label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" required>
          <input type="hidden" class="form-control" id="id_producto" name="id_producto" >                               
          </div>          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary evt-guardar-venta" data-url-guardar="<?= base_url("Sell/save_sell"); ?>">Guardar</button>
      </div>
    </div>
  </div>
</div>
