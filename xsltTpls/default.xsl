<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" version="4.01" encoding="UTF-8" indent="yes" />

  <xsl:include href="imports/content.xsl"/>

  <xsl:template match="/">

    <html>

      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><xsl:value-of select="/result/@title" /></title>
        <meta name="description" content="{/result/meta/description}" />
        <meta name="keywords" content="{/result/meta/keywords}" />
        <link rel="stylesheet" type="text/css" href="../css/design/grid.css" />
        <link rel="stylesheet" type="text/css" href="../css/design/decor.css" />
      </head>

      <body>

        <div class="title">
          <h2><xsl:value-of select="result/@header" /></h2>
          <span>+7 (812) 123-45-67</span>
        </div>

        <div class="main">
          <div class="head"><img src="../images/design/headbg.jpg" width="920" height="240" alt="" title="" /></div>
          <div class="page">

            <div class="left">
              <ul>
                <li><a href="index.html" class="act">Главная</a></li>
                <li><a href="about.html">О компании</a></li>
                <li><a href="service.html">Услуги</a></li>
                <li><a href="news.html">Новости</a></li>
                <li><a href="contacts.html">Контакты</a></li>
              </ul>
            </div>

            <div class="content">
              <h1>Главная</h1>
              <div class="text">

                <div>
                  <h2>Пара слов о компании</h2>

                  <xsl:apply-templates select="result" />

                </div>
                <div class="line"></div>

                <h3>Основные услуги</h3>
                <div class="services">
                  <dl class="service">
                    <dt><a href="service_01.html">Горячие услуги</a></dt>
                    <dd>Ганимед, это удалось установить по характеру спектра, дает зенит, и в этом вопросе достигнута такая точность расчетов, что, начиная с того дня, как мы видим, указанного Эннием и записанного в "Больших анналах", было вычислено время предшествовавших затмений солнца, начиная с того, которое в квинктильские ноны произошло в царствование Ромула.</dd>
                    <dt><a href="service_01.html">Бронирование отелей</a></dt>
                    <dd>Ганимед, это удалось установить по характеру спектра, дает зенит, и в этом вопросе достигнута такая точность расчетов, что, начиная с того дня, как мы видим, указанного Эннием и записанного в "Больших анналах", было вычислено время предшествовавших затмений солнца, начиная с того, которое в квинктильские ноны произошло в царствование Ромула.</dd>
                  </dl>
                </div>

                <div class="line"></div>

                <h3>Новости</h3>
                <div class="main-news">
                  <ul class="news">
                    <li>
                      <span>26.05.2010</span>
                      <div>Ганимед, это удалось установить по характеру спектра, дает зенит, и в этом вопросе достигнута такая точность расчетов,</div>
                      <a href="">Читать далее</a>
                    </li>
                    <li>
                      <span>26.05.2010</span>
                      <div>Ганимед, это удалось установить по характеру спектра, дает зенит, и в этом вопросе достигнута такая точность расчетов,</div>
                      <a href="">Читать далее</a>
                    </li>
                  </ul>
                </div>

              </div>
            </div>

          </div>
        </div>

        <div class="copy">
          <p>Copyright 2009. Все права защищены</p>
          <p>Работает на <a href="">UMIhost</a></p>
        </div>

      </body>

    </html>

  </xsl:template>

</xsl:stylesheet>