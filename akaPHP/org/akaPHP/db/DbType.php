<?php
namespace org\akaPHP\db {
    abstract class DbType {
        public function format($element) {
            return $element;
        }
    }
}

