<?php

/**
 * Created by PhpStorm.
 * User: chenlili
 * Date: 9/29/16
 * Time: 1:14 PM
 */
class HeredocAndNowdoc
{
    //test Heredoc
    //可以解析变量
    public function testHeredoc()
    {
        $name = 'Lily发愤学习之路';
        $content = <<<MAIL
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Untitled Document</title>
</head>
<body>
Hello,$name!
</body>
</html>
MAIL;

        echo $content;
    }

    //不可以解析变量
    public function testNewdoc(){
        $name = 'Lily发愤学习之路';
        $content = <<<'MAIL'
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Untitled Document</title>
</head>
<body>
Hello,$name!
</body>
</html>
MAIL;
        echo $content;
    }
}

    $here = new HeredocAndNowdoc();
//    $here->testHeredoc();
    $here->testNewdoc();