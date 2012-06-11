<?php
namespace org\akaPHP\db {
    class DbTypeString extends DbType {

        public function format($element) {
            return '"' . $element . '"';
        }
    }
}
