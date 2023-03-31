<?php

class TelegraphText
{
    private $title;
    private $text;
    private $author;
    private $published;
    private $slug;


    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date("y.m.d H:i:s");
    }

    public function storeText(string $title, string $text)
    {
        $array = [
          'title' => $title,
          'text' => $text,
          'author' => $this->author,
          'published' => $this->published
        ];
        $serializeArray = serialize($array);
        

        if (file_exists($this->slug)) {
            $current = file_get_contents($this->slug);
            $current = $serializeArray;
            file_put_contents($this->slug, $current);
        } else {
            echo "Файл $this->slug не существует";
        }
    }

    public function loadText()
    {


        if (file_exists($this->slug)) {
            $serialize = file_get_contents($this->slug);
            $unserialize = unserialize($serialize);
            $this->title = $unserialize['title'];
            $this->text = $unserialize['text'];
            $this->author = $unserialize['author'];
            $this->published = $unserialize['published'];

            return $this->text;
        } else {
            echo "Файл $this->slug не существует";
        }
    }

    public function editText(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }
}

$telegraph = new TelegraphText('Харуки Мураками', 'харуки_мураками.txt');

$telegraph->editText('Кафка на пляже', 'Роман');
$telegraph->storeText('Медленной шлюпкой в Китай', 'Рассказ');
$telegraph->editText('Буран', 'Стихи');
$telegraph->storeText('Золото', 'Металл');
echo $telegraph->loadText() . PHP_EOL;