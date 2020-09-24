<?php

namespace View;

class View{
    public static function render(string $path, array $vars=[], int $code = 200) { //$path = 'home/index'

        http_response_code($code);
        //до
        //$vars = ['posts'=> $post, 'title'=>$title]

        extract($vars);//разбивает ассоциативный массив на переменные
        //после выполнения появляются переменные
        //$posts и $title
        unset($vars);

        ob_start();
        require_once __DIR__ . '/../templates/header.php';
        require_once __DIR__ . '/../templates/'. $path .'.php';
        require_once __DIR__ . '/../templates/footer.php';
        $buffer = ob_get_contents();
        ob_end_clean();
        echo $buffer;
    }
}