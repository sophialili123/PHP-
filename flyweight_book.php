<?php

class FlyweightBook
{
    private $author;
    private $title;

    public function __construct($author, $title)
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
}

//共享
class FlyweightFactory
{
    private $books = [];

    public function __construct()
    {
        $this->books = array_fill(0, 3, null);
    }

    public function getBook($bookKey)
    {
        if (null == $this->books[$bookKey]) {
            $makeFunction = 'makeBook'.$bookKey;
            $this->books[$bookKey] = $this->$makeFunction();
        }

        return $this->books[$bookKey];
    }

    /**
     * Sort of a long way to do this, but hopefully easy to follow. How you
     * really want to make flyweights would depend on what your application
     * needs. This, while a little clumsy looking, does work well.
     */
    public function makeBook1()
    {
        return new FlyweightBook('Aaryade', 'PHP For Cats');
    }

    public function makeBook2()
    {
        return new FlyweightBook('Aaryadev', 'PHP For Dogs');
    }

    public function makeBook3()
    {
        return new FlyweightBook('Aaryadev', 'PHP For Parakeets');
    }
}

//不共享
class FlyweightBookShelf
{
    private $books = [];

    public function addBook($book)
    {
        $this->books[] = $book;
    }

    public function showBooks()
    {
        $output = '';
        foreach ($this->books as $book) {
            $output .= 'title: '.$book->getAuthor().' author: '.$book->getTitle();
        };

        return $output;
    }
}

$flyweightFactory = new FlyweightFactory();
$flyweightBookShelf1 = new FlyweightBookShelf();
$flyweightBook1 = $flyweightFactory->getBook(1);
$flyweightBookShelf1->addBook($flyweightBook1);
$flyweightBook2 = $flyweightFactory->getBook(1);
$flyweightBookShelf1->addBook($flyweightBook2);

// Show the two same books

if ($flyweightBook1 === $flyweightBook2) {
    echo '1 and 2 are the same'."\n";
} else {
    echo '1 and 2 are not the same'."\n";
}

// Output: 1 and 2 are the same

// With one book on one self twice
echo $flyweightBookShelf1->showBooks();
// Output:
// title: Aaryadev author: PHP For Cats
// title: Aaryadev author: PHP For Cats

$flyweightBookShelf2 = new FlyweightBookShelf();
$flyweightBook1 = $flyweightFactory->getBook(2);
$flyweightBookShelf2->addBook($flyweightBook1);
$flyweightBookShelf1->addBook($flyweightBook1);

// Book shelf one
echo $flyweightBookShelf1->showBooks();

// Output:
// title: Aaryadev author: PHP For Cats
// title: Aaryadev author: PHP For Cats
// title: Aaryadev author: PHP For Dogs

// Book shelf two
echo $flyweightBookShelf2->showBooks(); // title: Aaryadev author: PHP For Dogs