<?php
class TodoController {
    private $host = "localhost";
    private $port = 3306;
    private $user = "root";
    private $password = "1q2w3e4r!Q@W";
    private $database = "test";
    private $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("데이터베이스 연결에 실패했습니다: " . $this->connection->connect_error);
        }
    }

    public function insertTask($content) {
        $sql = "INSERT INTO tasks (content) VALUES ('$content')";
        $this->connection->query($sql);
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id = '$id'";
        $this->connection->query($sql);
    }

    public function updateTask($id, $updateContent){
        $sql = "UPDATE tasks SET content = '$updateContent' WHERE id = '$id'";
        $this->connection->query($sql);
    }

    public function getAllTasks() {
        $sql = "SELECT * FROM tasks";
        $result = $this->connection->query($sql);
        $tasks = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
        }
        return $tasks;
    }
}
?>
