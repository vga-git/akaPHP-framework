<?php
namespace org\akaPHP\interfaces {
    use org\akaPHP\db;

    interface IManager {
        public function __construct(IConnectionRes $connection);
        public function getConnection();
        public function load(db\DbEntity $entity);
        public function save(db\DbEntity $entity);
        public function delete(db\DbEntity $entity);
    }
}
?>
