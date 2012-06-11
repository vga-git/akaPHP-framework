<?php
namespace org\akaPHP\db {
    use org\akaPHP\exceptions;
    use org\akaPHP\interfaces;

    abstract class DbEntity {
        protected
            $id,
            $isDirty;

        protected static
            $fields = array(),
            $tableName = '#err';

        public function __construct() {
            $this->id = null;
            $this->isDirty = false;
        }

        public static function getFields() {
            return static::$fields;
        }

        public static function getTableName() {
            return static::$tableName;
        }

        public abstract function newInstance();

        public function getId() {
            return $this->id;
        }

        public function isDirty() {
            return $this->isDirty;
        }

        public function setId($value)
        {
            $this->id = $value;
        }

        public function toArray($includeNullValues = true) {
            $results = array();

            $fields = $this->getFields();

            foreach (array_keys($fields) as $column) {
                $getter = 'get' . ucfirst($column);
                $value = $this->$getter();
                if ($value || $includeNullValues) {
                    $results[$column] = $value;
                }
            }
            return $results;
        }

        public static function fromArray(array $structure) {
            $structure = null;
            throw new exceptions\AkaException(
                exceptions\AkaException::OVERRIDE_EXCEPTION,
                exceptions\AkaException::OVERRIDE_EXCEPTION_NUM
            );
        }
    }
}
?>
