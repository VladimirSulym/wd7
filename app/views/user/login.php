Вход:  <?php echo $error; ?>
<form method="POST" action="<?php echo core::url('user', 'login'); ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    E: <input type="text" name="email" value="<?php echo $email ?? ''; ?>" /><br />
    P: <input type="password" name="password" value="<?php echo $password ?? ''; ?>" /><br />
    <input type="submit" name="submit" />
</form>