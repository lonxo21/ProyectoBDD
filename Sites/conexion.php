<?php
  try {
    $user = 'grupo24';
    $password = 'familiaperez24';
    $databaseName = 'grupo24e3';
    $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
    $user2 = 'grupo123';
    $password2 = 'grupo123';
    $databaseName2 = 'grupo123e3';
    $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>