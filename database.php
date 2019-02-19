<?

class DB
{
    static private $db;	// db handler

    static public function init() {
        try {
            self::$db = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",
                DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8')
            );

            self::$db->exec("SET NAMES utf8");
        }
        catch (PDOException $e)
        {
            die('<h3 style="color: blue">Ошибка соединения с БД. Повторите попытку через полминуты</h3>');
        }
    }

    static public function quote($str) {
        return self::$db->quote($str);
    }

    static public function query($sql) {
        return self::$db->query($sql);
    }

    static public function exec($sql) {
        return self::$db->exec($sql);
    }

    static public function column($sql) {
        return self::$db->query($sql)->fetchColumn();
    }

    static public function columnInt($sql) {
        return intval(self::$db->query($sql)->fetchColumn());
    }

    static public function prepare($sql) {
        return self::$db->prepare($sql);
    }

    static public function lastInsertId() {
        return self::$db->lastInsertId();
    }

    static public function execute($sql, $ar) {
        return self::$db->prepare($sql)->execute($ar);
    }

    static public function error() {
        $ar = self::$db->errorInfo();
        return $ar[2] . ' (' . $ar[1] . '/' . $ar[0] . ')';
    }

    static public function fetchAssoc($sql) {
        return self::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

     static public function fetchNum($sql) {
        return self::$db->query($sql)->fetch(PDO::FETCH_NUM);
    }

}
