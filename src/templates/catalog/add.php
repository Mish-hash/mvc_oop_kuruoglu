<?= $errors ?? ''?>

<form action="/categories/add" method="post">

    <div>
        <label>Category Name</label>
        <input type="text" name="name">
    </div>

    <button>Add category</button>


</form>