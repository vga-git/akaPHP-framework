<?php
namespace org\akaPHP\db {
    class Info {
        protected $host;
        protected $port;
        protected $databaseName;
        protected $user;
        protected $password;

        public function __construct($host, $databaseName, $user, $password) {
            $this->host = $host;
            $this->databaseName =$databaseName;
            $this->user = $user;
            $this->password = $password;
        }

        public function getHost() {
            return $this->host;
        }

        public function setHost($value) {
            $this->host = $value;
        }

        public function getPort() {
            return $this->port;
        }

        public function setPort($value) {
            $this->port = $value;
        }

        public function getDatabaseName() {
            return $this->databaseName;
        }

        public function setDatabaseName($value) {
            $this->databaseName = $value;
        }

        public function getUser() {
            return $this->user;
        }

        public function setUser($value) {
            $this->user = $value;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($value) {
            $this->password = $value;
        }
    }
}
?>
