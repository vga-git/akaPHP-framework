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
    
    protected function handleRequest() {
        $request = $this->context->getRequest();
        
        //TODO use the request object to set the good template
        $this->setTemplate('Welcome');
        
        $database = $this->context->getFacade()->getDatabase();
        
        $results = $database->execute("select * from users");
        
        while ($row = $results->fetch ()) {
            echo $row['name'];
        }
        
        $nom = $request->getParam('nom');
        $this->variable = 'bonjour monsieur ' . $nom;
    }
}

?>
