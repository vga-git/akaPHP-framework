<?php
namespace org\akaPHP\exceptions {
    class AkaException extends \Exception {
        const LOADER_EXCEPTION = 'akaPHP: The loader has already been initialized !';
        const LOADER_EXCEPTION_NUM = 1;
        const ACTION_EXCEPTION = 'akaPHP: The method %s of module %s does not exists !';
        const ACTION_EXCEPTION_NUM = 2;
        const OVERRIDE_EXCEPTION = 'akaPHP: This method must be overrided !';
        const OVERRIDE_EXCEPTION_NUM = 3;
    }
}


?>
