<?php


namespace services;


class Db
{
    private static $instanceCount = 0;
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
         self::$instanceCount++;
         extract( (require __DIR__ . '/../settings.php')['db'] );
        try {
         $this->pdo = new \PDO("mysql:host=$host; dbname=$dbname; 
         port=$port", $user, $password);

        }
        catch (\PDOException $e) {
            throw new \Exceptions\DbException('Ошибка подключения к ДБ');
        }

    }

    public function query(string $sql, array $params = [], string $className = 'stdClass')  {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);
        if($result == false) {
            return null;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, $className);
    }


    public static function getInstanceCount()
    {
        return self::$instanceCount;
    }


    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}