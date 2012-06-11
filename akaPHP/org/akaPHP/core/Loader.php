<?php
namespace org\akaPHP\core {
    use org\akaPHP\exceptions;

    final class Loader {
        private $_routes;

        private static $_loader = null;

        private function __construct() {
            spl_autoload_register('org\akaPHP\core\Loader::autoLoad');
            $this->_routes = explode(PATH_SEPARATOR, get_include_path());
        }

        public function addRoute($rootPath) {
            $this->_routes[] = $rootPath;
        }

        public static function init() {
            if (null === self::$_loader) {
                self::$_loader = new Loader();
                return self::$_loader;
            } else {
                throw new exceptions\AkaException(
                    exceptions\AkaException::LOADER_EXCEPTION,
                    exceptions\AkaException::LOADER_EXCEPTION_NUM
                );
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
            $relativePath = DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class);

            foreach($this->_routes as $route) {
                $fullpath = $route . $relativePath . '.php';

                if (file_exists($fullpath)) {

                    include_once $fullpath;
                    break;
                }
            }
        }
    }
}

?>
