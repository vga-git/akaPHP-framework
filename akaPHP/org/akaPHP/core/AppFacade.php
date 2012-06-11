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
        protected
            $dbManager;

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
        public function __construct() {
            $this->dbManager = $this->initDbManager();
        }

        protected abstract function initDbManager();

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
         * Must return the layout (decorator) of the current template
         * defined in the running controller
         *
         * @return string the relative path (relative to ROOT) of the layout template.
         */
        public abstract function getLayout(Controller $ctl);

        /**
         * Entry point to start the application.
         *
         * @return void
         */
        public function startup() {
            Context::getInstance($this)->dispatch();

            register_shutdown_function(function() {
                Context::getInstance()->cleanup();
            });
        }

        public function redirect($routing = '') {
            $_SERVER['REQUEST_URI'] = $routing;
            Context::getInstance()->cleanup();
            header('Location: ' . 'http://' . $_SERVER['SERVER_NAME'] . '/' . urldecode($routing), true);
        }

        /**
         * returns the db manager
         *
         * @return \org\akaPHP\db\DbManager the db manager
         */
        public function getDbManager() {
            return $this->dbManager;

        }
    }
}

?>
