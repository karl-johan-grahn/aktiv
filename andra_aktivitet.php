<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");

include('includes.class');

if(empty($_SESSION['anv']) || strcmp($_SESSION['admin'], "no") == 0) {
  print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>");

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

print("<?xml-stylesheet type='text/xsl' href='andra_aktivitet_web.xsl'?>");

if (!empty($_POST['andra']) &&
    !empty($_POST['timefrom_new']) &&
    !empty($_POST['timeto']) &&
    !empty($_POST['type']) &&
    !empty($_POST['place']) &&
    $_POST['adate_new']>=date("Y-m-d")) {
  $aktivitet = new Aktivitet();
  $aktivitet->andra_aktivitet($_POST['timefrom_old'], $_POST['timeto'],
                              $_POST['description'], $_POST['type'],
                              $_POST['place'], $_POST['adate_old'],
                              $_POST['contact'], $_POST['timefrom_new'],
                              $_POST['adate_new']);
}
if (!empty($_POST['andra_epost']) &&
    !empty($_POST['timefrom_new']) &&
    !empty($_POST['timeto']) &&
    !empty($_POST['type']) &&
    !empty($_POST['place']) &&
    $_POST['adate_new']>=date("Y-m-d")) {
  $aktivitet = new Aktivitet();
  $aktivitet->andra_aktivitet_epost($_POST['timefrom_old'], $_POST['timeto'],
                              $_POST['description'], $_POST['type'],
                              $_POST['place'], $_POST['adate_old'],
                              $_POST['contact'], $_POST['timefrom_new'],
                              $_POST['adate_new']);
}
if (!empty($_POST['radera'])) {
  $aktivitet = new Aktivitet();
  $aktivitet->radera_aktivitet($_POST['timefrom_old'], $_POST['adate_old'], $_POST['contact']);
}
?>

<activities xmlns='http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/'
   xmlns:xs='http://www.w3.org/2001/XMLSchema-instance'
   xs:schemaLocation=
     'http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/
      http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/activities.xsd'>

<?php
  $link = mysql_connect("localhost", "root", "")
           or die("Could not connect");
  mysql_select_db("doojil")
           or die("Could not select database");

  if (strcmp($_SESSION['admin'], "yes") == 0) {
    $query = "SELECT *
              FROM activity
              ORDER BY adate ASC";
  }
  if (strcmp($_SESSION['admin'], "no") == 0) {
    $query = "SELECT *
              FROM activity
              WHERE contact = '$anv'
              ORDER BY adate ASC";
  }
  $result = mysql_query($query);
  //         or die("Query failed");

  while ($line = mysql_fetch_object($result)) {
    print "<activity>\n";

    $string = strtotime($line->adate);
    $string = strftime("%Y-%m-%d", $string);
    print "<date>$string</date>\n";

    $string = $line->place;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<place>$string</place>\n";

    $string = $line->type;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<type>$string</type>\n";

    $string = $line->description;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<description>$string</description>\n";

    $timefrom = $line->timefrom;
    print "<timefrom>$timefrom</timefrom>\n";

    $string = $line->timeto;
    print "<timeto>$string</timeto>\n";

    $contact = $line->contact;
    print "<contact>\n";
    print "<username>$contact</username>\n";
    $query2 = "SELECT surname, familyname, email, phone
               FROM person
               WHERE username='$contact'";
    $result2 = mysql_query($query2)
      or die("Query failed");
    $line2 = mysql_fetch_object($result2);
    $string = $line2->surname;
    print "<surname>$string</surname>\n";
    $string = $line2->familyname;
    print "<familyname>$string</familyname>\n";
    $string = $line2->email;
    print "<email>$string</email>\n";
    $string = $line2->phone;
    print "<phone>$string</phone>\n";
    print "</contact>\n";

    print "</activity>\n\n";
  }
  mysql_free_result($result2);
  mysql_free_result($result);
  mysql_close($link);
?>
</activities>
