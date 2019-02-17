<?php global $email;?>
<h1 class="text-center">Контакты</h1>
<div class="group">
    <h2 class="h5">Сотрудничество</h2>
    <p class="fa fa-mail-forward"><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
</div>
<h3 class="text-center">Обратная связь</h3>
<form method="post" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Ваше имя</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Имя" value="<?php echo @$_POST['name'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputPassword3" name="email" placeholder="Email" value="<?php echo @$_POST['email'];?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <p>Сообщение</p>
            <textarea class="form-control" rows="3" name="text" placeholder="Текст"><?php echo @$_POST['text'];?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-default btn-primary">Отправить</button>
        </div>
    </div>
</form>
<?php
if (isset($_POST['submit'])){
    $data = $_POST;
    $errors = array();
    $emailUser = $data['email'];
    $name = htmlentities($data['name'], ENT_QUOTES);
    $text = htmlentities($data['text'], ENT_QUOTES);
    if (empty($data['name']) or $data['name'] == ' '){
        $errors[] = 'Не ввели имя';
    }
    if ($data['name'] >= 3){
        $errors[] = 'Имя должно быть не меньше 3 симловов и не больше 20';
    }
    if (empty($data['email'])){
        $errors[] = 'Не ввели почту';
    }
    if (!preg_match("/^(?!.*@.*@.*$)(?!.*@.*\-\-.*\..*$)(?!.*@.*\-\..*$)(?!.*@.*\-$)(.*@.+(\..{1,11})?)$/", "$emailUser")) {
        $errors[] = 'Вы неправильно ввели электронную почту';
    }
    if (empty($data['text']) or $data['text'] == ' '){
        $errors[] = 'Поле сообщение пустое';
    }
    if ($data['text'] >= 10) {
        $errors[] = 'Имя должно быть не меньше 10 симловов и не больше 1000';
    }
    if (empty($errors)){
        $users = do_query("INSERT INTO `feeback` (`name`, `email`, `text`) VALUES ('".$name."','{$data['email']}', '".$text."')");
        if ($users){
            echo '<div class="go">Успешно отправлено</div>';
        }
    }else{
        echo '<div class="errors">'.array_shift($errors).'</div>';
    }
}
event_mail();