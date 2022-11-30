
<div class="container bg-secondary" style="--bs-bg-opacity: .15;">
    <div class="row justify-content-center">
        <div class="col-md-12">
			
		<div class="row" style="margin-top: 15px;">
                        
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Producto con mayor Stock</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $highStock[0]->nombre_producto ?></div>
											<div class="h5 mb-0 text-gray-800"> Total: <?= $highStock[0]->stock_producto ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Producto más vendido</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $highSell[0]->nombre ?></div>
											<div class="h5 mb-0 text-gray-800"> Total: <?= $highSell[0]->cantidad ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                    </div>
					<div class="card shadow-lg p-3 mb-5 bg-body rounded" style="margin-top: 15px;">
					<h3 class="card-title text-center">Cantidad de Ventas</h3>
					<div id="chartdiv" style="height: 325px;"></div>
					</div>
		</div>  
    </div>
</div>