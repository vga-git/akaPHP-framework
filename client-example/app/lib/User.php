<?php
namespace app\lib {
    use org\akaPHP\core;
    
    class User {
        private $_email;
        
        public function __construct() {
            session_start();
            $this->_initialize();
        }
        
        public function isLogued() {
            return strlen($this->_email) > 0;
        }
        
        public function authenticate($password) {
            $db = core\Context::getInstance()->getFacade()->getDatabase();
            
            $query = 'select count(id) as member from users ';
            $query .= 'where email="' . $this->_email . '" ';
            $query .= 'and password = "' . $password . '"';
            
            $results = $db->execute($query);
            
            $row = $results->fetch();
            if ($row && $row['member']) {
                $_SESSION['user_email'] = $this->_email;
                return true;
            }
            return false;
        }
        
        public function getEmail() {
            return $this->_email;
        }
        
        public function setEmail($value) {
            $this->_email = $value;
        }
        
        private function _initialize() {
            if(isset($_SESSION['user_email'])) {
                $this->_email = $_SESSION['user_email'];
            }
        }
    }
}
?>
