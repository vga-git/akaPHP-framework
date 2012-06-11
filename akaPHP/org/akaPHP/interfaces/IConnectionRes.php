<?php
namespace org\akaPHP\interfaces {
    interface IConnectionRes {
        public function getInfo();
        public function connect();
        public function disconnect();
        public function isConnected();
        public function execute($rawSql);
    }
}
?>
