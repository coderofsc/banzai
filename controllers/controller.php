<?php
abstract class Controller {

    protected $request = array();
    protected  $controller_content = "";
    protected  $controller_info    = array();

    function get_info() {}
    function get_request() {}
    function get_data() { return false; }

    function display() {

        $data = $this->get_data();

        $template_part = explode("_", strtolower(get_called_class()), 3);
        array_pop($template_part);
        $template_path = "views/".implode("/", $template_part).".php";

        ob_start();
        include $template_path;
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    function process() {}
}