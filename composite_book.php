<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/18
 * Time: 14:39
 * 组合模式 Book示例
 * 1、必须存在不可分割基本元素。
 * 2、组合后的物体可以被组合。
 * 举个通俗的例子，原子是化学反应的基本微粒，它在化学反应中不可分割。现在有 C（碳）、H（氢）、O（氧）、N（氮）4种原子，它们可以随机组合成无数种分子，可以是蛋白质，也可以是脂肪，蛋白质和脂肪就是组合。由蛋白质和脂肪又可以一起被组合成肉、大豆等等。
 */

abstract class OnTheBookShelf
{
    abstract function getBookInfo($previousBook);
    abstract function getBookCount();
    abstract function setBookCount($new_count);
    abstract function addBook($oneBook);
    abstract function removeBook($oneBook);
}

class OneBook extends OnTheBookShelf
{
    private $title;
    private $author;

    public function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    public function getBookInfo($bookToGet)
    {
        if (1 == $bookToGet) {
            return $this->title.' by '.$this->author;
        }

        return false;
    }

    public function getBookCount()
    {
        return 1;
    }

    public function setBookCount($newCount)
    {
        return false;
    }

    public function addBook($oneBook)
    {
        return false;
    }

    public function removeBook($oneBook)
    {
        return false;
    }
}

class SeveralBooks extends OnTheBookShelf
{
    private $oneBooks = [];
    private $bookCount;

    public function __construct()
    {
        $this->setBookCount(0);
    }

    public function getBookCount()
    {
        return $this->bookCount;
    }

    public function setBookCount($newCount)
    {
        $this->bookCount = $newCount;
    }

    public function getBookInfo($bookToGet)
    {
        if ($bookToGet <= $this->bookCount) {
            return $this->oneBooks[$bookToGet]->getBookInfo(1);
        }

        return false;
    }

    public function addBook($oneBook)
    {
        $this->setBookCount($this->getBookCount() + 1);
        $this->oneBooks[$this->getBookCount()] = $oneBook;

        return $this->getBookCount();
    }

    public function removeBook($oneBook)
    {
        $counter = 0;
        while (++$counter <= $this->getBookCount()) {
            if ($oneBook->getBookInfo(1) ==
                $this->oneBooks[$counter]->getBookInfo(1)) {
                for ($x = $counter; $x < $this->getBookCount(); $x++) {
                    $this->oneBooks[$x] = $this->oneBooks[$x + 1];
                }
                $this->setBookCount($this->getBookCount() - 1);
            }
        }

        return $this->getBookCount();
    }
}

// First book
$firstBook = new OneBook('Core PHP Programming, Third Edition', 'Atkinson and Suraski');
echo $firstBook->getBookInfo(1); // Core PHP Programming, Third Edition by Atkinson and Suraski

// Second book
$secondBook = new OneBook('PHP Bible', 'Converse and Park');
echo $secondBook->getBookInfo(1); // PHP Bible by Converse and Park

// Third book
$thirdBook = new OneBook('Design Patterns', 'Gamma, Helm, Johnson, and Vlissides');
echo $thirdBook->getBookInfo(1); // Design Patterns by Gamma, Helm, Johnson, and Vlissides

$books = new SeveralBooks();

$booksCount = $books->addBook($firstBook);
// After adding firstBook to books - SeveralBooks info
echo $books->getBookInfo($booksCount); // Core PHP Programming, Third Edition

$booksCount = $books->addBook($secondBook);
// After adding secondBook to books - SeveralBooks info
echo $books->getBookInfo($booksCount); // PHP Bible by Converse and Park

$booksCount = $books->addBook($thirdBook);
// After adding thirdBook to books - SeveralBooks info
echo $books->getBookInfo($booksCount); // Design Patterns by Gamma, Helm, Johnson, and Vlissides

$booksCount = $books->removeBook($firstBook);
// After removing firstBook from books - SeveralBooks count
echo $books->getBookCount(); // 2

// After removing firstBook from books) SeveralBooks info 1
echo $books->getBookInfo(1); // PHP Bible by Converse and Park

// After removing firstBook from books - SeveralBooks info 2
echo $books->getBookInfo(2); // Design Patterns by Gamma, Helm, Johnson, and Vlissides