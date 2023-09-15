<?php
class UidClass
{
    public $uid;

    public function __construct()
    {
        if (isset($_GET['uid'])) {
            $this->uid = $_GET['uid'];
        } else{
            $this->uid = null;
        }
    }

    public function redirect(){
        if ($this->isset_uid()){
            if ($this->uid_check()){
                if($this->is_voted()) {
                    header("Location:https://shibafufes68th.main.jp/vote/edit.php");
                    exit();
                }else{
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

    private function is_voted() {
        if (/*投票済み*/) {
            return true;
        } else {
            return false;
        }
    }
}

class DBControl
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