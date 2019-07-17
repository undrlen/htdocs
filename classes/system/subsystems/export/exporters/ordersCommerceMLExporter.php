<?php
 use UmiCms\Service;class ordersCommerceMLExporter extends umiExporter {private $customXslTemplate;public function setCustomXslTemplate($v5b063e275d506f65ebf1b02d926f19a4) {if (preg_match('/[a-z0-9_\-\\/]+/i', $v5b063e275d506f65ebf1b02d926f19a4)) {$this->customXslTemplate = trim($v5b063e275d506f65ebf1b02d926f19a4);}}public function setOutputBuffer() {$v7f2db423a49b305459147332fb01cf87 = Service::Response()    ->getCurrentBuffer();$v7f2db423a49b305459147332fb01cf87->charset('windows-1251');$v7f2db423a49b305459147332fb01cf87->contentType('text/xml');return $v7f2db423a49b305459147332fb01cf87;}public function export($v6f017b01ac7b836b216574ebb3f5d73c, $vd1051e3a7d64c17a9cba77188937d2cd) {$v12c500ed0b7879105fb46af0f246be87 = $this->getOrders();$vbbd738a112791dd1d0cb6bd0d61d878f = $this->getUmiDump($v12c500ed0b7879105fb46af0f246be87, 'CommerceML2');$v01e85049f292c1782dbc1150fc6c5ca1 = is_string($this->customXslTemplate) ? $this->customXslTemplate : $this->type;$v66f6181bcb4cff4cd38fbc804a036db6 = CURRENT_WORKING_DIR . '/xsl/export/' . $v01e85049f292c1782dbc1150fc6c5ca1 . '.xsl';if (!is_file($v66f6181bcb4cff4cd38fbc804a036db6)) {throw new publicException("Can't load xsl template file {$v66f6181bcb4cff4cd38fbc804a036db6}");}$v9a09b4dfda82e3e665e31092d1c3ec8d = new DOMDocument('1.0', 'utf-8');$v9a09b4dfda82e3e665e31092d1c3ec8d->formatOutput = XML_FORMAT_OUTPUT;$v9a09b4dfda82e3e665e31092d1c3ec8d->loadXML($vbbd738a112791dd1d0cb6bd0d61d878f);$v640eac53ad75db5c49a9ec86390d8530 = umiTemplater::create('XSLT', $v66f6181bcb4cff4cd38fbc804a036db6);$result = $v640eac53ad75db5c49a9ec86390d8530->parse($v9a09b4dfda82e3e665e31092d1c3ec8d);$result = str_replace(    '<?xml version="1.0" encoding="utf-8"?>',    '<?xml version="1.0" encoding="windows-1251"?>',    $result   );$result = mb_convert_encoding($result, 'CP1251', 'UTF-8');return $result;}private function getOrders() {$v12c500ed0b7879105fb46af0f246be87 = new selector('objects');$v12c500ed0b7879105fb46af0f246be87->types('object-type')->name('emarket', 'order');$v12c500ed0b7879105fb46af0f246be87->where('number')->more(0);$v12c500ed0b7879105fb46af0f246be87->where('customer_id')->more(0);$v12c500ed0b7879105fb46af0f246be87->where('order_date')->more(0);$v12c500ed0b7879105fb46af0f246be87->where('total_amount')->more(0);$v12c500ed0b7879105fb46af0f246be87->where('need_export')->equals(1);$v12c500ed0b7879105fb46af0f246be87->order('order_date')->asc();$v3f48301f2668ec4eec370518ddcffe63 = mainConfiguration::getInstance();if ($v3f48301f2668ec4eec370518ddcffe63->get('modules', 'exchange.commerceML.ordersByDomains')) {$v3d5ed8db11ff5eea231151580225ecc7 = Service::DomainDetector()->detectId();$v12c500ed0b7879105fb46af0f246be87->where('domain_id')->equals($v3d5ed8db11ff5eea231151580225ecc7);}$vaa9f73eea60a006820d0f8768bc8a3fc = $v3f48301f2668ec4eec370518ddcffe63->get('modules', 'exchange.commerceML.ordersLimit');if ($vaa9f73eea60a006820d0f8768bc8a3fc) {$v12c500ed0b7879105fb46af0f246be87->limit(0, $vaa9f73eea60a006820d0f8768bc8a3fc);}return $v12c500ed0b7879105fb46af0f246be87->result();}protected function getUmiDump($v12c500ed0b7879105fb46af0f246be87, $v7c95caafbd5e4b5db3977617a0498de6 = false) {if (!$v7c95caafbd5e4b5db3977617a0498de6) {$v7c95caafbd5e4b5db3977617a0498de6 = $this->getSourceName();}$ved780287e302ec3b9fd3c5e78771919f = $this->createXmlExporter($v7c95caafbd5e4b5db3977617a0498de6);$ved780287e302ec3b9fd3c5e78771919f->addObjects($v12c500ed0b7879105fb46af0f246be87);$ved780287e302ec3b9fd3c5e78771919f->setIgnoreRelations();$result = $ved780287e302ec3b9fd3c5e78771919f->execute();return $result->saveXML();}}