<?php session_start(); ?>
<?php include('templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("config/conexion.php");
  if (isset($_POST["nombre"], $_POST["rut"], $_POST["edad"], $_POST["sexo"], $_POST["direccion"], $_POST["comuna"], 
  $_POST["contraseña"], $_POST["contraseña_2"]) and $_POST["nombre"] !="" 
  and $_POST["rut"]!="" and $_POST["edad"]!="" and $_POST["sexo"]!="" and $_POST["direccion"]!="" and $_POST["comuna"]!="" 
  and $_POST["contraseña"]!="" and $_POST["contraseña_2"]!=""){
    $repetido = FALSE;
    $query = "select rut from usuario;";
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado = $result -> fetchAll();
    foreach ($resultado as $rut) {
  		if ($rut[0]==$_POST["rut"]){
        $repetido=TRUE;
      }
	  }
    if ($repetido==FALSE){
      if ($_POST["contraseña"]==$_POST["contraseña_2"]){
        $nombre = $_POST["nombre"];
        $rut = $_POST["rut"];
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];
        $direccion = $_POST["direccion"];
        $comuna = $_POST["comuna"];
        $contraseña = $_POST["contraseña"];
        $query = "select id from usuario order by id desc limit 1;";
        $result = $db -> prepare($query);
        $result -> execute();
        $resultado = $result -> fetch(1);
        $id_usuario = (int)$resultado[0] + 1;
        $query2 = "select id from direcciones_e3 order by id desc limit 1;";
        $result2 = $db -> prepare($query2);
        $result2 -> execute();
        $resultado2 = $result2 -> fetch(1);
        $id_direccion = (int)$resultado2[0] + 1;
        $query3 = "INSERT INTO usuario (id, nombre, rut, edad, sexo, contraseña) VALUES ('$id_usuario', '$nombre','$rut','$edad', '$sexo', '$contraseña');";
        $query4 = "INSERT INTO direcciones_e3 (id, nombre, comuna) VALUES ('$id_direccion','$direccion', '$comuna');";
        $query5 = "INSERT INTO residencia (id_usuario, id_direccion) VALUES ('$id_usuario','$id_direccion');";
        $result3 = $db -> prepare($query3);
        if ($result3 -> execute()){
          $result4 = $db -> prepare($query4);
          if ($result4 -> execute()){
            $result5 = $db -> prepare($query5);
            if ($result5 -> execute()){
              echo "<p>Registro agregado.</p>";
              $_SESSION['rut']=$rut;
              echo "<meta http-equiv='refresh' content='3; URL=show_usuario.php' />";
            } else {
            echo "<p>No se pudo crear la cuenta(3)</p>";
            }
          } else {
            echo "<p>No se pudo crear la cuent(2)</p>";
          }
        } else {
          echo "<p>No se pudo crear la cuenta(1)</p>";
        }
      } else {
        echo "<p>Las contraseñas no coinciden</p>";
      }
    } else {
      echo "<p>Este rut ya esta registrado</p>";
    }
  } else {
    echo "<p>Un campo no fue llenado, por favor vuelva a intentarlo</p>";
  }
  ?>

<br>
<br>

<form action="registro.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>