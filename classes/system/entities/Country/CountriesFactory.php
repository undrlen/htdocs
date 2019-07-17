<?php
 namespace UmiCms\Classes\System\Entities\Country;class CountriesFactory implements iCountriesFactory {public static function createByObject(\iUmiObject $va8cfde6331bd59eb2ac96f8911c4b666) {return new Country($va8cfde6331bd59eb2ac96f8911c4b666);}public static function createByObjectId($v16b2b26000987faccb260b9d39df1269) {$v16b2b26000987faccb260b9d39df1269 = (int) $v16b2b26000987faccb260b9d39df1269;$va8cfde6331bd59eb2ac96f8911c4b666 = \umiObjectsCollection::getInstance()    ->getObject($v16b2b26000987faccb260b9d39df1269);if (!$va8cfde6331bd59eb2ac96f8911c4b666 instanceof \iUmiObject) {$v0a32f30923e2b9f2d7272796ec05c488 = sprintf(getLabel('error-cannot-get-country-by-id'), $v16b2b26000987faccb260b9d39df1269);throw new \expectObjectException($v0a32f30923e2b9f2d7272796ec05c488);}return self::createByObject($va8cfde6331bd59eb2ac96f8911c4b666);}public static function createByISO($vc13367945d5d4c91047b3b50234aa7ab) {$v04727cea908ef532ffca814a6835f9ae = self::getCountryIdByISO($vc13367945d5d4c91047b3b50234aa7ab);return self::createByObjectId($v04727cea908ef532ffca814a6835f9ae);}private static function getCountryIdByISO($vc13367945d5d4c91047b3b50234aa7ab) {$v1b1cc7f086b3f074da452bc3129981eb = new \selector('objects');$v1b1cc7f086b3f074da452bc3129981eb->types('object-type')->guid(Country::COUNTRY_TYPE_GUID);$v1b1cc7f086b3f074da452bc3129981eb->where(Country::ISO_CODE_FIELD)->equals($vc13367945d5d4c91047b3b50234aa7ab);$v1b1cc7f086b3f074da452bc3129981eb->option('no-length', true);$v1b1cc7f086b3f074da452bc3129981eb->option('ignore-children-types', true);$v1b1cc7f086b3f074da452bc3129981eb->option('return', 'id');$v1b1cc7f086b3f074da452bc3129981eb->limit(0, 1);$v04727cea908ef532ffca814a6835f9ae = $v1b1cc7f086b3f074da452bc3129981eb->result();if (!isset($v04727cea908ef532ffca814a6835f9ae[0]['id'])) {$v0a32f30923e2b9f2d7272796ec05c488 = sprintf(getLabel('error-cannot-get-country-by-iso'), $vc13367945d5d4c91047b3b50234aa7ab);throw new \expectObjectException($v0a32f30923e2b9f2d7272796ec05c488);}return (int) $v04727cea908ef532ffca814a6835f9ae[0]['id'];}}