<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
   xmlns:activities="http://www.nada.kth.se/~kjgrahn/2D1518/projekt/system/">

  <xsl:template match="activities:activities">
   <html>
    <head>
      <title>&#196;ndra en aktivitet</title>
    </head>
    <body>
      <b>Aktiv\&#196;ndra en aktivitet</b>
      <hr/>
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
    <form method="post" action="andra_aktivitet.php">
      <b>Starttid</b><br/>
      <input type="text" size="20" name="timefrom_new" value="{activities:timefrom}" maxlength="8"/>
      <input type="hidden" name="timefrom_old" value="{activities:timefrom}"/><p/>

      <b>Sluttid (XX:XX:XX)</b><br/>
      <input type="text" size="20" name="timeto" value="{activities:timeto}" maxlength="8"/><p/>
		
      <p>Kort beskrivning av aktiviteten*</p>
      <textarea rows="5" cols="30" name="description"><xsl:value-of select="activities:description"/></textarea><p/>

      <b>Typ av aktivitet</b><br/>
      <input type="text" size="30" name="type" value="{activities:type}"/><p/>
			
      <b>Plats</b><br/>
      <input type="text" size="30" name="place" value="{activities:place}"/><p/>

      <b>Datum</b><br/>
      <input type="text" size="30" name="adate_new" value="{activities:date}" maxlength="10"/>
      <input type="hidden" name="adate_old" value="{activities:date}"/><p/>

      <b>Kontaktperson: </b>
      <xsl:value-of select="activities:contact/activities:surname"/>
      <xsl:text> </xsl:text>
      <xsl:value-of select="activities:contact/activities:familyname"/>
      <input type="hidden" name="contact" value="{activities:contact/activities:username}"/><p/>

      <input type="submit" name="andra" value="&#196;ndra information"/>
      <xsl:text> </xsl:text>
      <input type="submit" name="andra_epost" value="&#196;ndra information och informera deltagare via e-post"/>
      <xsl:text> </xsl:text>
      <input type="submit" name="radera" value="Ta bort aktivitet"/>
    </form>
  </xsl:template>

  <xsl:template match="activities:timefrom">
  </xsl:template>

  <xsl:template match="activities:timeto">
  </xsl:template>

  <xsl:template match="activities:date">
  </xsl:template>

  <xsl:template match="activities:place">
  </xsl:template>

  <xsl:template match="activities:type">
  </xsl:template>

  <xsl:template match="activities:description">
  </xsl:template>

  <xsl:template match="activities:participant">
  </xsl:template>

  <xsl:template match="activities:surname">
  </xsl:template>

  <xsl:template match="activities:familyname">
  </xsl:template>

</xsl:stylesheet>
