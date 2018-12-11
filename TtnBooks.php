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
