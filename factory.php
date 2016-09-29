<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 2:21 PM
 * 工厂模式
 * 将对象的创建完全独立出来，让对象的创建和具体的使用客户无关。主要应用在多数据库选择，类库文件加载等
 */
class Button{/* ... */}
class WinButton extends Button{/* ... */}
class MacButton extends Button{/* ... */}

interface ButtonFactory{
    public function createButton($type);
}

class MyButtonFactory implements ButtonFactory{
    //实现工厂方法
    public function createButton($type)
    {
        // TODO: Implement createButton() method.
        switch ($type){
            case 'Mac':
                return new MacButton();
            case 'Win':
                return new WinButton();
        }
    }
}

$button_obj = new MyButtonFactory();
var_dump($button_obj->createButton('Mac'));
var_dump($button_obj->createButton('Win'));