<?php
namespace org\akaPHP\db {

    use org\akaPHP\interfaces;

    abstract class DbConnection implements interfaces\IConnectionRes {
        protected
            $info,
            $connection;

        /**
         * Database manager object to manage connection.
         *
         * @param array $config the configuration for the database.
         */
        public function __construct(Info $dbInfo) {
            $this->info = $dbInfo;
        }

        public abstract function doConnect();

        public abstract function doDisconnect();

        public function execute($rawSql) {
            echo $rawSql;
        }
        
        public function connect() {
            if (! $this->isConnected()) {
                $this->doConnect();
            }
        }

        public function disconnect() {
            if ($this->isConnected()) {
                $this->doDisconnect();
            }
        }

        public function getInfo() {
            return $this->info;
        }

        public function isConnected() {
            return $this->connection != null;
        }
    }
}
?>
