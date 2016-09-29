<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 2:49 PM
 * 适配器
 * 之前买过个ipad玩，当用其充电器充电时遇到了点麻烦（有的同学应该知道），家里没有适合它的插座。还好，卖家送了个接头转换部件，问题轻松解决
 */

//对象适配器
interface Target{
    public function sampleMethodOne();
    public function sampleMethodTwo();
}

class Adaptee{
    public function sampleMethodOne(){
        echo '对象适配器^_^';
    }
}

class Adapter implements Target{
    private $_adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->_adaptee = $adaptee;
    }

    public function sampleMethodOne()
    {
        // TODO: Implement sampleMethodOne() method.
        $this->_adaptee->sampleMethodOne();
    }

    public function sampleMethodTwo()
    {
        // TODO: Implement sampleMethodTwo() method.
        echo '!!!!!'."\n";
    }
}

$adapter = new Adapter(new Adaptee());
$adapter->sampleMethodOne();
$adapter->sampleMethodTwo();

// ---------------------------------------------------------------------------------------------

//类适配器
interface Target2{
    public function sampleMethodOne();
    public function sampleMethodTwo();
}

class Adaptee2{
    public function sampleMethodOne(){
        echo '类适配器^_^';
    }
}

class Adapter2 extends Adaptee2 implements Target2{
    public function sampleMethodTwo()
    {
        // TODO: Implement sampleMethodTwo() method.
        echo '<---逗逼,笑什么!'."\n";;
    }
}

$adapter = new Adapter2();
$adapter->sampleMethodOne();
$adapter->sampleMethodTwo();