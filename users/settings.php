<h1 class="text-center">Настройки</h1>

<form action="" method="post">
    <div class="form-group">
        <p class="h5">Сменить пароль</p>
        <label for="passwordR">Старый пароль</label>
        <div class="form-group_input">
            <input type="password" class="form-control" id="passwordR" name="passwordR">
            <div class="input-group-addon" id="s-h-pass"><span class="fa fa-eye fa-2x" title="Показать пароль"></span></div>
        </div>
        <label for="password1">Новый пароль</label>
        <div class="form-group_input">
            <input type="password" class="form-control" id="password1" name="password1">
            <div class="input-group-addon" id="s-h-pass"><span class="fa fa-eye fa-2x" title="Показать пароль"></span></div>
        </div>
        <label for="password2">Подтвердить пароль</label>
        <div class="form-group_input">
            <input type="password" class="form-control" id="password2" name="password2">
            <div class="input-group-addon" id="s-h-pass"><span class="fa fa-eye fa-2x" title="Показать пароль"></span></div>
        </div>
    </div>
    <button name="submit" type="submit" class="btn btn-default btn-primary">Сохранить</button>
</form>
<form action="" method="post">
    <div class="form-group">
        <p class="h5">Сменить почту</p>
        <label for="email">Email</label>
        <div class="form-group_input">
            <input type="text" value="<?php $_SESSION['email']?>" name="email" class="form-control">
        </div>
    </div>
    <button name="submit" type="submit" class="btn btn-default btn-primary">Сохранить</button>

</form>
<?php
/**
 * Created by PhpStorm.
 * User: sergej
 * Date: 17.01.19
 * Time: 16:50
 */