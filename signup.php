<?php
    // Aqui solicitamos por medio de php la coneccion a la base de datos.
    // Si no es exitosa muestra el error
    // Si es exitosa aparentemente no pasara nada pero estaremos conectados.
    require 'database.php';
    //Variable global
    $message = '';
    //Luego hacemos la siguiente condicional
    //Lo que traduce es: Si los campos que recibimos atravez del metodo post siendo
    //$_POST una variable predefinida en php
    //Los campos que escibimos como email y password son traidos atravez del atributo name
    //Por eso el name del imput es igual a lo que coloquemos para poder traer lo que escibimos
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      // La variable $sql almacena la consulta que aremos a la base de datos
      $sql = "INSERT INTO user (email,password) VALUES (:email, :password)";
      // Con la variable $stmt (statement=declaración) vamos a colocarle a la variable
      // $conn por medio del metodo prepare() que haga o ejecute la consulta de
      //inserción de los datos que la tenemos en la variable $sql
      $stmt = $conn->prepare($sql);
      //Necesitamos vincular lo parametros para que se consulten juntos en nuestra base
      //Lo que traduce esto seria: Atravez de esta declaracion atravez de vincular nuestros parametros
      //Remplazaremos la variable ':email' y ':password' por lo que recibamos atravez de el metodo $_POST
      //Todo esto es para poder almacenar nuestros datos en la base de datos
      $stmt->bindParam(':email',$_POST['email']);
      //Antes de que nuestra contraseña se guarde atraves de
      // vinculo de datos (antes que guarde los datos en la base)
      //Vamos a pasarla a una variable con un metodo de php llamado password_hash para poder cifrarlo
      //De esta manera la gente que tenga acceso a la base de datos de forma directa no podran ver le
      //clave de las personas que este registradas, esto es un metodo de seguridad.
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      //Aqui lo que recibimos $_POST ya a sido incriptado por en la variable $password
      //Por eso no lo colocamos a que lo guarde o vincule de manera directa si no que
      //escibimos la variable en la cual lo incriptamos
      $stmt->bindParam(':password',$password);
      //Con este condicional vamos a probar si se ejecuta(execute) de manera exitosa
      //Nuestra insercion de datos
      //Y le damos valos a la variable global $message para que posteriormente sepamos si se a o no
      //creado un nuevo usuario.
      if ($stmt->execute()) {
        $message = 'Successfully created new user';
      } else {
        $message = 'Sorry there must have been an issue creating your password';
      }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
     <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

      <?php require 'partials/header.php' ?>
      <!-- Aqui lo que decimos es: Si el mensaje($message) no esta vacio entonces
      escriba el valor del mensaje. -->
      <?php if (!empty($message)): ?>
        <!-- Para poder usar codigo de php dentro de html debemos interpretarlo y se hace
        colocando un '='-->
        <p> <?= $message ?> </p>
      <?php endif; ?>
      <h1>SignUp</h1>
      <span>or <a href="login.php">Login</a></span>
        <!-- El atributo action es el lugar o la dirección a la cual se va emviar
        el formulario, por eso es tan importante. -->
        <!-- Como sabemos hay dos metodos para enviar nustro formulario
        el post y el get. Hay que tener cuidado con el get ya que la informació
        del formulario que se envia queda en la URL de nuestra pagin.
        Con post no pasa esto ya que los archivos se envian al servidor de una manera
        que no es publica. -->
        <form action="signup.php" method="post">
              <input type="text" name="email" placeholder="Enter your email">
              <input type="password" name="password" placeholder="Enter your password">
              <!-- Este boton de submit es importante y hay que tener en cuenta que el
              envia el evento a nuestro form. -->
              <input type="submit" value="Send">
        </form>

  </body>
</html>
