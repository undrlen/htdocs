<?php
 class umiDirectoryIterator implements Iterator {private $arr_objs = [];public function __construct($v563a5461acd4cf632a113d5b105e817e) {if (is_array($v563a5461acd4cf632a113d5b105e817e)) {$this->arr_objs = $v563a5461acd4cf632a113d5b105e817e;}}public function rewind() {reset($this->arr_objs);}public function current() {$vdcb9afbd8280826e367d80729a873796 = null;$vf6fe2202aaa5491a9c7a9fef46f44483 = current($this->arr_objs);if (is_file($vf6fe2202aaa5491a9c7a9fef46f44483)) {if (umiImageFile::getIsImage($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiImageFile($vf6fe2202aaa5491a9c7a9fef46f44483);}else {$vdcb9afbd8280826e367d80729a873796 = new umiFile($vf6fe2202aaa5491a9c7a9fef46f44483);}}elseif (is_dir($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiDirectory($vf6fe2202aaa5491a9c7a9fef46f44483);}return $vdcb9afbd8280826e367d80729a873796;}public function key() {return current($this->arr_objs);}public function next() {$vdcb9afbd8280826e367d80729a873796 = null;$vf6fe2202aaa5491a9c7a9fef46f44483 = next($this->arr_objs);if (is_file($vf6fe2202aaa5491a9c7a9fef46f44483)) {if (umiImageFile::getIsImage($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiImageFile($vf6fe2202aaa5491a9c7a9fef46f44483);}else {$vdcb9afbd8280826e367d80729a873796 = new umiFile($vf6fe2202aaa5491a9c7a9fef46f44483);}}elseif (is_dir($vf6fe2202aaa5491a9c7a9fef46f44483)) {$vdcb9afbd8280826e367d80729a873796 = new umiDirectory($vf6fe2202aaa5491a9c7a9fef46f44483);}return $vdcb9afbd8280826e367d80729a873796;}public function valid() {return $this->current() !== null;}}