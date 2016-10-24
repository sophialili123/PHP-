<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 18:52
 * 如果有多个对象都有可能接受请求，如何避免避免请求发送者与接收者耦合在一起呢？
 * 职责链模式(Chain of Responsibility)：使多个对象都有机会处理请求，从而避免请求的发送者和接收者之间的耦合关系。
 * 将这些对象连成一条链，并沿着这条链传递该请求，直到有一个对象处理它为止。
 * 1）在职责链模式里，很多对象由每一个对象对其下家的引用而连接起来形成一条链。
 * 2）请求在这条链上传递，直到链上的某一个对象处理此请求为止。
 * 3）发出这个请求的客户端并不知道链上的哪一个对象最终处理这个请求，这使得系统可以在不影响客户端的情况下动态地重新组织链和分配责任。
 *
 * 纯的职责链模式：一个具体处理者角色处理只能对请求作出两种行为中的一个：一个是自己处理（承担责任），另一个是把责任推给下家。
 * 不允许出现某一个具体处理者对象在承担了一部分责任后又将责任向下传的情况。请求在责任链中必须被处理，不能出现无果而终的结局。
 * 反之就是不纯的职责链模式。
 * 在一个纯的职责链模式里面，一个请求必须被某一个处理者对象所接收；在一个不纯的职责链模式里面，一个请求可以最终不被任何接收端对象所接收。
 */

abstract class Responsibility{//抽象责任角色
    protected $next;//下一个责任角色

    public function setNext(Responsibility $a){
        $this->next = $a;
        return $this;
    }

    abstract public function operate();//操作方法
}

class ResponsibilityA extends Responsibility{
    public function __construct(){}
    public function operate()
    {
        // TODO: Implement operate() method.
        if(false == is_null($this->next)){
            $this->next->operate();
            echo "Res_A start \n";
        }
    }
}

class ResponsibilityB extends Responsibility{
    public function __construct(){}
    public function operate()
    {
        // TODO: Implement operate() method.
        if(false == is_null($this->next)){
            $this->next->operate();
            echo "Res_B start \n";
        }
    }
}

//client
$res_a = new ResponsibilityA();
$res_b = new ResponsibilityB();
$res_a->setNext($res_b);
$res_a->operate();
