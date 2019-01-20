<h1 class="text-center">Восставление пароля</h1>

<?php
    password_recovery();
?>
<form action="" method="post" class="float-none">
    <div class="form-group">
        <label for="exampleInputEmail">Введите Email, на котором зарегистрован аккаунт</label>
        <input type="email" class="form-control" id="exampleInputEmail"
               name="email" placeholder="Email" value="<?php @$_POST['email']?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" class="form-control" name="password1"
               id="exampleInputPassword1" placeholder="Пароль">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Подтвердите пароль</label>
        <input type="password" class="form-control" name="password2"
               id="exampleInputPassword2" placeholder="Пароль">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default btn-primary" name="submit">Восстановить
        </button>
    </div>
</form>