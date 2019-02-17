<?php global $email;?>
<h1 class="text-center">Контакты</h1>
<div class="group">
    <h2 class="h5">Сотрудничество</h2>
    <p class="fa fa-mail-forward"><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
</div>
<h3 class="text-center">Обратная связь</h3>
<form class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Ваше имя</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" name="name" placeholder="Имя">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <p>Сообщение</p>
            <textarea class="form-control" rows="3" name="text" placeholder="Текст"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-primary">Отправить</button>
        </div>
    </div>
</form>