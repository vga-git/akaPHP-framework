<?php
namespace app\lib\model {
    use org\akaPHP\db;

    class User extends db\DbEntity {
        private
            $_email,
            $_password;

        public function setEmail($value) {
            $this->_email = $value;
            $this->isDirty = true;
        }

        public function getEmail() {
            return $this->_email;
        }

        public function setPassword($value) {
            $this->_password = $value;
            $this->isDirty = true;
        }

        public function getPassword() {
            return $this->_password;
        }

        public static function getFields() {
            return array (
                'email' => new db\DbTypeString(),
                'password' => new db\DbTypeString()
            );
        }

        public static function getTableName() {
            return "user";
        }

        public function isLogued() {
            return $this->getId() !== null;
        }

        public function newInstance() {
            return new User();
        }
    }
}

?>
