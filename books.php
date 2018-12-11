<?php
interface BookDatabase {
    public function exportBooks();
}

Class TtnSwiftBooks implements BookDatabase
{
    protected $books = [
        'Swift-Ant', 'Swift-Bird', 'Swift-Cat', 'Swift-Dog', 'Swift-Eagle',
        'Swift-Fish', 'Swift-Goat', 'Swift-Horse', 'Swift-Insect', 'Swift-Jaguar',
    ];

    public function exportBooks()
    {
        return $this->books;
    }
}

Class TtnKotlinBooks implements BookDatabase
{
    protected $books = [
        'Kotlin-Audi', 'Kotlin-BMW', 'Kotlin-Cadillac', 'Kotlin-Dodge', 'Kotlin-Elfin',
        'Kotlin-Ferrari', 'Kotlin-GTR', 'Kotlin-Honda', 'Kotlin-Infiniti', 'Kotlin-Jaguar',
    ];

    public function exportBooks()
    {
        return $this->books;
    }
}

Class TtnPHPBooks implements BookDatabase
{
    protected $books = [
        'PHP-America', 'PHP-Brazil', 'PHP-Chinese', 'PHP-Denmark', 'PHP-Egypt',
        'PHP-France', 'PHP-Germany', 'PHP-Hungary', 'PHP-Iceland', 'PHP-Japan',
    ];

    public function exportBooks()
    {
        return $this->books;
    }
}

Class Book
{
    protected $type;
    protected $name;

    public function __construct($type, $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }
}

Class TtnLibrary
{
    const CATEGORY = [
        'TtnSwiftBooks' => 'Swift',
        'TtnKotlinBooks' => 'Kotlin',
        'TtnPHPBooks' => 'PHP',
    ];

    protected $books = [];

    public function importBooks(BookDatabase $bookDatabase)
    {
        $type = $this->getCategory($bookDatabase);

        foreach ($bookDatabase->exportBooks() as $bookName) {
            $this->books[] = new Book($type, $bookName);
        }
    }

    public function searchTool($type, $text)
    {
        $books = [];

        switch ($type) {
            case 'name':
                $books = $this->searchByName($text);
                break;
            case 'category':
                $books = $this->searchByCategory($text);
                break;
            default:
                $books = [];
                break;
        }

        $result = $this->prepareArrayOutput($books);

        return $result;
    }

    protected function getCategory(BookDatabase $bookDatabase)
    {
        return static::CATEGORY[get_class($bookDatabase)];
    }

    protected function searchByName($text)
    {
        $result = [];

        $result = array_filter($this->books, function ($book) use ($text) {
            if (stripos($book->getName(), $text) !== false) return $book;
        });

        return $result;

    }

    protected function searchByCategory($text)
    {
        $result = [];

        $result = array_filter($this->books, function ($book) use ($text) {
            if ($book->getType() == $text) return $book;
        });

        return $result;
    }

    protected function prepareArrayOutput(Array $books)
    {
        $output = array_map(function ($book) {
            return $book->getName();
        }, $books);

        $output = array_values($output);

        return $output;
    }
}

$library = new TtnLibrary;
$library->importBooks(new TtnSwiftBooks);
$library->importBooks(new TtnKotlinBooks);
$library->importBooks(new TtnPHPBooks);

// print_r($library->searchTool('category', 'Swift'));
// print_r($library->searchTool('category', 'Kotlin'));
// print_r($library->searchTool('category', 'PHP'));
// print_r($library->searchTool('name', 'Jaguar'));
// print_r($library->searchTool('name', 's'));
