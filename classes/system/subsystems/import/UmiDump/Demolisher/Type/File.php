<?php
 namespace UmiCms\System\Import\UmiDump\Demolisher\Type;use UmiCms\Classes\System\Entities\File\iFactory as FileFactory;use UmiCms\Classes\System\Entities\Directory\iFactory as DirectoryFactory;use UmiCms\System\Import\UmiDump\Demolisher\FileSystem;class File extends FileSystem {private $fileFactory;public function __construct(FileFactory $ve9d2ea3c13cc8f3b974ffbe8695cba02, DirectoryFactory $vb7a82c37d8c13db7202ec4890aa47a7d) {$this->fileFactory = $ve9d2ea3c13cc8f3b974ffbe8695cba02;$this->setDirectoryFactory($vb7a82c37d8c13db7202ec4890aa47a7d);}protected function execute() {$ve9d2ea3c13cc8f3b974ffbe8695cba02 = $this->getFileFactory();foreach ($this->getFilePathList() as $vd6fe1d0be6347b8ef2427fa629c04485) {$v857d5dae818a37d6732ac1faff247168 = $this->getDestinationPath($vd6fe1d0be6347b8ef2427fa629c04485);$v8c7dd922ad47494fc02c388e12c00eac = $ve9d2ea3c13cc8f3b974ffbe8695cba02->create($v857d5dae818a37d6732ac1faff247168);if (!$v8c7dd922ad47494fc02c388e12c00eac->isExists()) {$this->pushLog(sprintf('File "%s" not exists', $v8c7dd922ad47494fc02c388e12c00eac->getFilePath()));continue;}$v9acb44549b41563697bb490144ec6258 = $v8c7dd922ad47494fc02c388e12c00eac->delete() ? 'was deleted' : 'was not deleted';$this->pushLog(sprintf('File "%s" %s', $v8c7dd922ad47494fc02c388e12c00eac->getFilePath(), $v9acb44549b41563697bb490144ec6258));$this->deleteDirectory($v8c7dd922ad47494fc02c388e12c00eac->getDirName());}}private function getFilePathList() {return $this->getNodeValueList('/umidump/files/file');}private function getFileFactory() {return $this->fileFactory;}}