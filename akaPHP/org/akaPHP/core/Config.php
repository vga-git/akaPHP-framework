<?php
namespace org\akaPHP\core {

    /**
     * this Object is inherited by the client and
     * contains abstract methods so that the client
     * can set frameworks configuration settings.
     */
    abstract class Config {

        /**
         * Must return an associative Array containing database information.
         *
         * @return array the database information associative array.
         */
        public abstract function getDatabaseInfo();
    }
}

?>
