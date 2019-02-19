<?php
include_once "model.php";

class Positions_Model extends Model {
    private static $instance;

    private function __clone() { }

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function save($id, $data) {

        $stmt = DB::prepare('UPDATE '.$this->table.' set name = :name where id=:id');
        $stmt->bindParam(':name', $data["name"]);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function add($data) {

        $set = array();
        $set["name"] = "name = ".DB::quote(trim($data["name"]));

        return DB::query('INSERT INTO '.$this->table.' SET '.implode(",", $set));
    }

}