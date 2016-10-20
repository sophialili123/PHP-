<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/20
 * Time: 18:15
 */
abstract class Subject{//抽象主题角色
    abstract public function actoin();
}

class RealSubject extends Subject{//真实主题角色
    public function __construct(){}
    public function actoin()
    {
        // TODO: Implement actoin() method.
    }
}

class ProxySubject extends Subject{//代理主题角色
    private $_real_subject = null;
    public function __construct()
    {
    }

    public function actoin()
    {
        // TODO: Implement actoin() method.
        $this->_beforeAction();
        if(is_null($this->_real_subject)){
            $this->_real_subject = new RealSubject();
        }
        $this->_real_subject->actoin();
        $this->_afterAction();
    }

    private function _beforeAction(){
        print_r('在action前，你想干点啥~');
    }

    private function _afterAction(){
        echo '在action后，你还想干点啥~';
    }
}

//client
$subject = new ProxySubject();
$subject->actoin();