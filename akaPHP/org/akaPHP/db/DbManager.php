<?php
namespace org\akaPHP\db {
    use org\akaPHP\interfaces;
    use org\akaPHP\exceptions;
    class DbManager implements interfaces\IManager {
        private $_isFetching;
        protected $database;

        public function __construct(interfaces\IConnectionRes $connection) {
            $this->database = $connection;
        }

        public function getConnection() {
            return $this->database;
        }

        public function isFetching() {
            return $this->_isFetching;
        }

        public function load(DbEntity $entity) {
            $ayOfEntities = array();
            $baseSql = sprintf('SELECT * FROM %s', $entity->getTableName());
            $wheres = $entity->toArray(false);

            $isAnd = false;
            $params = array();

            foreach($wheres as $key => $value) {
                $paramValue = ':' . $key;
                $baseSql .= sprintf(' %s %s = %s', $isAnd ? 'AND' : 'WHERE', $key, $paramValue);
                $isAnd = true;
                $params[$paramValue] = $value;
            }

            $results = $this->database->query($baseSql, $params);
            if (! $results) {
                return array();
            }
            $this->_isFetching = true;

            foreach ($results as $result) {
                $element = $entity->newInstance();
                $element->setId($result['id']);

                foreach (array_keys($entity->getFields()) as $column) {
                    $setter = 'set' . ucfirst($column);
                    $element->$setter($result[$column]);
                }
                $ayOfEntities[] = $element;
            }
            $this->_isFetching = false;
            return $ayOfEntities;
        }

        public function save(DbEntity $entity) {
            if (! $entity->isDirty()) {
                throw new exceptions\AkaDbException(
                exceptions\AkaDbException::DB_NOT_DIRTY
                );
            }

            $baseSql = sprintf('INSERT INTO %s(', $entity->getTableName());

            $fields  = $entity->getFields();
            $values  = array();
            $columns = array();

            foreach (array_keys($fields) as $column) {
                $getter = 'get' . ucfirst($column);
                $value = $entity->$getter();
                if ($value) {
                    $columns[] = $column;
                    $values[]  = $fields[$column]->format($value);
                }
            }

            $baseSql .= implode(',', $columns) . ')';
            $baseSql .= ' VALUES(' . implode(',', $values) . ')';
            $this->database->execute($baseSql);
            return true;
        }

        public function delete(DbEntity $entity) {
            $baseSql = sprintf('DELETE FROM %s WHERE id = %s', $entity->getTableName(), $entity->getId());
            $this->database->execute($baseSql);
        }
    }
}
?>
