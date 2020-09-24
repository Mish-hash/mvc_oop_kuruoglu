<?php

namespace Models;

class Category extends ActiveRecord
{
    protected $id;
    protected $name;

    public static function getTableName()
    {
        return 'categories';
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

}