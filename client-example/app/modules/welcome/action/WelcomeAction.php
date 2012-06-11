<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\welcome\action;

use org\akaPHP\core\Controller;
use org\akaPHP\core\Request;
use org\akaPHP\core\AppFacade;

/**
 * Description of welcomeAction
 *
 * @author vgar
 */
class WelcomeAction extends Controller {
    protected function handleRequest() {
        if (! $this->user->getId()) {
            $this->facade->redirect('login');
            return;
        }
        $this->setTemplate('Welcome');
    }
}

?>
