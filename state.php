<?php
/**
 * 状态模式
 * 状态模式属于对象创建型模式，其意图是允许一个对象在其内部状态改变时改变它的行为
 * 一个人具有生气，高兴和抓狂等状态，在这些状态下做同一个事情可能会有不同的结果，一个人的心情可能在这三种状态中循环转变。
 * State模式和command模式都是十分常用，粒度比较小的模式，是很多更大型模式的一部分
 */

//抽象状态角色
interface State{
    public function handle(Context $context);
}

//具体状态角色A
class ConcreteStateA implements State{
    private static $_instance = null;
    private function __construct(){}

    //静态工厂方法，返还此类的唯一实例
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new ConcreteStateA();
        }
        return self::$_instance;
    }

    public function handle(Context $context)
    {
        // TODO: Implement handle() method.
        echo 'concrete_a'."\n";
        $context->setState(ConcreteStateB::getInstance());
    }
}

//具体状态角色B
class ConcreteStateB implements State{
    private static $_instance = null;
    private function __construct(){}
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new ConcreteStateB();
        }
        return self::$_instance;
    }

    public function handle(Context $context)
    {
        // TODO: Implement handle() method.
        echo 'concrete_b'."\n";
        $context->setState(ConcreteStateA::getInstance());
    }
}

//环境角色
class Context{
    private $_state;
    public function __construct()
    {
        $this->_state = ConcreteStateA::getInstance();//默认为A
    }
    public function setState(State $state){
        $this->_state = $state;
    }

    public function request(){
        $this->_state->handle($this);
    }
}

//client
$context = new Context();
$context->request();
$context->request();
$context->request();
$context->request();