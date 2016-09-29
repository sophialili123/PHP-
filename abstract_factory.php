<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 2:09 PM
 * 抽象工厂模式
 * 提供一个创建一系列相关或相互依赖对象的接口，而无需指定他们具体的类。
 * 比如支持多种观感标准的用户界面工具箱（Kit）。
 */
class Button{}
class Border{}
class MacButton extends Button{}
class WinButton extends Button{}
class MacBorder extends Border{}
class WinBorder extends Border{}

interface AbstractFactory{
    public function CreateButton();
    public function CreateBorder();
}

class MacFactory implements AbstractFactory{
    public function CreateButton()
    {
        // TODO: Implement CreateButton() method.
        return new MacButton();
    }

    public function CreateBorder()
    {
        // TODO: Implement CreateBorder() method.
        return new MacBorder();
    }
}

class WinFactory implements AbstractFactory{
    public function CreateBorder()
    {
        // TODO: Implement CreateBorder() method.
        return new WinBorder();
    }

    public function CreateButton()
    {
        // TODO: Implement CreateButton() method.
        return new WinButton();
    }
}