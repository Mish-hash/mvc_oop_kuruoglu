<?php


namespace Models;
use services\Db;

abstract class ActiveRecord
{
    public static function all()
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM ' . static::getTableName()  , [], static::class);
    }



    public static function findeByColumn(string $column, $value)
    {
        $db = Db::getInstance();
        $result =  $db->query('SELECT * FROM ' . static::getTableName() . ' WHERE '.$column.'=?'  , [$value], static::class);
//        var_dump($result);
        return $result ? $result[0] : null;
    }
    public static function getById($id)
    {
        $db = Db::getInstance();
        $result =  $db->query('SELECT * FROM ' . static::getTableName() . ' WHERE id=?'  , [$id], static::class);
//        var_dump($result);
        return $result ? $result[0] : null;
    }
    public static function getByCategoryId($id)
    {
        $db = Db::getInstance();
        $sql ='SELECT * FROM ' . static::getTableName() . ' WHERE category_id=?';
//        var_dump($sql);
        $result =  $db->query($sql  , [$id], static::class);
//        var_dump($result);
        return $result ? $result : null;
    }

//    public function save()
//    {
//        $reflector = new \ReflectionObject($this);
//        $properties = $reflector->getProperties();
//        $props = [];
//        foreach ($properties as $property) {
//            $props[] = $property->name;
//        }
////        echo '<pre>' . print_r($properties, true) . '</pre>';
////        echo '<pre>' . print_r($props, true) . '</pre>';
//
//       $str = [];
//        $params = [];
//        foreach ($props as $prop) {
//           $str[]= $prop . '=:' . $prop;
//           $params[$prop] = ''.$this->$prop.'';
//       }
//        echo '<pre>' . print_r($params, true) . '</pre>';
//
//       $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $str) . ' WHERE id=:id';
//        echo '<pre>' . print_r($sql, true) . '</pre>';
//        $db = Db::getInstance();
//        $db->query($sql, $params);
////        'UPDATE posts
////          SET name=:name, text=:text
////          WHERE id=:id';
//
////        [
////          'name' => $this->name,
////            'text' => $this->text,
////            'id' =>$this->id;
////      ]
//
//
//    }
    public function save() {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $str = [];
        $str_ins = [];
        $params = [];
        $params_ins = [];
        foreach ($properties as $property) {
            $p = $property->name;
//            echo $p.'<br>';
            if ($this->$p !== null) {
                $str[] = $p.'=:'.$p;
                $params[$p] = ''.$this->$p.'';
                $str_ins[] = $p;
                $params_ins[$p] = ':'.$p.'';
            }
        }
        if (static::getId() != null) {
            $sql = 'UPDATE '.static::getTableName().' SET '.implode(', ', $str).' WHERE id=:id';
        } else {
            $sql = 'INSERT INTO '.static::getTableName().' ('.implode(', ', $str_ins).') VALUES('.implode(', ', $params_ins).')';
        }
//        echo '<pre>'.print_r($sql, true).'</pre>';
//        echo '<pre>'.print_r($str, true).'</pre>';
//        echo '<pre>'.print_r($str_ins, true).'</pre>';
//        echo '<pre>'.print_r($params, true).'</pre>';
//        echo '<pre>'.print_r($params_ins, true).'</pre>';
        $db = Db::getInstance();
        $db->query($sql, $params);

    }

    public function delete()
    {
        $db=Db::getInstance();
        $db->query('DELETE FROM ' . static::getTableName() . ' WHERE id=?', [static::getId()]);
    }


    abstract public static function  getTableName();



}