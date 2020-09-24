<h1>Sign-Up</h1>

<?php echo $errors ?? ''?>

<form action="/user/register" method="post">
    <div>
        <label for="">Name</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Email</label>
        <input type="text" name="email">
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <button>Sign Up</button>

</form>