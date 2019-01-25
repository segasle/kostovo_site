<h1 class="text-center">Профиль</h1>
<?php
users_data();

if (isset($_SESSION['id'])) {
    if (isset($_SESSION['photo'])) {
        if (!empty($_SESSION['photo'] or $_SESSION['phone'] or $_SESSION['surname'] or $_SESSION['name']or $_SESSION['email'] or $_SESSION['address'])) {
            echo '<div class="author"><div class="author-img"><img src="update/' . $_SESSION['photo'] . '" alt="" class="author-photo"></div><div class="author-fio"><p>'.$_SESSION['name'].' '.$_SESSION['surname'].'</p></div><div class="author-phone">
<p>'.$_SESSION['phone'].'</p></div><div class="author-email"><p>'.$_SESSION['email'].'</p></div><div class="author-address"><p>'.$_SESSION['address'].'</p></div></div>';
        }
    }
}?>
<form action="" method="post" enctype="multipart/form-data">
<?php
if (isset($_SESSION['id'])) {
    if (empty($_SESSION['photo'])){
    echo '<div class="form-group">
        <p>Выберите фото</p>
        <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide" data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile" class="btn-primary btn btn-default"><span>Выбрать</span></label></div> ';
}
    if (empty($_SESSION['phone'])){
        echo '<div class="form-group">
        <label for="exampleInputPhone">Номер телефона</label>
        <input type="text" class="form-control" id="exampleInputPhone" placeholder="Телефон" name="phone">
    </div>';
    }
    if (empty($_SESSION['name'])){
        echo '<div class="form-group">
        <label for="exampleInputName">Имя<label>
        <input type="text" class="form-control" id="exampleInputName" placeholder="Имя" name="name">
    </div>';
    }
             if (empty($_SESSION['surname'])){
                 echo '<div class="form-group">
        <label for="exampleInputFamilia">Фамилия</label>
        <input type="text" class="form-control" id="exampleInputFamilia" placeholder="Фамилия" name="familia">
    </div>';
             }

             if (empty($_SESSION['address'])) {
                echo '<div class="form-group">
        <label for="exampleInputAddress">Адрес</label>
        <input type="text" class="form-control" id="exampleInputAddress" placeholder="Телефон" name="address">
    </div>';

    }
    if (empty($_SESSION['phone'] or $_SESSION['name']or $_SESSION['surname']or $_SESSION['phone']or $_SESSION['address'])){
        echo '<button type="submit" class="btn btn-default btn-primary" name="submit">Обновить данные</button>';
    }
}
?>
</form>