<?php
namespace org\akaPHP\core {
    use org\akaPHP\interfaces;

    abstract class ConnectionRes implements interfaces\IConnectionRes {
        protected
            $connectionInfo,
            $connectionHandle;

        public function connect() {

        }

        public function disconnect() {

        }

        public function getConnectionInfo() {
            return $this->connectionInfo;
        }

        public function isConnected() {
            return $this->connectionHandle != null;
        }
    }
}
?>
