<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 5:51 PM
 * 建造者模式
 * 建造者模式包含如下角色：
 * Product：产品角色
 * Builder：抽象建造者
 * ConcreteBuilder：具体建造者
 * Director：指挥者
 * 建造者模式的结构中还引入了一个指挥者类Director，该类的作用主要有两个：
 * 一、它隔离客户与生产过程；
 * 二、它负责控制产品的生成过程。指挥者针对抽象建造者编程，客户端只需要知道具体建造者的类型，无须关心产品对象的具体组装过程，即可通过指挥者类调用建造者的相关方法，返回一个完整的产品对象。
 */

class Product {
    private $_parts;
    public  function __construct()
    {
        $this->_parts = [];
    }

    public function add($part){
        return array_push($this->_parts,$part);
    }
}

//建造者抽象类
abstract class Builder {
    public abstract function buildPart1();
    public abstract function buildPart2();
    public abstract function buildPart3();
}

//具体建造者
class ConcreteBuilder extends Builder{
    private $_product;
    public function __construct()
    {
        $this->_product = new Product();
    }
    public function buildPart1()
    {
        // TODO: Implement buildPart1() method.
        $this->_product->add('Part1');
    }
    public function buildPart2()
    {
        // TODO: Implement buildPart2() method.
        $this->_product->add('Part2');
    }
    public function buildPart3()
    {
        // TODO: Implement buildPart2() method.
        $this->_product->add('Part3');
    }
    public function getResult(){ return$this->_product; }
}

//导演者
class Director{
    public function __construct(Builder $builder)
    {
        $builder->buildPart1();
        $builder->buildPart2();
    }
}

//client
$builder = new ConcreteBuilder();
$director = new Director($builder);
$product = $builder->getResult();
var_dump($product);