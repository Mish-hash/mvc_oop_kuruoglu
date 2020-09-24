<h2><?= $title ?></h2>
<a href="post/add" class="add-post" >Add post +</a>
<?php foreach ($posts as $post): ?>
<artical>
    <h2><a href="/post?id=<?= $post->getId()?>"><?= $post->getName()?></a></h2>
<small><a href="/post/edit?id=<?= $post->getId()?>">Edit</a></small>
<small><a href="#" class="delete-post" data-id="<?= $post->getId()?>">Delete</a></small>

<p><?= $post->getText()?></p>
</artical>
    <hr>
<?php endforeach; ?>
