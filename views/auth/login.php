<?php if (isset($error)): ?>
    <div style="color: red"><?= $error ?></div>
<?php endif; ?>
<form action="login" method="post">
    <p>
        <label>Login:<br>
            <input type="text" name="login" value="">
        </label>
    </p>
    <p>
        <label>Password:<br>
            <input type="password" name="password" value="">
        </label>
    </p>
    <p>
        <input type="submit" value="Sign in">
        <br>
    </p>
</form>
