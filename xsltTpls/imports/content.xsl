<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="result[@module = 'content'][@method = 'content']" >

    <xsl:value-of select=".//property[@name = 'content']/value" disable-output-escaping="yes" />

  </xsl:template>

<!--  <xsl:template match="result[@module = 'content'][@method = 'content'][page/@is-default = '1']" >-->
<!--    <xsl:value-of select=".//property[@name = 'content']/value" disable-output-escaping="yes" />-->
<!--  </xsl:template>-->

</xsl:stylesheet>


