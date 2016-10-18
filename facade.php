<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/18
 * Time: 17:55
 * 外观模式又称为门面模式
 * 门面模式（Facade）又称外观模式，用于为子系统中的一组接口提供一个一致的界面。
 * 门面模式定义了一个高层接口，这个接口使得子系统更加容易使用：引入门面角色之后，用户只需要直接与门面角色交互，用户与子系统之间的复杂关系由门面角色来实现，从而降低了系统的耦合度。
 *
 * 大小写转换
 */

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

class CaseReverseFacade {
    public static function reverseStringCase($stringIn) {
        $arrayFromString = ArrayStringFunctions::stringToArray($stringIn);
        $reversedCaseArray = ArrayCaseReverse::reverseCase($arrayFromString);
        $reversedCaseString = ArrayStringFunctions::arrayToString($reversedCaseArray);
        return $reversedCaseString;
    }
}

class ArrayCaseReverse {
    private static $uppercase_array =
        array('A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'Q', 'R',
            'S', 'T', 'U', 'V', 'W', 'X',
            'Y', 'Z');
    private static $lowercase_array =
        array('a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'q', 'r',
            's', 't', 'u', 'v', 'w', 'x',
            'y', 'z');
    public static function reverseCase($arrayIn) {
        $array_out = array();
        for ($x = 0; $x < count($arrayIn); $x++) {
            if (in_array($arrayIn[$x], self::$uppercase_array)) {
                $key = array_search($arrayIn[$x], self::$uppercase_array);
                $array_out[$x] = self::$lowercase_array[$key];
            } elseif (in_array($arrayIn[$x], self::$lowercase_array)) {
                $key = array_search($arrayIn[$x], self::$lowercase_array);
                $array_out[$x] = self::$uppercase_array[$key];
            } else {
                $array_out[$x] = $arrayIn[$x];
            }
        }
        return $array_out;
    }
}

class ArrayStringFunctions {
    public static function arrayToString($arrayIn) {
        $string_out = NULL;
        foreach ($arrayIn as $oneChar) {
            $string_out .= $oneChar;
        }
        return $string_out;
    }
    public static function stringToArray($stringIn) {
        return str_split($stringIn);
    }
}


    writeln('BEGIN TESTING FACADE PATTERN');
    writeln('');

    $book = new Book('Design Patterns', 'Gamma, Helm, Johnson, and Vlissides');

    writeln('Original book title: '.$book->getTitle());
    writeln('');

    $bookTitleReversed = CaseReverseFacade::reverseStringCase($book->getTitle());

    writeln('Reversed book title: '.$bookTitleReversed);
    writeln('');

    writeln('END TESTING FACADE PATTERN');

    function writeln($line_in) {
      echo $line_in."\n";
    }
