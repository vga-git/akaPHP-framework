<?php
namespace org\akaPHP\core {
    
    /**
     * Abstract to create a controller from 
     */
    abstract class Controller {
        protected 
            $context,
            $facade,
            $template = NULL;

        /**
         * implementation method called in execute
         * 
         * @see execute() 
         * 
         * @return void
         */
        protected abstract function handleRequest();

        /**
         * Execute method of the implementation
         * 
         * @return void 
         */
        public function execute() {
            // provide shortcuts for the client
            $this->context = Context::getInstance();
            $this->facade = $this->context->getFacade();

            // top object running this method
            $runner = str_replace("\\", "/", get_class($this));

            $lastSlash = strrpos($runner, '/');

            // on client side the module must be in modules/$moduleName/action/$ModuleName.php
            $activeModule = str_replace('/action', '', substr($runner, 0, $lastSlash));
            $viewDir = ROOT_DIR . '/' . $activeModule . '/';

            // set some default values for the view
            $this->title="default application";

            // calls the client implementation (the client set the template)
            $this->handleRequest();

            if ($this->template) {
                // defines the response content
                $this->response = $viewDir . $this->template . '.php';
                include_once(ROOT_DIR . '/app/layout.php');
            }
        }

        /**
         * Setter method to define the template
         * 
         * @param string $template  the template name
         * 
         * @return void
         */
        protected function setTemplate($template) {
            $this->template = $template;
        }
    }
}


?>
