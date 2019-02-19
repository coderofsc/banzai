<?php
include "models/employees.php";
include "models/groups.php";
include "models/positions.php";

class Employees_Form_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Добавить сотрудника");
    }

    public function get_request()
    {

        $this->request["id"] = isset($_GET["id"])?intval($_GET["id"]):0;
        $this->request["data"] = isset($_POST["data"])?($_POST["data"]):array();

        if (isset($_POST["save"])) {

            if ($this->request["id"]) {

                Employees_Model::singleton()->save($this->request["id"], $this->request["data"]);
                // Сохранение
            } else {
                Employees_Model::singleton()->add($this->request["data"]);
                // Добавленеие
            }

            header("location: index.php?route=employees");
            exit;

        }
    }

    function get_data() {
        $data = array();
        $data["ar_groups"] = Groups_Model::singleton()->get_array();
        $data["ar_positions"] = Positions_Model::singleton()->get_array();

        if ($this->request["id"]) {
            $data["employee"] = Employees_Model::singleton()->get_one($this->request["id"]);
        }

        return $data;
    }

    public function process()
    {
        $this->get_request();
    }
}