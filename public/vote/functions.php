<?php


class DBControlClass
{
    /*
        CREATE TABLE IF NOT EXISTS CHARACTER SET utf8 vote (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            best-exhibition INT,
            best-poster INT,
            email TEXT,
            impression MEDIUMTEXT
        );
     */
    private $dsn;
    private $db_user;
    private $db_password;

    private $dbh;

    public function __construct()
    {
        require '../vendor/autoload.php';
        \Dotenv\Dotenv::createImmutable(__DIR__)->load();

        $this->dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'] . ";charset=utf8";
        $this->db_user = $_ENV['DB_USER'];
        $this->db_password = $_ENV['DB_PASSWORD'];

        $this->connect();
    }

    public function __destruct()
    {
        $this->dsn = null;
    }

    public function connect()
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

    public function getRow()
    {
    }
}

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
        $_SESSION['uid'] = $this->uid;

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

    private function uid_check(): bool
    {
        if (empty($this->uid)) {
            return false;
        }

    }

    private function get_voted_times()
    {
        $n = 0;//DBからget
        return $n;
    }
}

