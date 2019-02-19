<?php
include "models/groups.php";

class Groups_Form_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Добавить группу");
    }

    public function get_request()
    {

        $this->request["id"] = isset($_GET["id"])?intval($_GET["id"]):0;
        $this->request["data"] = isset($_POST["data"])?($_POST["data"]):array();

        if (isset($_POST["save"])) {

            if ($this->request["id"]) {
                Groups_Model::singleton()->save($this->request["id"], $this->request["data"]);
                // Сохранение
            } else {
                Groups_Model::singleton()->add($this->request["data"]);
                // Добавленеие
            }

            header("location: index.php?route=groups");
            exit;

        }
    }


    public function process()
    {
        $this->get_request();
    }
}