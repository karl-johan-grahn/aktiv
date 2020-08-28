<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!-- Whenever you match any node or any attribute -->
<xsl:template match="node()|@*">

  <!-- Copy the current node -->
  <xsl:copy>
    <!-- Include any attributes it has and any child nodes -->
    <xsl:apply-templates select="@*|node()"/>
  </xsl:copy>

</xsl:template>

<xsl:template match="head">
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

  <xsl:apply-templates select="@*|node()"/>
</xsl:template>

</xsl:stylesheet>
