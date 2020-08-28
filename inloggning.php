<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");
print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>\n");

include('includes.class');
?>

<?php
if(!empty($_POST['anvandarnamn'])) {
  $inloggning = new Inloggning();
  $inloggning->logga_in($_POST['anvandarnamn'], $_POST['losenord']);
}
?>

<html>
  <head>
    <title>Logga in</title>
    <meta name="author" content="Karl-Johan Grahn" />
  </head>
  <body>
    <h1>Aktiv\Logga in</h1>
    <p>
      <a href="inloggning.php">Logga in</a> |
      <a href="bli_medlem.php">Bli medlem</a>
    </p>
    <p/>
    <form action="inloggning.php" method="post">
      <b>Anv&#228;ndarnamn</b><br/>
      <input type="text" size="20" name="anvandarnamn" maxlength="15"/>
      <p/>
      <b>L&#246;senord</b><br/>
      <input type="password" size="20" name="losenord" maxlength="15"/>
      <p/>
      <input type="submit" value="Logga in"/>
    </form>

  </body>
</html>
