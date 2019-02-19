<?php
include_once "model.php";

class Employees_Model extends Model {
    private static $instance;

    private function __clone() { }

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get_employees_groups($ar_id_employees, $key = "employee_id") {
        $result = array();

        $qres = DB::query('SELECT e_g.employee_id, e_g.group_id, groups.name name FROM employees_groups e_g LEFT JOIN groups ON (groups.id = e_g.group_id) WHERE employee_id	 IN ('.implode(',', $ar_id_employees).')');

        $groups = $qres->fetchAll(PDO::FETCH_ASSOC);

        foreach ($groups as $item) {
            $id = $item[$key];
            $result[$id][] = $item;
        }

        return $result;
    }

    public function get_one($id)
    {
        $result = parent::get_one($id);
        $ar_groups = $this->get_employees_groups(array($id), "group_id");

        $result["ar_groups"] = $ar_groups;

        return $result;
    }

    public function get_array() {
        $data = $ar_id_employees = array();

        $qres = DB::query('SELECT '.$this->table.'.*, positions.name pos_name FROM '.$this->table.' LEFT JOIN positions ON (positions.id = '.$this->table.'.pos_id)');
        $employees = $qres->fetchAll(PDO::FETCH_ASSOC);

        foreach ($employees as $item) {
            $id = $item["id"];
            $data[$id] = $item;
            $ar_id_employees[] = $id;
        }

        $ar_groups = $this->get_employees_groups($ar_id_employees);

        foreach ($ar_groups as $employee_id => $item) {
            $data[$employee_id]["ar_groups"] = $item;
        }

        return $data;
    }

    private function update_groups($id, $ar_groups) {

        $res = DB::exec('DELETE FROM employees_groups WHERE employee_id = '.DB::quote($id));


        if ($ar_groups) {
            $ar_values = array();
            foreach ($ar_groups as $group_id) {
                $ar_values[] = '('.$id.', '.$group_id.')';
            }

            $sql ='INSERT INTO employees_groups (employee_id,group_id) VALUES '.implode(",", $ar_values);
            DB::exec($sql);
        }
    }

    public function save($id, $data) {

        $stmt = DB::prepare("UPDATE ".$this->table." set fio=:fio, sex=:sex, pos_id=:pos_id, bd_year=:bd_year where id=:id");
        $stmt -> execute(array('fio'=>$data['fio'], 'sex'=>$data['sex'], 'bd_year'=>$data['bd_year'], 'pos_id'=>$data['pos_id'], 'id'=>$id));

        $this->update_groups($id, $data["id_group"]);
    }

    public function add($data) {

        $stmt = DB::prepare('INSERT INTO '.$this->table.' (fio,sex,pos_id,bd_year) VALUES (:fio, :sex, :pos_id, :bd_year)');
        $id = $stmt -> execute(array('fio'=>$data['fio'], 'sex'=>$data['sex'], 'bd_year'=>$data['bd_year'], 'pos_id'=>$data['pos_id']));

        $this->update_groups($id, $data["id_group"]);
    }



}