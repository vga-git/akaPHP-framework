<?php
namespace org\akaPHP\db {
    abstract class DbType {
        public abstract function format($element);
    }
}

