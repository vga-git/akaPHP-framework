<?php
namespace org\akaPHP\core {
    
    final class Context {
        private static $_instance;
        const 
            ROOT = 'Index.php',
            MOD_ROOT = '\\app\\modules\\';
        
        private 
            $_facade,
            $_request;
        
        private function __construct(AppFacade $facade) {
            $this->_facade = $facade;
            $this->_request = new Request();
        }
        
        public static function getInstance(AppFacade $facade = NULL) {
            if (self::$_instance === NULL) {
                self::$_instance = new Context($facade);
            }
            return self::$_instance;
        }
        
        public function dispatch() {
            $routing = ucfirst(str_replace('/', '', $_SERVER['REQUEST_URI']));
            $argsStart = strpos($routing, '?');

            if (is_numeric($argsStart)) {
                $routing = substr($routing, 0, $argsStart);
            }

            if ($routing === self::ROOT || $routing === '') {
                $this->_runModule('Welcome');
            } else {
                $this->_runModule($routing);
            }
        }
        
        public function shutdown() {
        }
        
        public function getRequest() {
            return $this->_request;
        }

        public function getFacade() {
            return $this->_facade;
        }
        
        private function _runModule($moduleName) {
            $subDir = strtolower($moduleName);
            $directory = ROOT_DIR . '/app/modules/' . $subDir;

            if (! file_exists($directory)) {
                // TODO raise error
                echo sprintf('oups the module %s is not ready', $directory);
            } else {
                $class = self::MOD_ROOT . $subDir . '\\action\\' . $moduleName . 'Action';
                $ctl = new $class();
                $ctl->execute();
            }
        }
    }
}
?>
