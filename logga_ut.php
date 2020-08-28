<?php
session_start();
session_unset();
session_destroy();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");
print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>\n");

include('includes.class');
?>

<html>
  <head>
    <title>Utloggad</title>
    <meta name="author" content="Karl-Johan Grahn" />
  </head>
  <body>
    <h1>Aktiv\Utloggad</h1>
    <p>
      <a href="inloggning.php">Logga in</a> |
      <a href="bli_medlem.php">Bli medlem</a>
    </p>
    <p>Du &#228;r utloggad.</p>
  </body>
</html>
