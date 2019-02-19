<?php
abstract class Model {

    protected $table = "";

    protected function __construct() {
        $this->table = explode('_', strtolower(get_called_class()))[0];
    }

    public function delete($id) {
        return DB::exec('DELETE FROM '.$this->table.' WHERE id = '.DB::quote($id));
    }

    public function get_one($id) {
        return DB::fetchAssoc('SELECT * FROM '.$this->table.' WHERE id = ' . DB::quote($id));
    }

    public function get_array() {
        $qres = DB::query('SELECT * FROM '.$this->table);
        return $qres->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($id, $data) {
    }

    public function add($data) {
    }

}
