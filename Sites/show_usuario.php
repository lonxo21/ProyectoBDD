<?php include('templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("conexion.php");

  #Se obtiene el valor del input del usuario
    $rut = $_SESSION['rut'];
    $query = "select usuario.nombre, usuario.rut, usuario.edad, usuario.sexo, direccion.nombre, comuna.nombre, usuario,id 
    from usuario,residencia,direccion,comuna where usuario.rut='$rut' 
    and usuario.id=residencia.id_usuario and residencia.id_direccion=direccion.id and direccion.comuna=comuna.id;";
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
    $query = "select compras.id, tienda.nombre, direccion.nombre, direccion.comuna, productos.nombre, boleta.cantidad 
    from usuario, compras, tienda, direccion, productos 
    where usuario.rut='$rut' and compras.id_usuario = usuario.id and compras.id = boleta.id_compra and 
    boleta.id_producto=productos.id and compras.id_tienda=tienda.id and compras.id_direccion=direccion.id 
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