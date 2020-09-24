<?php

namespace Models;
use services\Db;
use Exceptions\InvalidParamException;
class Post extends ActiveRecord
{
    protected $id;
    protected $name;
    protected $text;
    protected $author_id;
    protected $created_at;


    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName(string $name)
    {
        if(mb_strlen($name) < 3){
            throw new InvalidParamException('Title should be more 3 charts');
        }

        if(mb_strlen($name) > 10) {
            throw new InvalidParamException('Title should be not more 10 charts');
        }
        $this->name = $name;
    }



    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id)
    {
        $this->author_id = $author_id;
    }

    public function getAuthor()
    {
        return User::getById($this->author_id);
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }




    public static function getTableName()
    {
        return 'posts';
    }
}
