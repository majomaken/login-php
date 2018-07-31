<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to (APP NAME)</title>
    <!-- Esta es un opcion para traer diferentes fuentes. Lo mejor que podemos hacer
    seria crear una carpeta /font para guardar un archivo con los links y llamarlo
    con php. Esa es una manera mas organizada de hacerlo. -->
     <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
     <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
  
      <!-- Con este header lo que hacemos es darle un estilo de navegación a toda
      nuestra pagin web, haciendo de que predomine en todas las demas secciones. -->
      <!-- Esto es llamado una etiqueta php -->
      <?php require 'partials/header.php' ?>

      <h1>Please Login or SignUp</h1>
      <!-- Con estas dos opciones podremos dejar que el usuario decida que hacer
      si quiere loguear en nuestra pagina. -->
      <a href="login.php">Login</a>
      <!-- O quiere registrarse. -->
      <a href="signup.php">Sing Up</a>
  </body>
</html>
