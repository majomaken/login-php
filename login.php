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
