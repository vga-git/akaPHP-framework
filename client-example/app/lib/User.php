<?php
namespace app\lib {
    use org\akaPHP\core;

    class User {
        private $_email;

        public function __construct() {
            $this->_initialize();
        }

        public function isLogued() {
            return isset($_SESSION['user_email']) &&
                    $_SESSION['user_email'] === $this->_email;
        }

        public function logOff() {
            $_SESSION['user_email'] = null;
        }

        public function authenticate($password) {
            $db = core\Context::getInstance()->getFacade()->getDatabase();

            $query = 'select count(id) as member from users ';
            $query .= 'where email="' . $this->_email . '" ';
            $query .= 'and password = "' . $password . '"';

            $results = $db->execute($query);

            if (! $results) {
                return false;
            }

            $row = $results->fetch();
            if ($row && $row['member'] && count($row['member']) == 1) {
                $_SESSION['user_email'] = $this->_email;
                return true;
            }
            return false;
        }

        public function save($password) {
            $db = core\Context::getInstance()->getFacade()->getDatabase();
            $db->connect();

            $sql = 'insert into users(email, password) ';
            $sql .= 'values("' . $this->_email . '","' . $password . '")';
            $query = $db->getDbh()->prepare($sql);
            $query->execute();

            return true;
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
