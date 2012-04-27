<?php
namespace org\akaPHP\core {
    /**
     * Represent an Application facade that centralize
     * commonly use objects instance.
     * 
     * @author victor garnier <vga.nantes@gmail.com>
     * 
     * @copyright akaPHP framework 2011 - 2012 
     */
    abstract class AppFacade {
        protected $config;
        
        public function __construct(Config $config) {
            $this->config = $config;
            $this->database = new DbManager($config->getDatabaseInfo());
        }
        
        public function startup() {
            Context::getInstance($this)->dispatch();

            register_shutdown_function(function() {
                Context::getInstance()->shutdown();
            });
        }
        
        public function getDatabase() {
            return $this->database;
        }
        
        public function getConfig() {
            return $this->config;
        }
    }
}

?>
