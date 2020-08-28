<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:activities="http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/">

  <xsl:template match="activities:activities">
   <html>
    <head>
      <title>Aktiviteter</title>
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
      <h1>Aktiv\Aktiviteter</h1>
      <p>
        <a href="lagga_till_aktivitet.php">L&#228;gga till aktivitet</a> |
        <a href="andra_aktivitet.php">&#196;ndra en aktivitet</a> |
        <a href="visa_aktiviteter.php">Visa aktiviteter</a> |
        <a href="andra_personuppgifter.php">&#196;ndra personuppgifter</a> |
        <a href="logga_ut.php">Logga ut</a>
      </p>
      <xsl:apply-templates select="activities:activity" />
    </body>
   </html>
  </xsl:template>

  <xsl:template match="activities:activity">
    <p/>
    <xsl:apply-templates select="activities:type"/>
    <xsl:apply-templates select="activities:date"/>
    <xsl:apply-templates select="activities:place"/>
    <xsl:apply-templates select="activities:timefrom"/>
    <xsl:apply-templates select="activities:timeto"/>
    <xsl:apply-templates select="activities:description"/>
    <xsl:apply-templates select="activities:contact"/>

    <br/>
    <b>Deltagare: </b>
    <xsl:for-each select="activities:participant">
      <xsl:if test="position()=1"/>
      <xsl:if test="position()>1">
        <xsl:text>, </xsl:text>
      </xsl:if>
      <xsl:value-of select="."/>
    </xsl:for-each>

    <form method="post" action="visa_aktiviteter.php">
      <input type="hidden" name="timefrom" value="{activities:timefrom}"/>
      <input type="hidden" name="contact" value="{activities:contact/activities:username}"/>
      <input type="hidden" name="adate" value="{activities:date}"/>
      <input type="submit" name="anmal" value="Anm&#228;l mig"/>
      <xsl:text> </xsl:text>
      <input type="submit" name="avanmal" value="Avanm&#228;l mig"/>
    </form>
  </xsl:template>

  <xsl:template match="activities:timefrom">
    <br/>
    <b>Starttid: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:timeto">
    <br/>
    <b>Sluttid: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:contact">
    <br/>
    <b>Kontaktperson: </b>
    <xsl:value-of select="activities:surname"/><xsl:text> </xsl:text>
    <xsl:value-of select="activities:familyname"/><xsl:text>, </xsl:text>
    <xsl:value-of select="activities:email"/><xsl:text>, </xsl:text>
    <xsl:value-of select="activities:phone"/>
  </xsl:template>

  <xsl:template match="activities:date">
    <br/>
    <b>Datum: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:place">
    <br/>
    <b>Plats: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:type">
    <b>Aktivitet: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:description">
    <br/>
    <b>Beskrivning: </b><xsl:value-of select="."/>
  </xsl:template>

  <xsl:template match="activities:participant">
  </xsl:template>

  <xsl:template match="activities:surname">
  </xsl:template>

  <xsl:template match="activities:familyname">
  </xsl:template>

</xsl:stylesheet>
