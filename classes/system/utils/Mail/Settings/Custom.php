<?php
 namespace UmiCms\Classes\System\Utils\Mail\Settings;use UmiCms\Service;use UmiCms\Classes\System\Utils\Settings\Custom as SettingsCustom;class Custom extends SettingsCustom implements iSettings {public function getAdminEmail() {return (string) $this->getRegistry()->get("{$this->getPrefix()}/admin_email");}public function setAdminEmail($v0c83f57c786a0b4a39efab23731c7ebc) {$this->getRegistry()->set("{$this->getPrefix()}/admin_email", $v0c83f57c786a0b4a39efab23731c7ebc);return $this;}public function getSenderEmail() {return (string) $this->getRegistry()->get("{$this->getPrefix()}/email_from");}public function setSenderEmail($v0c83f57c786a0b4a39efab23731c7ebc) {$this->getRegistry()->set("{$this->getPrefix()}/email_from", $v0c83f57c786a0b4a39efab23731c7ebc);return $this;}public function getSenderName() {return (string) $this->getRegistry()->get("{$this->getPrefix()}/fio_from");}public function setSenderName($vb068931cc450442b63f5b3d276ea4297) {$this->getRegistry()->set("{$this->getPrefix()}/fio_from", $vb068931cc450442b63f5b3d276ea4297);return $this;}public function getEngine() {return (string) $this->getRegistry()->get("{$this->getPrefix()}/engine");}public function setEngine($vad1943a9fd6d3d7ee1e6af41a5b0d3e7) {$this->getRegistry()->set("{$this->getPrefix()}/engine", $vad1943a9fd6d3d7ee1e6af41a5b0d3e7);return $this;}public function isDisableParseContent() {return (bool) $this->getRegistry()->get("{$this->getPrefix()}/disable-parse");}public function setDisableParseContent($vfada7443f242172212e4b0734b76fab5) {$this->getRegistry()->set("{$this->getPrefix()}/disable-parse", $vfada7443f242172212e4b0734b76fab5);return $this;}public function Smtp() {return Service::get('SmtpMailSettingsFactory')->createCustom($this->domainId, $this->langId);}protected function getPrefix() {return "//settings/mail/{$this->domainId}/{$this->langId}";}}