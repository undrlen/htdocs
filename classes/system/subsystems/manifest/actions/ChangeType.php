<?php
 namespace UmiCms\Manifest\Migrate\Field;use UmiCms\Service;use UmiCms\System\Data\Field\Type\iMigration;class ChangeTypeAction extends \Action {public function execute() {$vec5417144d6345f378e17d0ee837affc = $this->getParam('target');if (!is_array($vec5417144d6345f378e17d0ee837affc)) {throw new \RuntimeException('Incorrect target list given: ' . var_export($vec5417144d6345f378e17d0ee837affc, true));}$vb439f9bbe0a4c866b54c7399f0d21e37 = $this->getMigration();foreach ($vec5417144d6345f378e17d0ee837affc as $v42aefbae01d2dfd981f7da7d823d689e) {if (!is_array($v42aefbae01d2dfd981f7da7d823d689e)) {throw new \RuntimeException('Incorrect target given: ' . var_export($v42aefbae01d2dfd981f7da7d823d689e, true));}$vb439f9bbe0a4c866b54c7399f0d21e37->migrate($v42aefbae01d2dfd981f7da7d823d689e);}return $this;}public function rollback() {$vec5417144d6345f378e17d0ee837affc = $this->getParam('target');if (!is_array($vec5417144d6345f378e17d0ee837affc)) {return $this;}$vb439f9bbe0a4c866b54c7399f0d21e37 = $this->getMigration();foreach ($vec5417144d6345f378e17d0ee837affc as $v42aefbae01d2dfd981f7da7d823d689e) {if (!is_array($v42aefbae01d2dfd981f7da7d823d689e)) {continue;}try {$vb439f9bbe0a4c866b54c7399f0d21e37->rollback($v42aefbae01d2dfd981f7da7d823d689e);}catch (\Exception $v42552b1f133f9f8eb406d4f306ea9fd1) {continue;}}return $this;}private function getMigration() {return Service::get('FieldTypeMigration');}}