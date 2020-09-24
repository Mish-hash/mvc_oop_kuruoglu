<h2><?= $title?></h2>
<a href="categories/add">Add Category +</a>
<ul>
<?php foreach ($categories as $category): ?>
    <li><a href="/category?id=<?= $category->getId()?>"><?=$category->getName()?></a></li>
   <?php endforeach;?>
</ul>



