<?php

/**
 * 代理模式（Proxy）为其他对象提供一种代理以控制对这个对象的访问。使用代理模式创建代理对象，
 * 让代理对象控制目标对象的访问（目标对象可以是远程的对象、创建开销大的对象或需要安全控制的对象），
 * 并且可以在不改变目标对象的情况下添加一些额外的功能。
 *
 * 在某些情况下，一个客户不想或者不能直接引用另一个对象，而代理对象可以在客户端和目标对象之间起到中介的作用，
 * 并且可以通过代理对象去掉客户不能看到的内容和服务或者添加客户需要的额外服务。
 */
class ProxyBookList
{
    private $bookList = null;//重点在这里,只有在调用方法的时候进行实例化

    public function getBookCount()
    {
        if (null == $this->bookList) {//重点在这里,只有在调用方法的时候进行实例化
            $this->makeBookList();
        }

        return $this->bookList->getBookCount();
    }

    public function addBook($book)
    {
        if (null == $this->bookList) {//重点在这里,只有在调用方法的时候进行实例化
            $this->makeBookList();
        }

        return $this->bookList->addBook($book);
    }

    public function getBook($bookNum)
    {
        if (null == $this->bookList) {//重点在这里,只有在调用方法的时候进行实例化
            $this->makeBookList();
        }

        return $this->bookList->getBook($bookNum);
    }

    public function removeBook($book)
    {
        if (NULL == $this->bookList) {
            $this->makeBookList();
        }

        return $this->bookList->removeBook($book);
    }

    public function makeBookList()
    {
        $this->bookList = new bookList();
    }
}

class BookList
{
    private $books = [];
    private $bookCount = 0;

    public function getBookCount()
    {
        return $this->bookCount;
    }

    private function setBookCount($newCount)
    {
        $this->bookCount = $newCount;
    }

    public function getBook($bookNumberToGet)
    {
        if ( (is_numeric($bookNumberToGet)) && ($bookNumberToGet <= $this->getBookCount())) {
            return $this->books[$bookNumberToGet];
        } else {
            return NULL;
        }
    }

    public function addBook(Book $book)
    {
        $this->setBookCount($this->getBookCount() + 1);
        $this->books[$this->getBookCount()] = $book;

        return $this->getBookCount();
    }

    public function removeBook(Book $book)
    {
        $counter = 0;
        while (++$counter <= $this->getBookCount()) {
            if ($book->getAuthorAndTitle() == $this->books[$counter]->getAuthorAndTitle()) {
                for ($x = $counter; $x < $this->getBookCount(); $x++) {
                    $this->books[$x] = $this->books[$x + 1];
                }
                $this->setBookCount($this->getBookCount() - 1);
            }
        }

        return $this->getBookCount();
    }
}

class Book
{
    private $author;
    private $title;

    public function __construct($title, $author)
    {
        $this->author = $author;
        $this->title  = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorAndTitle()
    {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

$proxyBookList = new ProxyBookList();
$book = new Book('PHP for Cats','Aaryadev');
$proxyBookList->addBook($book);

// Show the book count after a book is added
echo $proxyBookList->getBookCount();

// Show the book
$book = $proxyBookList->getBook(1);
echo $book->getAuthorAndTitle();

$proxyBookList->removeBook($book);

// Show the book count after a book is removed
echo $proxyBookList->getBookCount();