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
        $user = $facade->getUser();
        
        if (! $user->isLogued()) {
            $facade->redirect('login');
            return;
        }
        
        //TODO use the request object to set the good template
        $this->setTemplate('Welcome');
        
        $nom = $request->getParam('nom');
        $this->variable = 'bonjour monsieur ' . $nom;
    }
}

?>
