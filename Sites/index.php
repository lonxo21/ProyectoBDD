<?php include('templates/header.html');   ?>


<body>

<h1 align= center> DCCuchau Delivery's </h1>

<h2 align="center"> <img src="http://assets.stickpng.com/images/59db69d33752880e93e16efc.png" width="800" height="400"> </h2>

<br>
<br>
<br>

<h3 align="center"> Inicio de Sesión </h3>

<form align= "center" action="login.php" method="post">

Rut:
<input type="text" name= "rut">
<br/>
Contraseña:
<input type="text" name= "contraseña">
<br/><br/>
<input type="Submit" value="Ingresar">
<button type="button" onclick="redirect('registro.php')"> Registrarse</button>
</form>


</body>










<?php include('templates/footer.html');   ?>