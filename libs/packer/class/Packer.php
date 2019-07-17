<?php
 use UmiCms\Service;class Packer {private $config;private $exporter;private $objectTypes = [];public function __construct($vcc87d2cfc5127128ded076ce5e7af0c8) {if (!$vcc87d2cfc5127128ded076ce5e7af0c8) {throw new RuntimeException('Не передан файл конфигурации.');}if (file_exists(realpath($vcc87d2cfc5127128ded076ce5e7af0c8))) {$this->config = require realpath($vcc87d2cfc5127128ded076ce5e7af0c8);return;}if (file_exists(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $vcc87d2cfc5127128ded076ce5e7af0c8)) {$this->config = require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $vcc87d2cfc5127128ded076ce5e7af0c8;return;}throw new RuntimeException('Передан путь до несуществующего файла.');}public function setExporter(xmlExporter $ved780287e302ec3b9fd3c5e78771919f) {$this->exporter = $ved780287e302ec3b9fd3c5e78771919f;}public function getConfig($vb068931cc450442b63f5b3d276ea4297, $vc21f969b5f03d33d43e04f8f136e7682 = null) {return isset($this->config[$vb068931cc450442b63f5b3d276ea4297]) ? $this->config[$vb068931cc450442b63f5b3d276ea4297] : $vc21f969b5f03d33d43e04f8f136e7682;}public function run() {if (!$this->exporter instanceof xmlExporter) {throw new RuntimeException('Непредвиденная ошибка.');}if (!$this->getConfig('package')) {throw new RuntimeException('Ключ "package" обязателен для заполнения.');}$v6990a54322d9232390a784c5c9247dd6 = new umiDirectory($this->getDestinationDir());$v6990a54322d9232390a784c5c9247dd6->deleteRecursively();$vd4f4f7531754109fa3eb6bf4dfefeddd = $this->getConfig('savedRelations');if (is_array($vd4f4f7531754109fa3eb6bf4dfefeddd)) {$this->exporter->ignoreRelationsExcept($vd4f4f7531754109fa3eb6bf4dfefeddd);}else {$this->exporter->setIgnoreRelations();}$this->exporter->setFieldsAllowRuntimeAdd();$this->packComponent();$vc9fb1ea5bd1979f249cee032e8ced732 = $v6990a54322d9232390a784c5c9247dd6->getPath() . '/' . $this->getConfig('package') . '.xml';$this->exporter    ->execute()    ->save($vc9fb1ea5bd1979f249cee032e8ced732);$vb0ebcff2e719d5c328b23b47eca455ed = 'savedRelations';$v77a7505dae6c28f25d0445b9ac48f27e = is_array($this->getConfig($vb0ebcff2e719d5c328b23b47eca455ed)) ? $this->getConfig($vb0ebcff2e719d5c328b23b47eca455ed) : [];if (in_array('files', $v77a7505dae6c28f25d0445b9ac48f27e)) {$this->packFilesFromUmiDump($vc9fb1ea5bd1979f249cee032e8ced732);}$this->addFileToArchive(    new SplFileInfo($vc9fb1ea5bd1979f249cee032e8ced732),    $this->getArchive(),    './' . $this->getConfig('package') . '.xml'   );}private function packComponent() {if (!$this->getConfig('directories') && !$this->getConfig('files')) {throw new RuntimeException(     'Хотя бы один из ключей "directories" или "files" должен быть заполнен в конфигурации.'    );}$this->packDirectories();$this->packFiles();$this->packRegistry();$this->addTypes();$this->addDataTypes();$this->addObjects();$this->addBranchesStructure();$this->addLangs();$this->addTemplates();$this->addEntities();}private function addDirectories(array $vbd1e333d1166f18893b2bbeba10229a3) {$v6990a54322d9232390a784c5c9247dd6 = $this->getDestinationDir();$this->exporter->setDestination($v6990a54322d9232390a784c5c9247dd6);$this->exporter->addDirs($vbd1e333d1166f18893b2bbeba10229a3);}private function addFiles(array $v45b963397aa40d4a0063e0d85e4fe7a1) {$v6990a54322d9232390a784c5c9247dd6 = $this->getDestinationDir();$this->exporter->setDestination($v6990a54322d9232390a784c5c9247dd6);$this->exporter->addFiles($v45b963397aa40d4a0063e0d85e4fe7a1);}private function packDirectories() {$vce772140a7c09937a3502f402d1b207e = $this->getConfig('directories');if (!is_array($vce772140a7c09937a3502f402d1b207e)) {return;}$v888d0ee361af3603736f32131e7b20a2 = $this->getArchive();$v2a65b9966ff0e7f8470e9de281641fe8 = [];$v45f4cea4f9fcf39d3f9989e5d0846cf9 = [];foreach ($vce772140a7c09937a3502f402d1b207e as $v5f8f22b8cdbaeee8cf857673a9b6ba20) {$v5891da2d64975cae48d175d1e001f5da = new RecursiveIteratorIterator(     new RecursiveDirectoryIterator($v5f8f22b8cdbaeee8cf857673a9b6ba20),     RecursiveIteratorIterator::SELF_FIRST    );$v45f4cea4f9fcf39d3f9989e5d0846cf9[] = strtr($v5f8f22b8cdbaeee8cf857673a9b6ba20, '\\', '/');foreach ($v5891da2d64975cae48d175d1e001f5da as $va8cfde6331bd59eb2ac96f8911c4b666) {if (!$va8cfde6331bd59eb2ac96f8911c4b666->isDir()) {$v2a65b9966ff0e7f8470e9de281641fe8[] = $this->addFileToArchive($va8cfde6331bd59eb2ac96f8911c4b666, $v888d0ee361af3603736f32131e7b20a2);}elseif (!in_array($va8cfde6331bd59eb2ac96f8911c4b666->getFilename(), ['.', '..'])) {$v45f4cea4f9fcf39d3f9989e5d0846cf9[] = $va8cfde6331bd59eb2ac96f8911c4b666->getPathname();}}}$this->addFiles($v2a65b9966ff0e7f8470e9de281641fe8);$this->addDirectories($v45f4cea4f9fcf39d3f9989e5d0846cf9);}private function packFiles() {$v701f5694ede3230b3aa5e85d71896aaa = $this->getConfig('files');if (!is_array($v701f5694ede3230b3aa5e85d71896aaa)) {return;}$v888d0ee361af3603736f32131e7b20a2 = $this->getArchive();$v2a65b9966ff0e7f8470e9de281641fe8 = [];foreach ($v701f5694ede3230b3aa5e85d71896aaa as $v47826cacc65c665212b821e6ff80b9b0) {$v8c7dd922ad47494fc02c388e12c00eac = new SplFileInfo($v47826cacc65c665212b821e6ff80b9b0);if (!$v8c7dd922ad47494fc02c388e12c00eac->isDir()) {$v2a65b9966ff0e7f8470e9de281641fe8[] = $this->addFileToArchive($v8c7dd922ad47494fc02c388e12c00eac, $v888d0ee361af3603736f32131e7b20a2);}}$this->addFiles($v2a65b9966ff0e7f8470e9de281641fe8);}private function packFilesFromUmiDump($vc9fb1ea5bd1979f249cee032e8ced732) {$vbbd738a112791dd1d0cb6bd0d61d878f = new DOMDocument('1.0', 'utf-8');if (!$vbbd738a112791dd1d0cb6bd0d61d878f->load($vc9fb1ea5bd1979f249cee032e8ced732)) {throw new RuntimeException('UmiDump сформирован неправильно: ' . $vc9fb1ea5bd1979f249cee032e8ced732);}$v1b1cc7f086b3f074da452bc3129981eb = new DOMXPath($vbbd738a112791dd1d0cb6bd0d61d878f);$v888d0ee361af3603736f32131e7b20a2 = $this->getArchive();foreach ($v1b1cc7f086b3f074da452bc3129981eb->evaluate('/umidump/files/file/@path') as $vd6fe1d0be6347b8ef2427fa629c04485) {$v8c7dd922ad47494fc02c388e12c00eac = new SplFileInfo($vd6fe1d0be6347b8ef2427fa629c04485->nodeValue);if ($v8c7dd922ad47494fc02c388e12c00eac->isFile()) {$ve788408b2bcf80a5610e79219719672a[] = $this->addFileToArchive($v8c7dd922ad47494fc02c388e12c00eac, $v888d0ee361af3603736f32131e7b20a2);}}}private function getDestinationDir() {$v6990a54322d9232390a784c5c9247dd6 = $this->getConfig('destination');if (!$v6990a54322d9232390a784c5c9247dd6) {throw new RuntimeException('Ключ "destination" обязателен для заполнения.');}if (!file_exists($v6990a54322d9232390a784c5c9247dd6)) {mkdir($v6990a54322d9232390a784c5c9247dd6, 0777, true);}return $v6990a54322d9232390a784c5c9247dd6;}private function getRegistryList($v700c216fb376666eaeda0c892e8bdc09 = 'core', $v2405a5d61f2f462a1371b33338295c09 = '//', $vf8e45531a3ea3d5c1247b004985175a4 = true) {if ($v700c216fb376666eaeda0c892e8bdc09 == 'core' && startsWith($v2405a5d61f2f462a1371b33338295c09, 'modules')) {return [];}$v13872c0118a4316afd1e99295017d654 = [];$v268184c12df027f536154d099d497b31 = Service::Registry()    ->getList($v2405a5d61f2f462a1371b33338295c09);if (!is_array($v268184c12df027f536154d099d497b31)) {return $v13872c0118a4316afd1e99295017d654;}foreach ($v268184c12df027f536154d099d497b31 as $v1b7d5726533ab525a8760351e9b5e415) {if ($v2405a5d61f2f462a1371b33338295c09 != '//') {$vf706092fd2b66a3a7cc8dadd2cf84847 = $v2405a5d61f2f462a1371b33338295c09 . '/' . $v1b7d5726533ab525a8760351e9b5e415[0];}else {$vf706092fd2b66a3a7cc8dadd2cf84847 = $v1b7d5726533ab525a8760351e9b5e415[0];}$v13872c0118a4316afd1e99295017d654[] = $vf706092fd2b66a3a7cc8dadd2cf84847;if ($vf8e45531a3ea3d5c1247b004985175a4) {$v13872c0118a4316afd1e99295017d654 = array_merge($v13872c0118a4316afd1e99295017d654, $this->getRegistryList($v700c216fb376666eaeda0c892e8bdc09, $vf706092fd2b66a3a7cc8dadd2cf84847));}}return $v13872c0118a4316afd1e99295017d654;}private function addTypes() {$this->detectComponents();$this->sortObjectTypesByModule();$vcdf2f9a75b780b60fc57b2514f71ef49 = $this->getConfig('types', []);$this->exporter->addTypes($vcdf2f9a75b780b60fc57b2514f71ef49);foreach ($vcdf2f9a75b780b60fc57b2514f71ef49 as $v5f694956811487225d15e973ca38fbab) {$this->addObjectsOrPagesWithType($v5f694956811487225d15e973ca38fbab);}$this->exporter->setShowAllFields(true);}private function detectComponents() {$this->objectTypes['core'] = [];$v0ffc9ad8303afce4216f05d62289e63c = Service::Registry()    ->getList('//modules');foreach ($v0ffc9ad8303afce4216f05d62289e63c as $v52a43e48ec4649dee819dadabcab1bde) {list($v52a43e48ec4649dee819dadabcab1bde) = $v52a43e48ec4649dee819dadabcab1bde;$this->objectTypes[$v52a43e48ec4649dee819dadabcab1bde] = [];}}private function sortObjectTypesByModule($v2d167696e35bbbaa2b026d0ffbbeaf68 = 0) {$vdb6d9b451b818ccc9a449383f2f0c450 = umiObjectTypesCollection::getInstance();$vd14a8022b085f9ef19d479cbdd581127 = $vdb6d9b451b818ccc9a449383f2f0c450->getSubTypesList($v2d167696e35bbbaa2b026d0ffbbeaf68);foreach ($vd14a8022b085f9ef19d479cbdd581127 as $v5f694956811487225d15e973ca38fbab) {$v599dcce2998a6b40b1e38e8c6006cb0a = $vdb6d9b451b818ccc9a449383f2f0c450->getType($v5f694956811487225d15e973ca38fbab);$v22884db148f0ffb0d830ba431102b0b5 = $v599dcce2998a6b40b1e38e8c6006cb0a->getModule();if (!$v22884db148f0ffb0d830ba431102b0b5) {$v22884db148f0ffb0d830ba431102b0b5 = 'core';}if (!isset($this->objectTypes[$v22884db148f0ffb0d830ba431102b0b5])) {continue;}$this->objectTypes[$v22884db148f0ffb0d830ba431102b0b5][] = $v5f694956811487225d15e973ca38fbab;$this->sortObjectTypesByModule($v5f694956811487225d15e973ca38fbab);}}private function addObjectsOrPagesWithType($v5f694956811487225d15e973ca38fbab) {$vb3b32a2d422265cd25c3323ed0157f81 = new selector('pages');$vb3b32a2d422265cd25c3323ed0157f81->types('object-type')->id($v5f694956811487225d15e973ca38fbab);if ($vb3b32a2d422265cd25c3323ed0157f81->length() > 0) {$this->exporter->addElements($vb3b32a2d422265cd25c3323ed0157f81->result());return;}$v5891da2d64975cae48d175d1e001f5da = new selector('objects');$v5891da2d64975cae48d175d1e001f5da->types('object-type')->id($v5f694956811487225d15e973ca38fbab);$this->exporter->addObjects($v5891da2d64975cae48d175d1e001f5da->result());}private function addFileToArchive(SplFileInfo $v8c7dd922ad47494fc02c388e12c00eac, PharData $v888d0ee361af3603736f32131e7b20a2, $v854c6c62527722d75943fe3e6f81914b = null) {$vd6fe1d0be6347b8ef2427fa629c04485 = $v8c7dd922ad47494fc02c388e12c00eac->getPathname();echo $vd6fe1d0be6347b8ef2427fa629c04485 . PHP_EOL;$v854c6c62527722d75943fe3e6f81914b = $v854c6c62527722d75943fe3e6f81914b ?: strtr($vd6fe1d0be6347b8ef2427fa629c04485, '\\', '/');$v888d0ee361af3603736f32131e7b20a2->addFile($vd6fe1d0be6347b8ef2427fa629c04485, $v854c6c62527722d75943fe3e6f81914b);return $vd6fe1d0be6347b8ef2427fa629c04485;}private function packRegistry() {$ve566f826fb14ace9214c4807af34220e = $this->getConfig('registry');if (!is_array($ve566f826fb14ace9214c4807af34220e)) {return;}foreach ($ve566f826fb14ace9214c4807af34220e as $v22884db148f0ffb0d830ba431102b0b5 => $va9205dcfd4a6f7c2cbe8be01566ff84a) {$this->exporter->addRegistry(     $this->getRegistryList(      $v22884db148f0ffb0d830ba431102b0b5,      $va9205dcfd4a6f7c2cbe8be01566ff84a['path'],      isset($va9205dcfd4a6f7c2cbe8be01566ff84a['recursive']) ? $va9205dcfd4a6f7c2cbe8be01566ff84a['recursive'] : true     )    );}}private function addDataTypes() {$vec26ca7dbd637a9dbbdb17bdb372859a = $this->getConfig('fieldTypes');if (!is_array($vec26ca7dbd637a9dbbdb17bdb372859a)) {return;}$this->exporter->addDataTypes($vec26ca7dbd637a9dbbdb17bdb372859a);}private function addObjects() {$v9602dd5efeb5e02a7e5f213e91c017a7 = $this->getConfig('objects');if (!is_array($v9602dd5efeb5e02a7e5f213e91c017a7)) {return;}$this->exporter->addObjects($v9602dd5efeb5e02a7e5f213e91c017a7);$this->exporter->setShowAllFields(true);}private function addBranchesStructure() {$vbf95cbea2fbc6aab956a058a7afb3e45 = $this->getConfig('branchesStructure');if (!is_array($vbf95cbea2fbc6aab956a058a7afb3e45)) {return;}$this->exporter->addBranches($vbf95cbea2fbc6aab956a058a7afb3e45);}private function addLangs() {$vc438939208265512ce7df69abe43ab6e = $this->getConfig('langs');if (!is_array($vc438939208265512ce7df69abe43ab6e)) {return;}$this->exporter->addLangs($vc438939208265512ce7df69abe43ab6e);}private function addTemplates() {$v01cd1aa92a620288d14c248728b37321 = $this->getConfig('templates');if (!is_array($v01cd1aa92a620288d14c248728b37321)) {return;}$this->exporter->addTemplates($v01cd1aa92a620288d14c248728b37321);}private function addEntities() {$v98148d317aac5fd6fab390e6f5ed52eb = $this->getConfig('entities');if (!is_array($v98148d317aac5fd6fab390e6f5ed52eb)) {return;}$this->exporter->addEntities($v98148d317aac5fd6fab390e6f5ed52eb);}private function getArchive() {$v6990a54322d9232390a784c5c9247dd6 = $this->getDestinationDir();return new PharData("{$v6990a54322d9232390a784c5c9247dd6}/{$this->getConfig('package')}.tar");}}