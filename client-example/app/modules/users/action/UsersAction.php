<?php

namespace app\modules\users\action {
    use org\akaPHP\core\Controller;
    use org\akaPHP\core\Request;
    use org\akaPHP\core\AppFacade;
    use app\lib\model;
    use app\lib\ApplicationFacade;
    class UsersAction extends Controller {

        protected $dbManager;

        protected function prepare() {
            parent::prepare();
            $this->dbManager = $this->facade->getDbManager();
        }

        protected function handleRequest() {
            if (! $this->request->isPostBack()) {

                $this->users = $this->dbManager->load(new model\User());

                $this->setTemplate('ListUsers');
            }
        }

        protected function handleRequestDelete() {
            // $this->request->getParam('id');
            $this->facade->redirect('users');
        }
    }
}

