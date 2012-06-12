<?php
namespace org\akaPHP\db {
    use org\akaPHP\exceptions;
    use org\akaPHP\interfaces;

    abstract class DbEntity {
        protected
            $id,
            $isDirty;

        public function __construct($id = null) {
            $this->id = $id;
            $this->isDirty = false;
        }

        public abstract function getFields();

        public abstract function getTableName();

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

            $fields = array_merge(
                array (
                    'id' => new DbTypeInt()
                ),
                $this->getFields()
            );
            
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
