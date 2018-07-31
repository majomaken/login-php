<!-- Antes de hacer esto debes crear la base de datos en phpmyAdmin. -->
<!-- Este es el script para crear la base de datos -->
<!-- CREATE DATABASE login;
CREATE TABLE `user`(
	id  INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) UNIQUE,
    `password` VARCHAR(200)
); -->
<?php
    // Con esto guardamos en una variable el nombre del servidor. En este caso
    // por defecto es localhost ya que por lo general apache corre en el puerto 80
    $server = 'localhost';
    // Este es el nombre que tenemos configurado por phpmyAdmin que también por lo general es 'root'
    $username = 'root';
    // Si queremos colocarle alguna clave a nuestra base de datos lo hacemos aqui pero hay que tener
    // en cuenta que también para cualquier entrada debemos tener nuestra contraseña En este caso la dejamos sin contraseña
    $password = '';
    // Aqui escribimos el nombre que le pusimos a nuestra base de datos cuando la creamos
    $database = 'login';

    try {
      // $con Es una variable de coneccion que nos va permitir validar
      // la coneccion a la base de datos atravez de un PDO
      // PDO (PHP Data Objects) es una libreria que nos permite conectarnos a nuestra base de datos
      // También es muy util a la hora de migrar a otro motor de base de datos
      // Esto tambien se puede hacer atravez de una funcion en php orientada a objetos
      $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
    } catch (PDOException $e) {
      // Si la coneccion a la base de datos no fue exitosa esto obtendra el error y no lo mostrara
      //die mata el proceso si la coneccion no es exitosa
      die('Connect failed: ' .$e->getMessage());

    }


?>
