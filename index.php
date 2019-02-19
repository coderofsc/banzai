<?
include "defines.php";
include "database.php";
include "controllers/controller.php";

class Core extends Controller {

    /**
     * Возвращает информацию о контроллере (заголовок и тд.)
     */

    public function get_info()
    {
        return array();
    }

    /**
     * Получает данные от пользователя
     */

    public function get_request()
    {
        $this->request["route"] = isset($_GET["route"])?trim($_GET["route"]):"employees";
    }

    /**
     * Возвращает контент
     * @return string
     */

    public function display()
    {
        $content    = $this->controller_content;//parent::display();
        $title      = $this->controller_info["title"];

        ob_start();
        include "views/main/main.php";
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    /**
     * Возвращает имя конроллера
     * @return string
     */

    private function get_controller_class_name() {
        $part = explode("/", $this->request["route"]);
        $part[] = "controller";

        $name = implode("_", array_map(function($part) { return ucfirst($part); }, $part));

        return $name;
    }

    /**
     * Проверка наличия файла и класса запрашиваемого контроллера
     * В случае успеха возвращает обьект контроллера, в противном случае false
     * @return bool
     */
    private function get_controller()
    {

        $controller_file = "controllers/".$this->request["route"].".php";

        if (!file_exists($controller_file)) {
            return false;
        }

        $class_name = $this->get_controller_class_name();

        include $controller_file;

        if (!class_exists($class_name)) {
            return false;
        }

        return new $class_name;
    }

    public function process()
    {

        $this->get_request();
        if (!($controller = $this->get_controller())) {
            header("HTTP/1.0 404 Not Found");
            echo "<strong>Error - wrong controller!</strong>";
            die();
        }

        $controller->process();
        $this->controller_info = $controller->get_info();
        $this->controller_content = $controller->display();

        return $this->display();

    }
}


DB::init();

$core = new Core();
$core->process();
echo $core->display();


