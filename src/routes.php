<?php

return [
    '/' => 'HomeController@index', 
    'blog' => 'BlogController@index',
    'post' => 'BlogController@show',
    'post/edit' => 'BlogController@edit',
    'post/editClick' => 'BlogController@editClick',
    'post/delete' => 'BlogController@delete',
    'post/add' => 'BlogController@add',
    'categories' => 'CatalogController@listCategories',
    'categories/add' => 'CatalogController@add',
    'category' => 'CatalogController@listProducts',
    'product' => 'CatalogController@showProduct',
    'user/register' => 'UserController@signUp',
    'pdf' => 'PdfController@index',
    'xls' => 'PdfController@excelExport',
    'ixls' => 'PdfController@excelImport',

];