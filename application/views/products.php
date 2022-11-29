<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div id="container">
<div class="table-responsive">
          <table id="legalizaciones" class="table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="5%">ID viat</th>
                <th width="20%">Nombres</th>                
              </tr>
            </thead>
<?php foreach ($products as $product) { ?>
    <tr>
                <td><?= $product->id_producto ?></td>
                <td><?= $product->nombre_producto ?></td>
                </tr>
    <?php } ?>
</div>

</body>
</html>