<?= $errors ?? ''?>

<form action="/post/edit?id=<?= $post->getId()?>" method="POST">
    <input type="hidden" name="_method" value="UPDATE">
    <div>
        <label for="">Name</label>
        <input type="text" name="name" value="<?= $post->getName()?>">
    </div>
    <div>
        <label for="">Text</label>
        <input type="text" name="text" value="<?= $post->getText()?>">
    </div>
    <div>
        <label for="">Author</label>
        <select name="author" id="">
            <?php foreach($authors as $author): ?>
                <option value="<?= $author->getId()?>"
                    <?= ($post->getAuthorId() == $author->getId()) ? 'selected' : ''?>><?= $author->getName()?></option>
            <?php endforeach;?>
        </select>
    </div>
    <button>Add Post</button>

</form>