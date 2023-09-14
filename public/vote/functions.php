<?php
class UidClass
{
    public $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
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
