<?php
 interface iUmiFieldsCollection extends iSingleton {public function add($vb068931cc450442b63f5b3d276ea4297, $vd5d3db1765287eef77d7927cc956f50a, $ve2aeb4e882d60b1eb4b7c8cd97986a28);public function getById($vb80bb7740288fda1f201890375a60c8f);public function delById($vb80bb7740288fda1f201890375a60c8f);public function isExists($vb80bb7740288fda1f201890375a60c8f);public function getFieldIdListByType(iUmiFieldType $v599dcce2998a6b40b1e38e8c6006cb0a);public function getFieldList(array $v5a2576254d428ddc22a03fac145c8749);public function addField(   $vb068931cc450442b63f5b3d276ea4297,   $vd5d3db1765287eef77d7927cc956f50a,   $ve2aeb4e882d60b1eb4b7c8cd97986a28,   $v19fad0416b4b101ab72faccf4c323024 = true,   $v73b8754d45983f35756b157ea439de8c = false,   $v55e0eccc570671ca7ba7f5ef4ded0b96 = false  );public function getField($vb80bb7740288fda1f201890375a60c8f, $v8d777f385d3dfec8815d20f7496026dc = false);public function delField($vb80bb7740288fda1f201890375a60c8f);public function clearCache();public function filterListByNameBlackList(array &$v69fe4aec8073954bf273e3113edd24cf, array $vccfd2817034f26cde9cf794d1b2a7266);public function filterListByTypeWhiteList(array &$v69fe4aec8073954bf273e3113edd24cf, array $v4ccfaf724b7a75442e150dca4bb7b758);}