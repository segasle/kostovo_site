<h1 class="text-center">История</h1>
<?php
if (isset($_SESSION['token'])) {
    ?>
    <h2 class="h4">Вы можете написать пост</h2>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="exampleInputText">Текст</label>
            <textarea class="form-control" id="exampleInputText" placeholder="Текст" rows="10" name="text"></textarea>
        </div>
      <!--  <div class="form-group">
            <p>Выберите фото</p>
            <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide"
                   data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile"
                                                                                   class="btn-primary btn btn-default"><span>Выбрать</span></label>
        </div>-->
        <button type="submit" class="btn btn-default btn-primary" name="submit">Отправить</button>

    </form>
    <?php
} else {
    ?>
    <h2 class="text-center">Авторизуйтесь через вк пожалуйста, чтобы написать пост</h2>
    <?php
}

if (isset($_POST['submit'])){
    $data = $_POST;
    $errors = array();
    if (empty($data['text'])){
        $errors[] = 'Вы не ввели сообщения';
    }
    if ($data['text'] <= 10){
        $errors[] = 'Ввели мало симловов';
    }
    if (empty($errors)){
        $message = do_query("INSERT INTO `post` (`text`, `user`) VALUES ('{$data['text']}', '{$_SESSION['user_id']}')");
        if ($message){
            $get =mysqli_fetch_assoc(do_query("SELECT * FROM `post` JOIN `users` ON users.users-id = post.user WHERE post.user"));
            print_r($get);


            echo '<div class="go">Успешно отправлено</div>';
        }
    }else{
        echo '<div class="errors">'.array_shift($errors).'</div>';
    }
}
get_post_vk();