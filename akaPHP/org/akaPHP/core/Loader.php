<?php
namespace org\akaPHP\core {
    
    class Loader {
        protected static $loader = null;
        
        protected function __construct() {
            spl_autoload_register('org\akaPHP\core\Loader::autoLoad');
        }
        
        public static function init() {
            if (null === self::$loader) {
                self::$loader = new Loader();
            } else {
                // TODO raise error already initialized
            }
            return self::$loader;
        }
        
        public function autoLoad($class) {
            $relativePath = $class;

            if (php_uname('s') === 'Linux') {
                $relativePath = str_replace("\\", "/", $class);    
            }

            $fullpath = ROOT_DIR . DIRECTORY_SEPARATOR . $relativePath . '.php';
            if (file_exists($fullpath)) {
                include_once($fullpath);    
            } else {
                $fullpath = FRAMEWORK_ROOT . DIRECTORY_SEPARATOR . $relativePath . '.php';
                include_once($fullpath);
            }
            
        }
    }
}

?>
