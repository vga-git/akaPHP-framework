<?php
namespace org\akaPHP\core {
    abstract class Controller {
        protected 
            $context,
            $facade,
            $template = NULL;

        protected abstract function handleRequest();

        public function execute() {

            $this->context = Context::getInstance();
            $this->facade = $this->context->getFacade();

            $runner = str_replace("\\", "/", get_class($this));

            $lastSlash = strrpos($runner, '/');

            $activeModule = str_replace('/action', '', substr($runner, 0, $lastSlash));
            $viewDir = ROOT_DIR . '/' . $activeModule . '/';

            $this->title="default application";

            $this->handleRequest();

            if ($this->template) {
                $this->response = $viewDir . $this->template . '.php';
                include_once(ROOT_DIR . '/app/layout.php');
            }
        }

        protected function setTemplate($template) {
            $this->template = $template;
        }
    }
}


?>
