<?php
 namespace UmiCms\System\Data\Field\Type;interface iMigration {public function __construct(   \iUmiObjectTypesCollection $v545d7f16f17a5ddcfa8b52e72077b5bd,   \iUmiFieldsCollection $vc08b50415eb1a67928fe59c937252cde,   \iUmiFieldTypesCollection $v55ee9fc92cb8889429478e746ff320e2  );public function migrate(array $v42aefbae01d2dfd981f7da7d823d689e);public function rollback(array $v42aefbae01d2dfd981f7da7d823d689e);}