<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 4:33 PM
 * 桥接模式
 * 将抽象部分与它的实现部分分离，使它们都可以独立地变化。它是一种对象结构型模式，又称为柄体(Handle and Body)模式或接口(Interface)模式。
 */

//抽象化角色,抽象化给出的定义,并保存一个对实例化对象的引用
abstract class Abstraction{
    protected $imp;//对实例化对象的引用
    public function operation(){
        $this->imp->operation();
    }
}

class RefinedAbstraction extends Abstraction{
    public function __construct(Implementor $imp)
    {
        $this->imp = $imp;
    }

    public function operation()
    {
        $this->imp->operationImp();
    }
}

//实现化角色,给出实现化角色的接口,但不给出具体的实现
abstract class Implementor{
    abstract public function operationImp();
}

//具体化角色A
class ConcreateImplementorA extends Implementor {
    public function operationImp()
    {
        // TODO: Implement operationImp() method.
        echo "I am Apple\n";
    }
}

//具体化角色B
class ConcreateImplementorB extends Implementor {
    public function operationImp()
    {
        // TODO: Implement operationImp() method.
        echo "I am Baby\n";
    }
}

$abstraction = new RefinedAbstraction(new ConcreateImplementorA());
$abstraction->operation();

$abstraction = new RefinedAbstraction(new ConcreateImplementorB());
$abstraction->operation();

