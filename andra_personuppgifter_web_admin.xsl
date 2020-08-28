<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:members="http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/">

  <xsl:template match="members:members">
   <html>
    <head>
      <title>&#196;ndra personuppgifter</title>
      <style>
        body {
          background:#ffffff;
          color:#000;
          margin:1cm;
          padding:0;
          border:0;
          font-family:Verdana, Arial, Helvetica, sans-serif;
        }

        h1 {
          color: #003366;
          font-family: Verdana, Arial, Helvetica, sans-serif;
          font-size: 21pt;
          background-color: #ffffff;
          font-weight: normal;
        }

        p {
          color: #000000;
          font-family: Times, Verdana, Arial, Helvetica, sans-serif;
          font-size: 12pt;
        }

        a {
          color:#0000ff;
          font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        * {
          background-color: #ffffff;
        }
      </style>
    </head>
    <body>
      <h1>Aktiv\&#196;ndra personuppgifter</h1>
      <p>
        <a href="lagga_till_aktivitet.php">L&#228;gga till aktivitet</a> |
        <a href="andra_aktivitet.php">&#196;ndra en aktivitet</a> |
        <a href="visa_aktiviteter.php">Visa aktiviteter</a> |
        <a href="andra_personuppgifter.php">&#196;ndra personuppgifter</a> |
        <a href="logga_ut.php">Logga ut</a>
      </p>
      <xsl:apply-templates select="members:person" />
    </body>
   </html>
  </xsl:template>

  <xsl:template match="members:person">
    <p/>
    <form method="post" action="andra_personuppgifter.php">
      <b>Anv&#228;ndarnamn: </b>
      <xsl:value-of select="members:username"/><p/>
      <input type="hidden" name="username" value="{members:username}"/>

      <b>L&#246;senord</b><br/>
      <input type="password" size="20" name="password" maxlength="15"/><p/>

      <b>F&#246;rnamn</b><br/>
      <input type="text" size="30" name="surname" value="{members:surname}"/><p/>

      <b>Efternamn</b><br/>
      <input type="text" size="30" name="familyname" value="{members:familyname}"/><p/>
      <b>E-post</b><br/>
      <input type="text" size="30" name="email" value="{members:email}"/><p/>

      <b>Telefon</b><br/>
      <input type="text" size="30" name="phone" value="{members:phone}"/><p/>

      <p>Kort beskrivning av dig sj&#228;lv*</p>
      <textarea rows="5" cols="30" name="about"><xsl:value-of select="members:about"/></textarea><p/>
<p>F&#228;lt som har tecknet * efter sig &#228;r inte obligatoriska.</p>
<p>Om f&#228;ltet l&#246;senord l&#228;mnas tomt &#228;ndras inte ditt l&#246;senord. Om f&#228;ltet d&#228;remot inneh&#229;ller n&#229;gon text blir det ditt nya l&#246;senord.</p>
      <input type="submit" name="spara" value="Spara uppgifter"/>
    </form>
    <form method="post" action="tabort_medlem.php">
      <input type="hidden" name="username" value="{members:username}"/>
      <input type="submit" name="radera_meny" value="Ta bort medlem"/>
    </form>
  </xsl:template>

  <xsl:template match="members:surname">
  </xsl:template>

  <xsl:template match="members:familyname">
  </xsl:template>

  <xsl:template match="members:email">
  </xsl:template>

  <xsl:template match="members:phone">
  </xsl:template>

  <xsl:template match="members:about">
  </xsl:template>

</xsl:stylesheet>
