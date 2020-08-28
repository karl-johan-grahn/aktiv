<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");

$UA = getenv('HTTP_USER_AGENT');

include('includes.class');

if(empty($_SESSION['anv'])) {
  print("<?xml-stylesheet type='text/xsl' href='form-web.xsl'?>");
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
}

if (strcmp($_SESSION['admin'], "yes") == 0) {
  print("<?xml-stylesheet type='text/xsl' href='visa_aktiviteter_web_admin.xsl'?>");
}
if (strcmp($_SESSION['admin'], "no") == 0) {
  print("<?xml-stylesheet type='text/xsl' href='visa_aktiviteter_web.xsl'?>");
}

if (!empty($_POST['anmal'])) {
  $deltagare = new Deltagare();
  $deltagare->ny_deltagare($_POST['timefrom'], $_POST['contact'], $_POST['adate'], $anv);
}
if (!empty($_POST['avanmal'])) {
  $deltagare = new Deltagare();
  $deltagare->avanmal_deltagare($_POST['timefrom'], $_POST['contact'], $_POST['adate'], $anv);
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

  $query = "SELECT *
            FROM activity
            ORDER BY adate ASC";
  $result = mysql_query($query);
  //  or die("Query failed");

  while ($line = mysql_fetch_object($result)) {
    print "<activity>\n";

    $adate = strtotime($line->adate);
    $adate = strftime("%Y-%m-%d", $adate);
    print "<date>$adate</date>\n";

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
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<surname>$string</surname>\n";
    $string = $line2->familyname;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<familyname>$string</familyname>\n";
    $string = $line2->email;
    print "<email>$string</email>\n";
    $string = $line2->phone;
    print "<phone>$string</phone>\n";
    print "</contact>\n";

    $query3 = "SELECT username
               FROM participant
               WHERE participant.timefrom = '$timefrom' AND
                     participant.contact = '$contact' AND
                     participant.adate = '$adate'";
    $result3 = mysql_query($query3)
              or die("Query failed");

    while ($line3 = mysql_fetch_object($result3)) {
      $string = $line3->username;
      $query4 = "SELECT surname, familyname
                 FROM person
                 WHERE username = '$string'";
      $result4 = mysql_query($query4)
                or die("Query failed");
      $line4 = mysql_fetch_object($result4);
      $string = $line4->surname;
      $string = ereg_replace('å', '&#229;', $string);
      $string = ereg_replace('ä', '&#228;', $string);
      $string = ereg_replace('ö', '&#246;', $string);
      $string = ereg_replace('Å', '&#197;', $string);
      $string = ereg_replace('Ä', '&#196;', $string);
      $string = ereg_replace('Ö', '&#214;', $string);
      print("<participant>\n");
      print("<surname>$string</surname>\n");
      $string = $line4->familyname;
      $string = ereg_replace('å', '&#229;', $string);
      $string = ereg_replace('ä', '&#228;', $string);
      $string = ereg_replace('ö', '&#246;', $string);
      $string = ereg_replace('Å', '&#197;', $string);
      $string = ereg_replace('Ä', '&#196;', $string);
      $string = ereg_replace('Ö', '&#214;', $string);
      print("<familyname>$string</familyname>\n");
      print("</participant>\n");
    }
    print "</activity>\n\n";
  }
  mysql_free_result($result3);
  mysql_free_result($result2);
  mysql_free_result($result);
  mysql_close($link);
?>

</activities>
