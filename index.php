<?php
    session_start();

    require 'database.php';
    // Atravez de el id vamos a adquirir todos los datos del usuario para validar la sesión
    //Esto traduce si existe una sesión realiza la siguiente consulta.
    //Con esta cunsulta es como traemos el resto de informacion del usuario.
    if (isset($_SESSION['user_id'])) {
      $records = $conn->prepare('SELECT id, email, password FROM user WHERE id = :id');
      $records->bindParam(':id', $_SESSION['user_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
      // Esto lo hacemos para posteriormente colocar estos datos en pantalla.
      //No solo sirve para esto tambien podemos jugar con estos datos.
      $user = null;

      if (count($results) > 0 ) {
        // User lleva los datos de usuario
        $user = $results;
      }
    }
?>

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
        <!-- Queremos mostrar difentes cosas en caso el usuario este o no loggueado -->
        <!-- Para eso vamos a usar este condicional que traduce: -->
        <!-- Si existe un usuario($user) o una sesión activa($_SESSION)
        muestre lo siguiente -->
        <?php if (!empty($user)): ?>
          <br>Welcome. <?= $user['email'] ?>
          <br>You are Successfully Logged In
          <!-- Este link lo utilizamos para matar o destruir la sesión -->
          <a href="logout.php">Logout</a>
          <!-- Si no existe un usuario y una sesión activa entonces muestre lo siguiente. -->
        <?php else: ?>
          <h1>Please Login or SignUp</h1>
          <!-- Con estas dos opciones podremos dejar que el usuario decida que hacer
          si quiere loguear en nuestra pagina. -->
          <a href="login.php">Login</a>
          <!-- O quiere registrarse. -->
          <a href="signup.php">Sing Up</a>
      <?php endif; ?>
  </body>
</html>
