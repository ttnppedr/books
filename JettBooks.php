<?php

interface BookInterface
{
    public function getBookNames();
}

class JettKotlinBooks implements BookInterface
{
    private $kotlinBookNames;

    public function __construct()
    {
        $this->kotlinBookNames = ['kotlin_book1', 'kotlin_book2', 'kotlin_book3', 'kotlin_book4'];
    }

    public function getBookNames()
    {
        return $this->kotlinBookNames;
    }
}

class JettPHPBooks implements BookInterface
{
    private $phpBookNames;

    public function __construct()
    {
        $this->phpBookNames = ['php_book1', 'php_book2', 'php_book3', 'php_book4'];
    }

    public function getBookNames()
    {
        return $this->phpBookNames;
    }
}

class JettSwiftBooks implements BookInterface
{
    private $swiftBookNames;

    public function __construct()
    {
        $this->swiftBookNames = ['swift_book1', 'swift_book2', 'swift_book3', 'swift_book4'];
    }

    public function getBookNames()
    {
        return $this->swiftBookNames;
    }
}
