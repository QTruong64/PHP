<?php
class Db
{
    protected static $connection;

    public function connect()
    {
        if (!isset (self::$connection)) {
            self::$connection = new mysqli("localhost", "root", "", "demo_lab3");
            if (self::$connection->connect_error) {
                echo "Database connect failed: " . self::$connection->connect_error;
                return false;
            }
        }
        return self::$connection;
    }

    public function query_execute($queryString)
    {
        $connection = $this->connect();
        if (!$connection) {
        }

        $result = $connection->query($queryString);
        if ($result === false) {
            echo "Error executing query: " . $connection->error;
        }
        return $result;
    }

    public function select_to_array($queryString)
    {
        $rows = [];
        $result = $this->query_execute($queryString);
        if ($result !== false) {
            while ($item = $result->fetch_assoc()) {
                $rows[] = $item;
            }
        }
        return $rows;
    }
}
?>