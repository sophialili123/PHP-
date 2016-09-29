<?php
/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 4:46 PM
 * 桥接模式升级版
 * 分离抽象接口及其实现部分
 * 由于聚合关联关系建立在抽象层，要求开发者针对抽象进行设计与编程
 * 桥接属于聚合关系，两者关联 但不继承
 * 适配器属于组合关系，适配者需要继承源
 * 聚合关系：A对象可以包含B对象 但B对象不是A对象的一部分
 * 对于那些不希望使用继承或因为多层次继承导致系统类的个数急剧增加的系统，桥接模式尤为适用
 * 实现各种操作系统都能播放MPEG，AVI，WMV格式的视频
 */

//抽象类,定义操作系统
abstract class OperationSystem{
    public $musicPattern;
    function playMpeg(){
        $this->musicPattern->playMpeg();
    }
    function playWmv(){
        $this->musicPattern->playWmv();
    }
    function playAvi(){
        $this->musicPattern->playAvi();
    }
}

//扩展抽象类，定义Linux的播放模式
class linux extends OperationSystem{
    function __construct(MusicPattern $musicPattern){
        $this->musicPattern = $musicPattern;
    }
}
//扩展抽象类，定义Linux的播放模式
class Windows extends OperationSystem{
    function __construct(MusicPattern $musicPattern){
        $this->musicPattern = $musicPattern;
    }
}
//扩展抽象类，定义Unix的播放模式
class Unix extends OperationSystem{
    function __construct(MusicPattern $musicPattern){
        $this->musicPattern = $musicPattern;
    }
}

// ==========================================================================================================

//实现类接口
abstract class MusicParrenInterface{
    abstract function playMpeg();
    abstract function playWmv();
    abstract function playAvi();
}
//具体实现类
class MusicPattern extends MusicParrenInterface{
    function playMpeg(){
        echo "播放Mpeg格式的视频\n";
    }
    function playWmv(){
        echo "播放Wmv格式的视频\n";
    }
    function playAvi(){
        echo "播放Avi格式的视频\n";
    }

}

//测试
$operationSystem = new Windows(new MusicPattern());
$operationSystem->playMpeg();
$operationSystem->playAvi();

$operationSystem = new linux(new MusicPattern());
$operationSystem->playWmv();
