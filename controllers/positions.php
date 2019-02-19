<?php
include "models/positions.php";

class Positions_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Список должностей");
    }

    function get_data() {
        return Positions_Model::singleton()->get_array();
    }

}