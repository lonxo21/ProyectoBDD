<?php session_start(); ?>
<?php include('templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("conexion.php");
  if (isset($_POST["rut"], $_POST["contraseña"]) and $_POST["rut"] !="" 
  and $_POST["contraseña"]!=""){
    $rut = $_POST["rut"];
    $contraseña = $_POST["contraseña"];
    $query = "select rut, edad from usuario where rut='$rut';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $resultado = $result -> fetch(1);
    if ($rut==$resultado[0]){
        if ($contraseña==$resultado[1]){
          echo "<p> Ingreso completado </p>";
          $_SESSION['rut']=$rut;
          echo "<meta http-equiv='refresh' content='20;URL=show_usuario.php' />";
        } else {
          echo "<p>Contraseña incorrecta</p>";
        }
    } else {
        echo "<p>El usuario con este rut no existe</p>";
    }
  } else {
    echo "<p>Un campo no fue llenado, por favor vuelva a intentarlo</p>";
  }
  ?>

<?php include('templates/footer.html');   ?>