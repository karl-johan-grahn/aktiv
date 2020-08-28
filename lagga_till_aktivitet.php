<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");
print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>\n");

include('includes.class');

if(empty($_SESSION['anv']) || strcmp($_SESSION['admin'], "no") == 0) {
  print("<html>\n");
  print("<head>\n");
  print("<title>Inte inloggad</title>\n");
  print("</head>\n");
  print("<body>\n");
  print("<p>Du m&#229;ste logga in och vara administrat&#246;r f&#246;r att komma &#229;t denna sida!</p>\n");
  print("<a href='inloggning.php'>Logga in</a>\n");
  print("</body>\n");
  print("</html>");
  die;
}
else {
  $anv = $_SESSION['anv'];
}
?>

<html>
  <head>
    <title>L&#228;gga till aktivitet</title>
  </head>
  <body>
    <h1>Aktiv\L&#228;gga till aktivitet</h1>
    <p>
      <a href='lagga_till_aktivitet.php'>L&#228;gga till aktivitet</a> |
      <a href='andra_aktivitet.php'>&#196;ndra en aktivitet</a> |
      <a href='visa_aktiviteter.php'>Visa aktiviteter</a> |
      <a href='andra_personuppgifter.php'>&#196;ndra personuppgifter</a> |
      <a href='logga_ut.php'>Logga ut</a>
    </p>

<?php
if (!empty($_POST['laggtill']) &&
    !empty($_POST['timefrom']) &&
    !empty($_POST['timeto']) &&
    !empty($_POST['type']) &&
    !empty($_POST['place']) &&
    $_POST['adate']>=date("Y-m-d")) {
  $aktivitet = new Aktivitet();
  $aktivitet->ny_aktivitet($_POST['timefrom'], $anv, $_POST['timeto'], $_POST['description'], $_POST['type'], $_POST['place'], $_POST['adate']);
}
if (!empty($_POST['epostinfo']) &&
    !empty($_POST['timefrom']) &&
    !empty($_POST['timeto']) &&
    !empty($_POST['type']) &&
    !empty($_POST['place']) &&
    $_POST['adate']>=date("Y-m-d")) {
  $aktivitet = new Aktivitet();
  $aktivitet->ny_aktivitet_epostinfo($_POST['timefrom'], $anv,
                                     $_POST['timeto'], $_POST['description'],
                                     $_POST['type'], $_POST['place'],
                                     $_POST['adate']);
}
if ((!empty($_POST['laggtill']) || !empty($_POST['epostinfo'])) &&
    (empty($_POST['timefrom']) ||
     empty($_POST['timeto']) ||
     empty($_POST['type']) ||
     empty($_POST['place']) ||
     $_POST['adate']<date("Y-m-d"))) {
  print("<p>Det blev ett fel n&#228;r du skulle l&#228;gga till aktivitet.</p>\n");
  print("<p>T&#228;nk p&#229; att fylla i alla obligatoriska f&#228;lt och att aktivitetens datum ligger i framtiden.</p>\n");
  print("</body>\n");
  print("</html>");
  die;
}
?>

    <p/>
    <form method="post" action="lagga_till_aktivitet.php">

      <b>Starttid (XX:XX:XX)*</b><br/>
      <input type="text" size="20" name="timefrom" maxlength="8"/><p/>

      <b>Sluttid (XX:XX:XX)*</b><br/>
      <input type="text" size="20" name="timeto" maxlength="8"/><p/>
		
      <p>Kort beskrivning av aktiviteten</p>
      <textarea rows="5" cols="30" name="description"></textarea><p/>

      <b>Typ av aktivitet*</b><br/>
      <input type="text" size="30" name="type"/><p/>
			
      <b>Plats*</b><br/>
      <input type="text" size="30" name="place"/><p/>

      <b>Datum (YYYY-MM-DD)*</b><br/>
      <input type="text" size="30" name="adate" maxlength="10"/><p/>
			
      <p>F&#228;lt som har tecknet * efter sig &#228;r obligatoriska.</p>
      <p>Du kan vara ansvarig f&#246;r h&#246;gst en (1) aktivitet vid ett givet datum och given starttid.</p>
      <p>Aktivitetens datum m&#229;ste vara idag eller i framtiden.</p>
      <p>Gamla aktiviteter raderas automatiskt.</p>
      <input type="submit" name="laggtill" value="L&#228;gg till"/><p/>
      <input type="submit" name="epostinfo" value="L&#228;gg till och informera alla via e-post"/>
    </form>

  </body>
</html>
