<?php


namespace Models;


class Products extends ActiveRecord
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $category_id;

    public static function getTableName()
    {
        return 'products';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }
}