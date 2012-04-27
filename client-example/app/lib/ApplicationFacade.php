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

        public function __construct(core\Config $config) {
            parent::__construct($config);
        }
    }
}


?>
