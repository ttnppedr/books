<?php
require_once('Ray_books.php');
require_once('JettBooks.php');
require_once('TtnBooks.php');

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
        'JettSwiftBooks' => 'Swift',
        'JettKotlinBooks' => 'Kotlin',
        'JettPHPBooks' => 'PHP',
        'RaySwift' => 'Swift',
        'RayKotlin' => 'Kotlin',
        'RayPHP' => 'PHP',
    ];

    const IMPORTMETHODMAP = [
        'BookDatabase' => 'exportBooks',
        'BookInterface' => 'getBookNames',
        'Others' => 'getBooks',
    ];

    protected $books = [];

    public function importBooks($bookDatabase)
    {
        $type = $this->getCategory($bookDatabase);

        $importMethod = $this->importAdaptor($bookDatabase);

        foreach ($bookDatabase->$importMethod() as $bookName) {
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

    protected function getCategory($bookDatabase)
    {
        return static::CATEGORY[get_class($bookDatabase)];
    }

    protected function importAdaptor($bookDatabase)
    {
        $interface = 'Others';

        foreach (static::IMPORTMETHODMAP as $k => $v) {
            if (in_array($k, class_implements($bookDatabase))) {
                $interface = $k;
            }
        }

        return static::IMPORTMETHODMAP[$interface];
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

$bookResources = [
    'TtnSwiftBooks', 'TtnKotlinBooks', 'TtnPHPBooks',
    'JettSwiftBooks', 'JettSwiftBooks', 'JettPHPBooks',
    'RaySwift', 'RayKotlin', 'RayPHP',
];

$library = new TtnLibrary;

foreach ($bookResources as $resource) {
    $library->importBooks(new $resource);
}

// print_r($library->searchTool('category', 'Swift'));
// print_r($library->searchTool('category', 'Kotlin'));
// print_r($library->searchTool('category', 'PHP'));
// print_r($library->searchTool('name', 'Jaguar'));
// print_r($library->searchTool('name', 's'));
