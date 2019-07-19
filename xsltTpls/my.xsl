<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xlink="http://www.w3.org/TR/xlink">
  <xsl:output encoding="utf-8" method="html" indent="yes"/>
  <xsl:template match="/">
    <html>
      <head>
        <title><xsl:value-of select="/result/page/name" /></title>
      </head>
      <body>
        <h1>
          <xsl:value-of select="/result/page/properties/group[@name='common']/property[@name='h1']/value"/>
        </h1>

        <xsl:value-of select="/result/page/properties/group/property[@name='content']/value" disable-output-escaping="yes" />

      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>