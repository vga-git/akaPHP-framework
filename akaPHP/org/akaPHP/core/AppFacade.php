<?php
namespace org\akaPHP\core {

    /**
     * Represent an Application facade that centralize
     * commonly used objects instance.
     *
     * @author victor garnier <vga.nantes@gmail.com>
     *
     * @copyright akaPHP framework 2011 - 2012
     */
    abstract class AppFacade {
        protected $config;

        /**
         * Application facade contructor. The Config object contains
         * parameters to share across the application.
         * This object is accessible every where from the Context
         * singleton instance.
         *
         * @param Config $config the config object.
         *
         * @return void
         */
        public function __construct(Config $config) {
            $this->config = $config;
            $this->database = new DbManager($config->getDatabaseInfo());
        }

        /**
         * the active controller instance that is about to be executed.
         * Allows the real facade to interact with the controller before
         * the execute method is call.
         *
         * @param Controller $ctl the active controller instance
         *
         * @return void
         */
        public abstract function setActiveController(Controller $ctl);

        /**
         * Entry point to start the application.
         *
         * @return void
         */
        public function startup() {
            Context::getInstance($this)->dispatch();

            register_shutdown_function(function() {
                Context::getInstance()->shutdown();
            });
        }

        public function redirect($routing = '') {
            $_SERVER['REQUEST_URI'] = $routing;
            Context::getInstance()->shutdown();
            header('Location: ' . 'http://' . $_SERVER['SERVER_NAME'] . '/' . urldecode($routing), true);
        }

        /**
         * Returns the DbManager instance or its derivate one
         *
         * @return DbManager the Database manager instance
         */
        public function getDatabase() {
            return $this->database;
        }

        /**
         * Returns the configuration object.
         *
         * @return Config the configuration object
         */
        public function getConfig() {
            return $this->config;
        }
    }
}

?>
