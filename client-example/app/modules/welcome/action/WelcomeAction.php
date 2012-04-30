<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\welcome\action;
use org\akaPHP\core;

/**
 * Description of welcomeAction
 *
 * @author vgar
 */
class WelcomeAction extends core\Controller {

    protected function handleRequest(core\Request $request, core\AppFacade $facade) {
        $this->user = $facade->getUser();

        if (! $this->user->isLogued()) {
            $facade->redirect('login');
            return;
        }

        $this->setTemplate('Welcome');
    }
}

?>
