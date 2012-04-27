<?php
namespace org\akaPHP\core {
    /**
     * Object to encapsulate the request content 
     */
    class Request {
        const
            GET  = 'GET',
            POST = 'POST';
        
        private $_params = array();
        
        /*
         * Default constructor
         */
        public function __construct() {
            $this->_initializeRequest();
        }
        
        /**
         * Check to see if a given param exists
         * 
         * @param string $paramName the name of the parameter
         * 
         * @return boolean true or false
         */
        public function hasParam($paramName) {
            return array_key_exists($paramName, $this->_params);
        }
        
        /**
         * Returns the param content or an empty string
         * 
         * @param string $paramName the parameter name
         * 
         * @return string empty or the param content
         */
        public function getParam($paramName) {
            if (! $this->hasParam($paramName)) { return ''; }
            return $this->_params[$paramName];
        }
        
        /**
         * Determine if the request is a $_GET or a $_POST
         * request and saves the array into the params array
         * 
         * @return void 
         */
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
