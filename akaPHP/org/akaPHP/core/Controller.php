<?php
namespace org\akaPHP\core {

    use org\akaPHP\exceptions;

    /**
     * Abstract to create a controller from
     */
    abstract class Controller {
        protected
            $template = NULL,
            $response,
            $modulePath,
            $actionName;

        /**
         * implementation method called in execute
         *
         * @param Request $request the request object
         *
         * @see execute()
         *
         * @return void
         */
        protected abstract function handleRequest(Request $request, AppFacade $facade);

        /**
         * Returns the active module path for this controller.
         *
         * @return string The relative path from root of this controller
         */
        public function getModulePath() {
            return $this->modulePath;
        }

        /**
         * Returns the active action name for this controller.
         *
         * @return string the action name (handleRequestActionName)
         */
        public function getActionName() {
            return $this->actionName;
        }

        /**
         * Execute method of the implementation
         *
         * @return void
         */
        public function execute($actionName) {
            $this->actionName = $actionName;

            // top object running this method
            $runner = str_replace("\\", "/", get_class($this));

            $lastSlash = strrpos($runner, '/');

            // on client side the module must be in modules/$moduleName/action/$ModuleName.php
            $this->modulePath = str_replace('/action', '', substr($runner, 0, $lastSlash));
            $viewDir = ROOT_DIR . '/' . $this->modulePath . '/';

            // set some default values for the view
            $this->title="default application";

            $action = 'handleRequest' . ucfirst($actionName);

            if (! method_exists($this, $action)) {
                throw new exceptions\akaException(
                    sprintf(exceptions\akaException::ACTION_EXCEPTION, $action, $this->modulePath),
                    exceptions\akaException::ACTION_EXCEPTION_NUM
                );
            }


            // calls the client implementation (the client set the template)
            $this->$action(
                Context::getInstance()->getRequest(),
                Context::getInstance()->getFacade()
            );

            if ($this->template) {
                // defines the response content
                $this->response = $viewDir . $this->template . '.php';
                $layoutPath = Context::getInstance()->getFacade()->getLayout($this);
                include_once(ROOT_DIR . $layoutPath);
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
