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
         * Implement the method to set variables shared across all controllers.
         *
         * @param core\Controller $ctl the controller instance
         *
         * @return void
         */
        public function setActiveController(core\Controller $ctl) {
            $ctl->user = $this->_user;
        }

        public function getLayout(core\Controller $ctl) {
            if ($ctl->getModulePath() === 'app/modules/login') {
                return '/app/layouts/loginLayout.php';
            }
            return '/app/layouts/layout.php';
        }

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
