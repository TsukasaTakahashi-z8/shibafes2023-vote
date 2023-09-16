<?php

class UidClass extends DBControlClass
{
    public $uid = null;

    public function __construct($uid)
    {
        if (isset($uid)) {
            $this->uid = htmlspecialchars($uid);
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

class DBControlClass
{
    public $nnn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $dsn = "mysql:dbname=hoge;host=localhost;charset=utf8";
        $user = "";
        $password = "";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        );
    }

    public function getRow()
    {
    }
}
