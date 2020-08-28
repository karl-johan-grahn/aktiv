<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");
print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>\n");

if(empty($_SESSION['anv'])) {
  print("<html>\n");
  print("<head>\n");
  print("<title>Inte inloggad</title>\n");
  print("</head>\n");
  print("<body>\n");
  print("<p>Du m&#229;ste logga in f&#246;r att komma &#229;t denna sida!</p>\n");
  print("<a href='inloggning.php'>Logga in</a>\n");
  print("</body>\n");
  print("</html>");
  die;
}
else {
  $anv = $_SESSION['anv'];
  $username = $_POST['username'];
}

include('includes.class');

if (!empty($_POST['radera'])) {
  $medlem = new Medlem();
  $medlem->radera_medlem($_POST['username']);
}
?>

<html>
  <head>
    <title>Ta bort medlem</title>
  </head>
  <body>
    <h1>Aktiv\Ta bort medlem</h1>
    <p>Vill du verkligen ta bort medlem med anv&#228;ndarnamn <?php print($username); ?>?</p>
    <form method="post" action="tabort_medlem.php">
      <input type="hidden" name="username" value="<?php print($username); ?>"/>
      <input type="submit" name="radera" value="Ta bort medlem och logga ut"/>
    </form>
    <form method="post" action="andra_personuppgifter.php">
      <input type="submit" value="&#197;ngra"/>
    </form>
  </body>
</html>
