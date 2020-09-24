<?= $errors ?? ''?>

<form action="/post/add" method="post">
    <div>
        <label>Title</label>
        <input type="text" name="title">
    </div>
    <div>
        <label>Text</label>
        <input type="text" name="text">
    </div>
    <div>
        <select name="author">
            <?php foreach($authors as $author): ?>
            <option value="<?= $author->getId()?>">
                <?= $author->getName()?>
             <?php endforeach;?>
            </option>
        </select>
    </div>
    <button>Add post</button>


</form>
