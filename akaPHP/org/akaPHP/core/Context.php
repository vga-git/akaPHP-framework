<?php
namespace org\akaPHP\core {


    /**
     * This singleton object represents the running context
     * of the web application. It holds the request and the facade
     * object.
     */
    final class Context {
        private static $_instance;
        const
            ROOT = 'Index.php',
            MOD_ROOT = '\\app\\modules\\';

        private
            $_facade,
            $_request;

        protected
            $activeController;

        /**
         * Private constructor to prevent instance creation
         * from outside.
         *
         * @param AppFacade $facade the facade to create a context for
         */
        private function __construct(AppFacade $facade) {
            $this->_facade = $facade;
            $this->_request = new Request();
        }

        /**
         * Entry point to the running context. If this singleton
         * is null then the optional param object AppFacade must be provided.
         *
         * @param AppFacade $facade optional if object was previously created
         *
         * @return type Context the running context
         */
        public static function getInstance(AppFacade $facade = NULL) {
            if (self::$_instance === NULL) {
                self::$_instance = new Context($facade);
            }
            return self::$_instance;
        }

        /**
         * Will call the module controller that match the request_uri
         * server property. Builds the routing
         *
         * @return void
         */
        public function dispatch($isRedirection = false) {
            $uri = $_SERVER['REQUEST_URI'];

            if ($isRedirection) {
                header('Location: ' . urldecode($uri), true);
                return;
            }

            $argsStart = strpos($uri, '?');

            if (is_numeric($argsStart)) {
                $uri = substr($uri, 0, $argsStart);
            }

            $routingTokens = explode('/', $uri);

            $module = '';
            if (count($routingTokens) > 1) {
                $module = ucfirst($routingTokens[1]);
            }

            $action = '';
            if (count($routingTokens) > 2) {
                $action = $routingTokens[2];
            }

            if ($module === self::ROOT || $module === '') {
                $this->_runModule('Welcome', $action);
            } else {
                $this->_runModule($module, $action);
            }
        }

        /**
         * Called by PHP when all scripts ended.
         * Do some clean up.
         *
         * @return void
         */
        public function cleanup() {
            // close the database connection ?

        }

        /**
         *return the request object.
         *
         * @return Request the request
         */
        public function getRequest() {
            return $this->_request;
        }

        /**
         * Returns the facade object
         *
         * @return AppFacade the facade
         */
        public function getFacade() {
            return $this->_facade;
        }

        /**
         * Compute the controller root from the module name
         * and then calls the execute method of this controller
         *
         * @param string $moduleName The module name
         */
        private function _runModule($moduleName, $actionName) {
            $subDir = strtolower($moduleName);
            $directory = ROOT_DIR . '/app/modules/' . $subDir;

            if (! file_exists($directory)) {
                // TODO raise error
                echo sprintf('oups the module %s is not ready', $directory);
            } else {
                $class = self::MOD_ROOT . $subDir . '\\action\\' . $moduleName . 'Action';
                $ctl = new $class();

                // sets the active controller instance
                $this->_facade->setActiveController($ctl);

                $ctl->execute($actionName);
            }
        }
    }
}
?>
