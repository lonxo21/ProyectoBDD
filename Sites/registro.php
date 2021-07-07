<?php include('templates/header.html');   ?>

<body>
  
<h3 align="center"> Registarse</h3>

<form align="center" action="creacion_usuarios.php" method="post">
    Nombre
    <input type="text" name="nombre" required>
    <br/><br/>
    Rut (sin puntos y con guion)
    <input type="text" name="rut" required pattern="^(\d{1,3}(?:\d{1,3}){2}-[\dkK])$" placeholder="11111111-1">
    <br/><br/>
    Edad
    <input type="number" name="edad" required>
    <br/><br/>
    Sexo
    <select name="sexo" required>
      <option value='' selected disabled>...</option> 
      <option value="hombre">Hombre</option> 
      <option value="mujer">Mujer</option>
      <option value="no binarie">No binarie</option>  
    </select>
    <br/><br/>
    Dirección
    <input type="text" name="direccion" required>
    <br/><br/>
    Comuna
    <select name="comuna" required>
    <option value='' selected disabled>...</option>
    <?php
    require("config/conexion.php");
    $query = "select nombre from comuna";
    $result = $db -> prepare($query);
    $result -> execute();
    $comunas = $result -> fetchAll();
    foreach ($comunas as $comuna) {
      echo "<option value='$comuna[0]'>$comuna[0]</option>";
    }
    ?>
    </select>
    <br/><br/>
    Contraseña
    <input type="password" name="contraseña" required minlength=6>
    <br/><br/>
    Confirmar contraseña
    <input type="password" name="contraseña_2" required minlength=6>
    <br/><br/>
    <input type="submit" value="Registrarme">
  </form>

<?php include('templates/footer.html');   ?>