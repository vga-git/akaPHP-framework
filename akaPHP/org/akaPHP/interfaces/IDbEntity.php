<?php
namespace org\akaPHP\interfaces {
    interface IDbEntity {
        public static function fromArray(array $structure);
        public function getId();
        public function setId($value, IManager $sender);
        public function getTableName();
        public function getFields();
        public function toArray();
    }
}
?>
