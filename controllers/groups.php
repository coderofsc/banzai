<?php
include "models/groups.php";

class Groups_Controller extends Controller {

    public function get_info()
    {
        return array("title" => "Список групп");
    }

    function get_data() {
        return Groups_Model::singleton()->get_array();
    }

}