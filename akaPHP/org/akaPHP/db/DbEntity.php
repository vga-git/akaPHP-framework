<?php
namespace org\akaPHP\db {
    use org\akaPHP\exceptions;
    use org\akaPHP\interfaces;

    abstract class DbEntity {
        protected
            $id,
            $tableName,
            $isDirty;


        public function __construct() {
            $this->id = null;
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

        public function setId($value, interfaces\IManager $sender)
        {
            if ($sender->isFetching()) {
                $this->id = $value;
            }
        }

        public function toArray() {

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
