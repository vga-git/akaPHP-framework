<?php
namespace org\akaPHP\core {
    class DbManager {

        protected
            $config,
            $isConnected,
            $connection;

        /**
         * Database manager object to manage connection.
         *
         * @param array $config the configuration for the database.
         */
        public function __construct(array $config) {
            $this->config = $config;
        }

        public function getDbh() {
            return $this->connection;
        }

        /**
         * Will open the connection if it is not already open.
         *
         * @return void
         */
        public function connect() {
            if (! $this->isConnected) {
                $this->_doConnect();
            }
        }

        /**
         * Executes a raw query from the open connection.
         *
         * @param string $query the sql query
         *
         * @return PDO_Result the results
         */
        public function execute($query) {
            $this->connect();
            $results = $this->connection->query($query);
            return $results;
        }

        /**
         * Will disconnect from the database if it is connected
         *
         * @return void
         */
        public function disconnect() {
            if ($this->isConnected) {
                $this->_doDisconnect();
            }
        }

        /**
         * Actually connects to the database with the config settings
         * given in the constructor method
         *
         * @return void
         */
        private function _doConnect() {
            if (! $this->connection) {
                $this->connection = new \PDO(
                    sprintf(
                        "mysql:host=%s;dbname=%s",
                        $this->config['host'],
                        $this->config['database']
                    ),
                    $this->config['user'],
                    $this->config["password"]
                );
            }
            $this->isConnected = true;
        }

        /**
         * Will set the PDO handle to null
         *
         * @return void
         */
        private function _doDisconnect() {
            $this->connection = null;
            $this->isConnected = false;
        }
    }
}
?>
