<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\lib {
    use org\akaPHP\core;
    
    /**
    * Description of ApplicationFacade
    *
    * @author vgar
    */
    class ApplicationFacade extends core\AppFacade {
        private $_user;
        
        /**
         * override of the constructor to create the user instance
         * 
         * @param core\Config $config the config object
         * 
         * @return void
         */
        public function __construct(core\Config $config) {
            parent::__construct($config);
            $this->_user = new User();
        }
        
        /**
         * returns the logued user.
         * 
         * @return app\lib\user the user 
         */
        public function getUser() {
            return $this->_user;
        }
    }
}


?>
