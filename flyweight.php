<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/19
 * Time: 13:07
 * 星际的战斗达到后面，地图里面的部队很多，如果我们把每个兵的图像动画和属性值作为一个对象的话，系统的内存里会消耗极大。
 * 我们在玩的时候会发现，因为星际里面的种族只有三个，其实兵种只有几十个。
 * 虽然每个独立的士兵剩余的血不同，但是同一兵种的图像动画是一样的，即使不同的玩家，只是不同的颜色。比如每个人族的机枪兵。
 * 而且大多数玩家只用到常用的一些兵种，很多时候不会制造所有的兵种。
 * 待解决的问题：把把兵种的图像动画共享。
 * 思路：我们把每个兵种的图像动画建模作为对象，放入内存共享。一旦有某个画面用到这个兵种，只要把共享的图像动画拿出来，更改颜色就可以了。
 * 用途总结：享元模式可以将需要共享的资源集中起来，统一管理，防止重复消耗。
 * 实现总结：需要一个享元工厂管理共享的资源，比如上面的FlyweightFactory。把所有共享的资源的生产全部交给个享元工厂。
 *
 * 创建一个工厂,可以缓存和重用现有的类实例。
 * 客户端必须使用工厂而不是新的操作符请求对象。
 */

abstract class Resources{
    public $resource = null;
    abstract public function operate();
}

class unShareFlyWeight extends Resources{
    public function __construct($resource_str)
    {
        $this->resource = $resource_str;
    }

    public function operate()
    {
        // TODO: Implement operate() method.
        echo $this->resource."\n";
    }
}

//享元工厂
class shareFlyWeight extends Resources{
    private $resources = [];
    public function get_resource($resource_str){
        if(isset($this->resources[$resource_str])){
            return $this->resources[$resource_str];
        }else{
            return $this->resources[$resource_str] = $resource_str;
        }
    }

    public function operate()
    {
        // TODO: Implement operate() method.
        foreach($this->resources as $key => $resources){
            echo $key.":".$resources."\n";
        }
    }
}

//client
$flyweight = new shareFlyWeight();
$flyweight->get_resource('a');
$flyweight->operate();

$flyweight->get_resource('b');
$flyweight->operate();

$flyweight->get_resource('c');
$flyweight->operate();

//不共享的对象，单独调用
//$uflyweight = new unShareFlyWeight("A");
//$uflyweight->operate();
//
//$uflyweight = new unShareFlyWeight('B');
//$uflyweight->operate();