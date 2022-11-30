<div class="container bg-secondary" style="--bs-bg-opacity: .15;">
    <div class="row justify-content-center">
        <div class="col-md-12">

			<div class="card shadow-lg p-3 mb-5 bg-body rounded" style="margin-top: 15px;">
				
				<div class="card-body" >
					<h3 class="card-title text-center"><?= $editing == true ? 'Editar Producto' : 'Agregar Producto' ?></h3>
					<hr>
					<form class="row g-3" id="form-producto" name="form-producto" method="post">
                        <div class="col-md-6">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?= $editing == true ? $product->nombre_producto : '' ?>" required >                        
                        </div>
                        <div class="col-md-6">
                        <label for="categoria_producto">Categoria</label>
                        <select class="form-select" aria-label=".form-select-lg example" id="categoria_producto" name="categoria_producto">
                            <option <?php if( $editing == true && $product->categoria_producto == 'Celulares') echo "selected"?>  value="Celulares">Celulares</option>
                            <option <?php if( $editing == true && $product->categoria_producto == 'Televisores') echo "selected"?>  value="Televisores">Televisores</option>
                            <option <?php if( $editing == true && $product->categoria_producto == 'Computadores') echo "selected"?>  value="Computadores">Computadores</option>
                            <option <?php if( $editing == true && $product->categoria_producto == 'Electrodomesticos') echo "selected"?>  value="Electrodomesticos">Electrodomesticos</option>
                        </select>
                        
                        </div>
                        <div class="col-md-6">
                        <label for="referencia_producto">Referencia</label>
                        <input type="text" class="form-control" id="referencia_producto" name="referencia_producto" value="<?= $editing == true ? $product->referencia_producto : '' ?>" required>                        
                        </div>
                        <div class="col-md-6">
                        <label for="precio_producto">Precio</label>
                        <input type="number" class="form-control" id="precio_producto" name="precio_producto" value="<?= $editing == true ? $product->precio_producto : '' ?>" required>                        
                        </div>
                        <div class="col-md-6">
                        <label for="peso_producto">Peso</label>
                        <input type="number" class="form-control" id="peso_producto" name="peso_producto" value="<?= $editing == true ? $product->peso_producto : '' ?>" required>                        
                        </div>                        
                        <div class="col-md-6">
                        <label for="stock_producto">Stock (cantidades disponibles)</label>
                        <input type="number" class="form-control" id="stock_producto" name="stock_producto" value="<?= $editing == true ? $product->stock_producto : '' ?>" required>                        
                        </div>

                        <div class="col-12">
                        <?php if ($editing) { ?>
                            <button class="btn btn-primary evt-actualizar-producto" type="button" data-url-actualizar="<?= base_url("Products/update_product"); ?>" data-url-redirect="<?= base_url("Products"); ?>" data-id="<?= $product->id_producto ?>">Actualizar</button>
                        <?php } else { ?>
                            <button class="btn btn-primary evt-guardar-producto" type="button" data-url-guardar="<?= base_url("Products/save_product"); ?>" data-url-redirect="<?= base_url("Products"); ?>">Guardar</button>
                        <?php } ?>
                            
                        </div>
                    </form>
				</div>
				
			</div>
		
		</div>  
    </div>
</div>