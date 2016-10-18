<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/18
 * Time: 11:55
 * 组合模式
 * 必须注意的是，由于组合模式的灵活性，很多人喜欢不假思索的使用组合类。事实上，组合类存在着“过于灵活”、“开销大”的缺陷。
 * 我们试想一下，一个元素或组合在整个系统中可能被调用非常多次，但一旦某个元素或组合在系统中的一个节点出现问题，我们将很难排查到那个节点。
 * 再试想一下，若是系统中的某个元素是一条查询数据库的sql语句，而且这条sql语句的开销有些大，一旦它被组合到整个系统的每一个角落，运行系统造成的结果将是灾难性的。
 */
abstract class tree{
    abstract function create();
}

//拆分出的树干抽象类，由于继承自tree，必须将create()实现，但实现create()又会造成代码重复，所以将此类也申明为抽象类
abstract class branch extends tree{
    abstract function combination(tree $item);
    abstract function separation(tree $item);
}

class createLeaf extends tree{

    private $name;
    private $size;
    private $color;
    private $leaf=array();

    public function __construct($name,$size,$color){
        $this->name=$name;
        $this->size=$size;
        $this->color=$color;
    }

    public function create(){
        $this->leaf[$this->name]=array(
            'size'=>$this->size,
            'color'=>$this->color
        );
        return $this->leaf;
    }

    public function combination(tree $item){
        throw new Exception("本类不支持组合操作");
    }

    public function separation(tree $item){
        throw new Exception("本类不支持分离操作");
    }

}

class createBranch extends branch{

    private $name;
    private $branch=array();
    private $items=array();

    public function __construct($name){
        $this->name=$name;
    }

    public function create(){
        foreach($this->items as $item){
            $arr=$item->create();
            $this->branch[$this->name][]=$arr;
        }
        if(empty($this->branch)){
            $this->branch[$this->name]=array();
        }
        return $this->branch;
    }

    public function combination(tree $item){
        $this->items[]=$item;
    }

    public function separation(tree $item){
        $key=array_search($item,$this->items);
        if($key!==false){
            unset($this->items[$key]);
        }
    }

}

$leaf_1=new createLeaf('大红树叶','大','红');
$leaf_2=new createLeaf('大绿树叶','大','绿');
$leaf_3=new createLeaf('大黄树叶','大','黄');

$leaf_4=new createLeaf('小红树叶','小','红');
$leaf_5=new createLeaf('小绿树叶','小','绿');
$leaf_6=new createLeaf('小黄树叶','小','黄');

$branch_1=new createBranch('树枝1号');
$branch_1->combination($leaf_1);
$branch_1->combination($leaf_2);
$branch_1->combination($leaf_3);

$branch_2=new createBranch('树枝2号');
$branch_2->combination($leaf_4);
$branch_2->combination($leaf_5);
$branch_2->combination($leaf_6);

$branch=new createBranch('树干');
$branch->combination($branch_1);
$branch->combination($branch_2);

print_r($branch->create());