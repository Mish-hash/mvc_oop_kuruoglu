<h2 class="edit-post" data-id="<?= $post->getId() ?>" data-name="<?= $post->getName() ?>"><?= $post->getName() ?></h2>
<small><?= $post->getAuthor()->getName() ?></small>
<p><?= $post->getText() ?></p>