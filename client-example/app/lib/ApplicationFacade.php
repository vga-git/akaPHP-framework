<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\lib {
    use org\akaPHP\core\Controller;
    use org\akaPHP\core\AppFacade;
    use org\akaPHP\core\Config;
    use org\akaPHP\db\MySqlConnection;
    use org\akaPHP\db\DbManager;
    use app\lib\model\User;
    use org\akaPHP\db\Info;

    /**
    * Description of ApplicationFacade
    *
    * @author vgar
    */
    class ApplicationFacade extends AppFacade {
        const
            USER_SESSION_KEY = 'user_email';

        private $_user;

        protected function initDbManager() {
            $info = new Info(
                'localhost',
                'akaPHP',
                'akaPHP',
                'akaPHP'
            );
            $mysql = new MySqlConnection($info);
            return new DbManager($mysql);
        }

        /**
         * Implement the method to set variables shared across all controllers.
         *
         * @param Controller $ctl the controller instance
         *
         * @return void
         */
        public function setActiveController(Controller $ctl) {
            $ctl->user = $this->_user;
        }

        public function getLayout(Controller $ctl) {
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
        public function __construct() {
            parent::__construct();
            $this->_user = new User();
            if (isset($_SESSION[self::USER_SESSION_KEY])) {
                $this->_user->setEmail($_SESSION[self::USER_SESSION_KEY]);
                $entities = $this->getDbManager()->load($this->_user);
                if (count($entities) === 1) {
                    $this->_user = $entities[0];
                } else {
                    $this->removeFromSession(self::USER_SESSION_KEY);
                }
            }
        }

        public function storeToSession($key, $value) {
            $_SESSION[self::USER_SESSION_KEY] = $value;
        }

        public function removeFromSession($key) {
            unset($_SESSION[$key]);
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
