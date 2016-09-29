<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 5:33 PM
 * 策略模式
 * 策略模式与工厂模式相似，但是工厂模式传入参数是返回类的实例，而策略模式则是返回这个实例，并主要执行这个实例的结果。
 * 工厂相当于黑盒子，策略相当于白盒子
 * 说你要去买件衣服，给你50块钱，策略模式的做法就是去京东、当当、淘宝、卓越等网上去看，然后决定要买那一件。
 * 而工厂模式的做法确实，告诉系统我需要用50块钱买件衣服，到底他去当当、淘宝、京东、卓越你不关心，你只需要50块钱的一件衣服。
 */

//抽象策略角色,以接口实现
interface Strategy{
    public function do_method();//算法接口
}

//具体策略角色A
class ConcreteStrategyA implements Strategy{
    public function do_method()
    {
        // TODO: Implement do_method() method.
        echo 'do method One'."\n";
    }
}

//具体策略角色B
class ConcreteStrategyB implements Strategy{
    public function do_method()
    {
        // TODO: Implement do_method() method.
        echo "do method Two\n";
    }
}

//具体策略角色B
class ConcreteStrategyC implements Strategy{
    public function do_method()
    {
        // TODO: Implement do_method() method.
        echo "do method Three\n";
    }
}

//环境角色
class Question{
    private $_strategy;

    public function __construct(Strategy $strategy)
    {
        $this->_strategy = $strategy;
    }

    public function handle_question(){
        $this->_strategy->do_method();
    }
}


//client
$question = new Question(new ConcreteStrategyA());
$question->handle_question();

$question = new Question(new ConcreteStrategyB());
$question->handle_question();

$question = new Question(new ConcreteStrategyC());
$question->handle_question();