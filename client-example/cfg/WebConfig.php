<?php
namespace cfg
{
    use org\akaPHP\core;

    class WebConfig extends core\Config {
        public function getDatabaseInfo() {
            return array (
                'host' => 'localhost',
                'database' => 'akaPHP',
                'user' => 'akaPHP',
                'password' => 'akaPHP'
            );
        }
    }
}
?>
