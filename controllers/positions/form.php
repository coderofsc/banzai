<?php
include "models/positions.php";

class Positions_Form_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Добавить должность");
    }

    public function get_request()
    {

        $this->request["id"] = isset($_GET["id"])?intval($_GET["id"]):0;
        $this->request["data"] = isset($_POST["data"])?($_POST["data"]):array();

        if (isset($_POST["save"])) {

            if ($this->request["id"]) {
                // Сохранение
                Positions_Model::singleton()->save($this->request["id"], $this->request["data"]);
            } else {
                // Добавленеие
                Positions_Model::singleton()->add($this->request["data"]);
             }

            header("location: index.php?route=positions");
            exit;

        }
    }


    public function process()
    {
        $this->get_request();
    }
}