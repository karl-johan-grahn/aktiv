<?php
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");
print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>\n");

include('includes.class');
?>

<html>
  <head>
    <title>Bli medlem</title>
    <meta name="author" content="Karl-Johan Grahn" />
  </head>
  <body>
    <h1>Aktiv\Bli medlem</h1>
    <p>
      <a href="inloggning.php">Logga in</a> |
      <a href="bli_medlem.php">Bli medlem</a>
    </p>
    <p/>
    <form method="post" action="bli_medlem.php">

      <b>Anv&#228;ndarnamn*</b><br/>
      <input type="text" size="20" name="anvandarnamn" maxlength="15"/><p/>

      <b>L&#246;senord*</b><br/>
      <input type="password" size="20" name="losenord" maxlength="15"/><p/>
		
      <p>F&#246;delsedatum (YYYY-MM-DD)</p>
      <input type="text" size="30" name="fodelsedatum" maxlength="10"/><p/>

      <b>F&#246;rnamn*</b><br/>
      <input type="text" size="30" name="fornamn"/><p/>
			
      <b>Efternamn*</b><br/>
      <input type="text" size="30" name="efternamn"/><p/>

      <b>Telefon*</b><br/>
      <input type="text" size="30" name="telefon"/><p/>
			
      <p>Kort beskrivning av dig sj&#228;lv</p>
      <textarea rows="5" cols="30" name="om"></textarea><p/>

      <b>E-post*</b><br/>
      <input type="text" size="30" name="epost"/><p/>

<p>F&#228;lt som har tecknet * efter sig &#228;r obligatoriska.</p>
<p>N&#228;r du registrerar dig godk&#228;nner du att ta emot e-post med information om aktiviteter. Dina personuppgifter blir endast tillg&#228;ngliga f&#246;r inloggade anv&#228;ndare av systemet.</p>

      <input type="submit" value="L&#228;gg till"/><p/>

    </form>

<?php
if(!empty($_POST['anvandarnamn']) &&
   !empty($_POST['losenord']) &&
   !empty($_POST['fornamn']) &&
   !empty($_POST['efternamn']) &&
   !empty($_POST['telefon']) &&
   !empty($_POST['epost'])) {
  $length = strstr($_POST['epost'], '@');
  $for = substr($length, 0, 1);
  if($for != "@") {
    print("<p>Din e-postadress m&#229;ste inneh&#229;lla ett @-tecken!</p>");
  }
  else {
    $medlem = new Medlem();
    $medlem->ny_medlem($_POST['anvandarnamn'], $_POST['losenord'], $_POST['fodelsedatum'], $_POST['fornamn'], $_POST['efternamn'], $_POST['telefon'], $_POST['om'], $_POST['epost']);
  }
}
?>

  </body>
</html>
