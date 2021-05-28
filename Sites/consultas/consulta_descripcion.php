<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $descripcion = $_POST["descripcion"];
  $descripcion_b = strtolower($descripcion);
  if (strlen($descripcion_b)==0) {
    echo '<p style="text-align:center;">No ingresaste una descripcion, te mostramos todos los usuarios que compraron productos</p>';
  }
 	$query = "select distinct usuario.id,usuario.nombre,usuario.rut,usuario.edad,usuario.sexo,productos.nombre from usuario, compras, boleta, productos where usuario.id=compras.id_usuario AND compras.id=boleta.id_compra AND boleta.id_producto=productos.id AND productos.descripcion like '%$descripcion_b%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th>Producto</th>
    </tr>
  <?php
	foreach ($usuarios as $usuario) {
  		echo "<tr><td>$usuario[0]</td><td>$usuario[1]</td><td>$usuario[2]</td><td>$usuario[3]</td><td>$usuario[4]</td><td>$usuario[5]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>