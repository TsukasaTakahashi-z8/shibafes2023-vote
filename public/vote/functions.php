<?php
class UidClass
{
    public $uid;

    public function __construct()
    {
        if (isset($_GET['uid'])) {
            $this->uid = htmlspecialchars($_GET['uid']);
        } else{
            $this->uid = null;
        }
        session_start();
    }

    public function redirect(){
    /*
        if ($this->isset_uid()){
            if ($this->uid_check()){
                $voted_times = $this->get_voted_times();

                if($voted_times == 0) {
                    // 初回
                    header("Location:https://shibafufes68th.main.jp/vote/vote.php");
                    exit();
                }else{
                    // 複数回目
                    header("Location:https://shibafufes68th.main.jp/vote/edit.php");
                    exit();
                }
            } else {
                // 不正なuid
                // header("Location:https://shibafufes68th.main.jp/vote/edit.php");
            }
        } else{
            header("Location:https://shibafufes68th.main.jp/vote/index.php");
            exit();
        }
    */

        if (!$this->isset_uid()){
            header("Location:https://shibafufes68th.main.jp/vote/index.php");
            exit();
        }

        if (!$this->uid_check()){
            // 不正なuid
            header("Location:https://shibafufes68th.main.jp/vote/error.php?code=invalid_uid");
            exit();
        }

        $voted_times = $this->get_voted_times();
        $_SESSION['voted-times'] = $voted_times;

        if($voted_times == 0) {
            // 初回
            header("Location:https://shibafufes68th.main.jp/vote/vote.php");
            exit();
        }else{
            // 複数回目
            header("Location:https://shibafufes68th.main.jp/vote/edit.php");
            exit();
        }
    }

    private function isset_uid() {
        if ($this->uid) {
            return false;
        } else {
            return true;
        }
    }

    private function uid_check() {
        if ($this->isset_uid()) {
            // connecting DB & 存在チェック
        }
    }

    private function get_voted_times() {
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

    public function connect(){
        $dsn = "mysql:dbname=hoge;host=localhost;charset=utf8";
        $user = "";
        $password = "";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        );
    }

    public function getRow(){}
}
