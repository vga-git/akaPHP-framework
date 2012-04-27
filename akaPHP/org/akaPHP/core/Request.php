<?php
namespace org\akaPHP\core {
    
    class Request {
        const
            GET  = 'GET',
            POST = 'POST';
        
        private $_params = array();
        
        public function __construct() {
            $this->_initializeRequest();
        }
        
        public function hasParam($paramName) {
            return array_key_exists($paramName, $this->_params);
        }
        
        public function getParam($paramName) {
            if (! $this->hasParam($paramName)) { return ''; }
            return $this->_params[$paramName];
        }
        
        private function _initializeRequest() {
            if (count($_GET) > 0) {
                $this->_params = $_GET;
                $this->_reqMethod = self::GET;
            } else if (count($_POST) > 0) {
                $this->_params = $_POST;
                $this->_reqMethod = self::POST;
            }
        }
        
    }
}
?>
