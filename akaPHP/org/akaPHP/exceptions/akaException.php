<?php
namespace org\akaPHP\exceptions {
    class akaException extends \Exception {
        const LOADER_EXCEPTION = 'akaPHP: The loader has already been initialized !';
        const LOADER_EXCEPTION_NUM = 1;
        const ACTION_EXCEPTION = 'akaPHP: The method %s of module %s does not exists !';
        const ACTION_EXCEPTION_NUM = 2;
    }
}


?>
