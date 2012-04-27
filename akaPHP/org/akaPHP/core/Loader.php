<?php
namespace org\akaPHP\core {
    
    final class Loader {
        private static $_loader = null;
        
        private function __construct() {
            spl_autoload_register('org\akaPHP\core\Loader::autoLoad');
        }
        
        public static function init() {
            if (null === self::$_loader) {
                self::$_loader = new Loader();
            } else {
                // TODO raise error already initialized
            }
        }
        
        /**
         * autoload function called by PHP spl mecanism
         * 
         * @param string $class the class complete namespace
         */
        public function autoLoad($class) {
            $relativePath = $class;
            
            // Replace the backslashes by the DIRECTORY_SEPARATOR value
            $relativePath = str_replace("\\", DIRECTORY_SEPARATOR, $class);    
            
            // client file ?
            $fullpath = ROOT_DIR . DIRECTORY_SEPARATOR . $relativePath . '.php';
            
            if (file_exists($fullpath)) {
                include_once($fullpath);    
            } else {
                // framework file ?
                $fullpath = FRAMEWORK_ROOT . DIRECTORY_SEPARATOR . $relativePath . '.php';
                include_once($fullpath);
            }
            
        }
    }
}

?>
