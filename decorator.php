<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 10/9/16
 * Time: 3:25 PM
 */
interface Component{
    public function operation();
}

abstract class Decorator implements Component{
    protected $_component;
    public function __construct(Component $component)
    {
        $this->_component = $component;
    }

    public function operation()
    {
        // TODO: Implement operation() method.
        $this->_component->operation();
    }
}

//具体装饰类A
class ConcreteDecoratorA extends Decorator{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }

    public function operation()
    {
        parent::operation(); // TODO: Change the autogenerated stub
        $this->addedOperationA(); //新增加的操作
    }

    public function addedOperationA(){ echo 'A加点酱油;';}
}

//具体装饰类B
class ConcreteDecoratorB extends Decorator{
    public function __construct(Component $component)
    {
        parent::__construct($component);
    }

    public function operation()
    {
        parent::operation(); // TODO: Change the autogenerated stub
        $this->addedOperationB();
    }

    public function addedOperationB(){ echo 'B加点辣椒；';}
}

//具体组件类
class ConcreteComponent implements Component{
    public function operation()
    {
        // TODO: Implement operation() method.
    }
}

//clients
$component = new ConcreteComponent();
$decoratorA = new ConcreteDecoratorA($component);
$decoratorB = new ConcreteDecoratorB($decoratorA);

$decoratorA->operation();
echo "\n".'------------------------'."\n";
$decoratorB->operation();