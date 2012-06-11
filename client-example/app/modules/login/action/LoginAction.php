<?php

namespace app\modules\login\action {
    use org\akaPHP\core\Controller;
    use org\akaPHP\core\Request;
    use org\akaPHP\core\AppFacade;
    use app\lib\model\User;
    use app\lib\ApplicationFacade;

    /**
    * Description of LoginAction
    *
    * @author vgar
    */
    class LoginAction extends Controller {
        protected $errMsg;

        /**
         * akaPHP implementation. Handle the request.
         *
         * @param core\Request   $request the request object
         * @param core\AppFacade $facade  the facade object
         *
         * @return void
         */
        protected function handleRequest() {
           if (! $this->request->isPostBack()) {
                $this->setTemplate('LoginForm');
            } else {
                $dbManager = $this->facade->getDbManager();

                $user = new User();

                $user->setEmail($this->request->getParam('email'));
                $user->setPassword($this->request->getParam('password'));

                $results = $dbManager->load($user);
                
                if (count($results) > 0) {
                    $user = $results[0];    
                }
                
                $this->errMsg = '';
                if ($user->getId()) {
                    $this->facade->storeToSession(
                        ApplicationFacade::USER_SESSION_KEY,
                        $user->getEmail()
                    );
                    $this->facade->redirect('Welcome');
                } else {
                    $this->errMsg = 'Login fail. Please try again';
                    $this->setTemplate('LoginForm');
                }
            }
        }

        protected function handleRequestLogoff() {
            $this->facade->removeFromSession(ApplicationFacade::USER_SESSION_KEY);
            $this->facade->redirect('login');
        }

        protected function handleRequestCreate() {
            if (! $this->request->isPostBack()) {
                $this->setTemplate('LoginCreate');
            } else {
                $user = new User();
                $user->setEmail($this->request->getParam('email'));
                $user->setPassword($this->request->getParam('password'));
                $db = $this->facade->getDbManager();
                $success = $db->save($user);
                if ($success) {
                     $this->facade->redirect();
                } else {
                    echo 'oups';
                    die();
                }
            }
        }
    }
}

?>
