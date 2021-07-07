<?php session_start(); ?>
<?php include('templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("conexion.php");

  #Se obtiene el valor del input del usuario
    $rut = $_SESSION['rut'];
    $query = "select usuario.nombre, usuario.rut, usuario.edad, usuario.sexo, direcciones_e3.nombre, direcciones_e3.comuna, usuario.id 
    from usuario,residencia,direcciones_e3 
    where usuario.rut='$rut' and usuario.id=residencia.id_usuario and residencia.id_direccion=direcciones_e3.id;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $resultado = $result -> fetch(1);
    echo "<p>Nombre:</p>";
    echo "<p>$resultado[0]</p>";
    echo "<p>Rut:</p>";
    echo "<p>$resultado[1]</p>";
    echo "<p>Edad:</p>";
    echo "<p>$resultado[2]</p>";
    echo "<p>Sexo:</p>";
    echo "<p>$resultado[3]</p>";
    echo "<p>Direccion</p>";
    echo "<p>$resultado[4] $resultado[5]</p>";
    echo "</br>";
    echo "</br>";
    $id_usuario = $resultado[6];
    $query = "select compras.id, tienda.nombre, direcciones_e3.nombre, direcciones_e3.comuna, productos.nombre, boleta.cantidad 
    from compras, tienda, direcciones_e3, productos 
    where compras.id_usuario = '$id_usuario' and compras.id = boleta.id_compra and 
    boleta.id_producto=productos.id and compras.id_tienda=tienda.id and compras.id_direccion=direcciones_e3.id 
    order by compras.id desc;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $resultado = $result -> fetchAll();
  ?>


  <table>
    <tr>
      <th>Id compra</th>
      <th>Tienda</th>
      <th>Direccion de entrega</th>
      <th>Producto</th>
      <th>Canidad</th>
    </tr>
  
      <?php
        // echo $pokemones;
        foreach ($resultado as $compra) {
          echo "<tr><td>$compra[0]</td><td>$compra[1]</td><td>$compra[2] $compra[3]</td><td>$compra[4]</td><td>$compra[5]</td></tr>";
      }
      ?>
      
  </table>

<?php include('templates/footer.html'); ?>