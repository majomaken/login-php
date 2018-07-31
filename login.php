<?php
// Esta es la manera de incializar una sesión con php.
// Esto es un metodo que permite validar si una session esta activa o no.
    session_start();
    // Con esto lo que hacemos es que si el usuario ya esta logueado no le muestre que se tenga
    // que volver a loguar ya que seria redundante
    if (isset($_SESSION['user_id'])) {
      header('Location: /Login-php-github');
    }
// Aqui solicitamos por medio de php la coneccion a la base de datos.
// Si no es exitosa muestra el error
// Si es exitosa aparentemente no pasara nada pero estaremos conectados.
    require 'database.php';
// Aqui hacemos el condicional que nos permite saber si los campos
// estan vacios o no, y apartir de esto nos genere la consulta de los datos para loguear.
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      // Recordemos que prepare lo que hace es ejecutar la consulta.
      //records(archivos) es solo la variable que vamos a utilizar para hacer la validacion
      // de la consulta
      $records = $conn->prepare('SELECT id, email, password FROM user WHERE email = :email');
      // Con esto remplazamos el email por el parametro que recibimos del formulario
      $records->bindParam(':email', $_POST['email']);
      // Aqui ejecutamos nuestra consulta
      $records->execute();
      //Esta es una manera segura de organizar los datos de la  consulta
      // Esto hace parte del PDO
      $results = $records->fetch(PDO::FETCH_ASSOC);

      // Si a ocurrido un error vamos a colocarlo a esta variable atravez del siguiente condicional.
      $message = '';

      // Validamos is el resultado no esta vacio
      //Count en php es un metodo que permite contar lo que hay en una variable
      //Por lo tanto decimos: Si los resultados son mayores a 0 y la contraseña
      //es verificada.
      //La contraseña la verificamos comparando lo que recibimos del metodo post con la contraseña
      //Que esta en la base de datos, recordemos que la variable results tiene la consulta.
      if (count($results) > 0 && password_verify($_POST['password'], $results['password']) ) {
        // Aqui asignamos en memoria una sesión donde se almacena el id del usuario.
        //Esto traduce: Si la verificacion de las contraseñas es correcta almacena un espacio
        //Y guardalo en una sesión.
        $_SESSION['user_id'] = $results['id'];
        //Y direccionalo a esta pagina.
        header('Location: /Login-php-github');
      } else {
        // Si la contraseña es incorrecta mesagge tendra el siguiente valor.
        $message = 'Sorry, Those credentials not match';
      }

    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <!-- Con este header lo que hacemos es darle un estilo de navegación a toda
    nuestra pagin web, haciendo de que predomine en todas las demas secciones. -->
    <!-- Esto es llamado una etiqueta php -->
    <?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

      <?php if (!empty($message)): ?>
        <p><?=  $message ?></p>
      <?php endif; ?>

      <!-- El atributo action es el lugar o la dirección a la cual se va emviar
      el formulario, por eso es tan importante. -->
      <!-- Como sabemos hay dos metodos para enviar nustro formulario
      el post y el get. Hay que tener cuidado con el get ya que la informació
      del formulario que se envia queda en la URL de nuestra pagin.
      Con post no pasa esto ya que los archivos se envian al servidor de una manera
      que no es publica. -->
      <form class="" action="login.php" method="post">
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter your password">
            <!-- Este boton de submit es importante y hay que tener en cuenta que el
            envia el evento a nuestro form. -->
            <input type="submit" value="Send">
      </form>

  </body>
</html>
