<?php
namespace org\akaPHP\core {
    class DbManager {
        protected $config;
        private $_isConnected;
        private $_connection;


        public function __construct($config) {
            $this->config = $config;
        }

        public function connect() {
            if (! $this->_isConnected) {
                $this->_doConnect();
            }
        }

        public function execute($query) {
            $this->connect();
            $results = $this->_connection->query($query);
            return $results;
        }

        public function disconnect() {
            if ($this->_isConnected) {
                $this->_doDisconnect();
            }
        }

        private function _doConnect() {
            if (! $this->_connection) {
                $this->_connection = new \PDO(
                    sprintf(
                        "mysql:host=%s;dbname=%s", 
                        $this->config['host'], 
                        $this->config['database']
                    ),
                    $this->config['user'], 
                    $this->config["password"]
                );
            }
            $this->_isConnected = true;
        }

        private function _doDisconnect() {
            $this->_connection = null;
            $this->_isConnected = false;
        }
    }
}
?>
