<?php


namespace Controllers;
use Models\Post;
use Models\Products;
use View\View;
use Models\Category;

class CatalogController {


    public function listCategories()
    {
        $categories = Category::all();
        $title = 'List category';
        View::render('catalog/listCategories', compact('categories', 'title' ));
    }

    public function listProducts() {
        $id = $_GET['id'];
        $products = Products::getByCategoryId($id);
        $title = 'List products';
//        var_dump($products);
        if($products == null) {
            View::render('errors/404', [], 404);
            return;
        }
        View::render('catalog/listProducts', compact('products', 'title'));
    }

    public function showProduct() {
        $id = $_GET['id'];
        $product = Products::getById($id);
        if ($product == null) {
            View::render('errors/404', [], 404);
            return;
        }

        View::render('catalog/showProduct', compact('product'));
    }

    public function add()
    {
        $params = [];
        if (!empty($_POST)) {
            try {
                $category = new Category();
                $category->setName($_POST['name']);
                $category->save();
            }catch (\Exception\InvalideParamException $e) {
                $params['errors'] = $e->getMessage();
            }
        }
        View::render('catalog/add', $params);
    }



}