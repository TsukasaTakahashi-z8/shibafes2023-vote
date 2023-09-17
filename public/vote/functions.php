<?php

class DBControlClass
{
    /*
        CREATE DATABASE {dbname} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     */
    private $dsn;
    private $db_user;
    private $db_password;

    private $dbh;
    private const CREATE_SQL = "
        CREATE TABLE IF NOT EXISTS vote (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            voted_times INT DEFAULT 0,
            best_exhibition INT,
            best_poster INT,
            email TEXT,
            impression MEDIUMTEXT
        );";


    public function __construct()
    {
        require '../vendor/autoload.php';
        \Dotenv\Dotenv::createImmutable(__DIR__)->load();
        \Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();

        $this->dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'] . ";charset=utf8mb4";
        $this->db_user = $_ENV['DB_USER'];
        $this->db_password = $_ENV['DB_PASSWORD'];

        $this->connect();
    }

    public function __destruct()
    {
        $this->dsn = null;
    }

    private function connect()
    {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        );

        try {
            $this->dbh = new PDO($this->dsn, $this->db_user, $this->db_password, $options);
        } catch (PDOException $e) {
            echo "DB接続エラー:". $e->getMessage();
            exit();
            return $e->getMessage();
        }
        return 0;
    }

    public function init_table(int $num = 15000)
    {
        // create a table
        try {
            $this->dbh->query(self::CREATE_SQL);
        } catch (PDOException $e) {
            return $e->getMessage();
            die();
        }

        // clean the table
        try {
            $this->dbh->query("TRUNCATE TABLE vote;");
        } catch (PDOException $e) {
            return $e->getMessage();
            die();
        }

        $sql = "INSERT INTO vote(voted_times, best_exhibition, best_poster, email, impression) VALUES";
        for ($i = 1; $i < $num; $i++) {
            $sql .= "\n(0,0,0,\"\",\"\"),";
        }
        $sql .= "\n(0,0,0,\"\",\"\");";

        try {
            $this->dbh->query($sql);
        } catch (PDOException $e) {
            return $e->getMessage();
            die();
        }
    }

    public function count_row()
    {
        try {
            $res = $this->dbh->query("SELECT * FROM vote;");
            return $res->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
            die();
        }
    }

    public function select(int $id)
    {
        $stmt = $this->dbh->query("SELECT * FROM vote WHERE id = ?");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update(int $id, int $voted_times, int $best_exhibition = -1, int $best_poster = -1, string $email = "", string $impression = "")
    {
    }
}

use Hashids\Hashids;

class UidClass extends DBControlClass
{
    public $uid = null;

    public function __construct($uid)
    {
        if (isset($uid)) {
            $this->uid = $uid;
        }

        if (session_status() == PHP_SESSION_DISABLED) {
            session_start();
        }
    }

    public function redirect()
    {
        // uidなし
        if (empty($this->uid)) {
            if ($_SERVER['REQUEST_URI'] != "/vote/index.php") {
                header("Location:/vote/index.php");
                exit();
            }
            return 0;
        }

        // 不正なuid
        if (!$this->uid_check()) {
            header("Location:/vote/error.php?code=invalid_uid&uid={$this->uid}");
            exit();
            return 0;
        }

        //sessionにset
        $voted_times = $this->get_voted_times();
        $_SESSION['voted-times'] = $voted_times;
        $_SESSION['id'] = $this->get_id();

        // 複数回目
        if ($voted_times != 0) {
            header("Location:/vote/edit.php");
            exit();
            return 0;
        }

        header("Location:/vote/vote.php");
        exit();
        return 0;
    }

    public function get_id(): int
    {
        $hashids = new Hashids($_ENV['SALT'], 8, "23456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ");
        $id = $hashids->decode($this->uid);

        return intval($id[0]);
    }

    private function uid_check(): bool
    {
        if (empty($this->uid)) {
            return false;
        }

        if (0 < $this->get_id() && $this->get_id() <= $this->count_row()) {
            return true;
        }
        return false;
    }

    private function get_voted_times()
    {
        $result = $this->select($this->get_id());
        return $result["voted_times"];
    }
}
