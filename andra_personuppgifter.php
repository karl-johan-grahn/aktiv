<?php
session_start();
header("Content-type:text/xml");
print("<?xml version='1.0'?>\n");

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
  print("<?xml-stylesheet type='text/xsl' href='andra_personuppgifter_web_admin.xsl'?>");
}
if (strcmp($_SESSION['admin'], "no") == 0) {
  print("<?xml-stylesheet type='text/xsl' href='andra_personuppgifter_web.xsl'?>");
}

if (!empty($_POST['spara']) &&
    !empty($_POST['surname']) &&
    !empty($_POST['familyname']) &&
    !empty($_POST['email']) &&
    !empty($_POST['phone'])) {
  $medlem = new Medlem();
  $medlem->andra_personuppgifter($_POST['username'], $_POST['password'], $_POST['surname'], $_POST['familyname'], $_POST['email'], $_POST['phone'], $_POST['about']);
}
?>

<members xmlns='http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/'
   xmlns:xs='http://www.w3.org/2001/XMLSchema-instance'
   xs:schemaLocation=
     'http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/
      http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/members.xsd'>

<?php
  $link = mysql_connect("localhost", "root", "")
           or die("Could not connect");
  mysql_select_db("doojil")
           or die("Could not select database");

  if (strcmp($_SESSION['admin'], "yes") == 0) {
  $query = "SELECT username, birthdate, surname, familyname,
                   phone, about, email
            FROM person";
  }
  if (strcmp($_SESSION['admin'], "no") == 0) {
  $query = "SELECT username, birthdate, surname, familyname,
                   phone, about, email
            FROM person
            WHERE username = '$anv'";
  }

  $result = mysql_query($query)
    or die("Query failed");

  while ($line = mysql_fetch_object($result)) {
    print "<person>\n";

    $string = $line->username;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<username>$string</username>\n";

    $string = $line->surname;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<surname>$string</surname>\n";

    $string = $line->familyname;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<familyname>$string</familyname>\n";

    $string = $line->email;
    print "<email>$string</email>\n";

    $string = $line->phone;
    print "<phone>$string</phone>\n";

    $string = $line->about;
    $string = ereg_replace('å', '&#229;', $string);
    $string = ereg_replace('ä', '&#228;', $string);
    $string = ereg_replace('ö', '&#246;', $string);
    $string = ereg_replace('Å', '&#197;', $string);
    $string = ereg_replace('Ä', '&#196;', $string);
    $string = ereg_replace('Ö', '&#214;', $string);
    print "<about>$string</about>\n";

    $string = strtotime($line->birthdate);
    $string = strftime("%Y-%m-%d", $birthdate);
    print "<birthdate>$string</birthdate>\n";

    print "</person>\n\n";
  }

  mysql_free_result($result);
  mysql_close($link);
?>

</members>
