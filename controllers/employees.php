<?php

include "models/employees.php";

class Employees_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Список сотрудников");
    }

    function get_data() {
        return Employees_Model::singleton()->get_array();
    }

}