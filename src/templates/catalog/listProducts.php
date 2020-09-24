<h2><?=$title?></h2>

    <ul>
<?php foreach ($products as $product): ?>
        <li><a  href="product?id=<?= $product->getId()?>"><?=$product->getName()?></a></li>
        <small><?= $product->getDescription()?></small><br>
        <small><?= 'Price: ' .  $product->getPrice() . 'grn'?></small>

<?php endforeach;?>

    </ul>


