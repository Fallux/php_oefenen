<!-- wrapping PDO database -->
<?php
// start connecting Database code
class DB {
    private static $_instance = null;
    private $_pdo, 
    $_query, 
    $_error = false,
    $_results, 
    $_count = 0;

    private function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            echo "connected!";
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
            
        }
            return self::$_instance;
            
    }
    // end connecting Database code
    // start calling the db SQL
    public function query($sql, $params = array()) {
        $this->_error=false; //we willen geen errors zien van eedere queries
        if ($this->_query = $this->_pdo->prepare($sql)) {
                echo "\npreparing sql.";
                $value = 1;
                if (count($params)) {
                    foreach($params as $param) {// er is iets met deze loop maar ik weet niet wat
                        $this->_query->bindValue($value, $param);
                    }
                }
                if ($this->_query->execute()) {
                    echo"\n the query is executed!!";
                    $this->_results = $this->_query->fetchAll(pdo::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }else {
                    $this->_error = true;
                    echo "\ner ging iets mis met de query ophalen. Check de db Instance query in index.php";
                    //ik weet niet welke nou de juiste plek is om de echo te gebruiken dus ik zet voor nu hier
                }
        }
        return $this;
        // van de video 8/23 9:23

    }

    public function action($action, $table, $where= array()) {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                    echo "jknfnofnozgbodnljfldf";
                }
            }
        }
        return false;
     
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array()) {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;
            foreach ($fields as $field) {
                $values .= '?';
                if ($x < count($fields)) {
                    $values .= ", ";
                }
                $x++;
            }

            die($values);

            $sql = "INSERT INTO users (`" . implode('`, `', $keys)  . "`) VALUES ({$values})";

            echo $sql;
        }
        return false;
    }

    public function results(){
        return $this->_results;
    }
    public function error() {
        return $this->_error;
    }
    // van de video 8/23 9:23
    
    public function count() {
        return $this->_count;
    }
}
