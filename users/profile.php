<h1 class="text-center">Профиль</h1>
<?php
users_data();

if (isset($_SESSION['id']) or isset($_SESSION['token'])) {
    if (file_exists('update/' . $_SESSION['photo'])) {
        $img = 'update/' . $_SESSION['photo'];
    } else {
        $img = $_SESSION['photo'];
    }
    if (isset($_SESSION['phone']) or isset($_SESSION['address'])) {
        $address =  $_SESSION['address'];
        $phone =  $_SESSION['phone'];
    }
if (!empty($_SESSION['photo'] or $_SESSION['phone'] or $_SESSION['surname'] or $_SESSION['name'] or $_SESSION['email'] or $_SESSION['address'])) {
    echo '<div class="author"><div class="author-img"><img src="' . $img . '" alt="" class="author-photo"></div><div class="author-fio"><p>' . $_SESSION['name'] . ' ' . $_SESSION['surname'] . '</p></div><div class="author-phone"><p>'.@$_SESSION['user_id'].'</p>
<p>' . @$phone . '</p></div><div class="author-email"><p>' . $_SESSION['email'] . '</p></div><div class="author-address"><p>' . @$address. '</p></div></div>';
} ?>
<form action="" method="post" enctype="multipart/form-data">   <?php if (empty($_SESSION['photo'])) {
        echo '<div class="form-group">
        <p>Выберите фото</p>
        <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide" data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile" class="btn-primary btn btn-default"><span>Выбрать</span></label></div> ';
    }
    if (empty($_SESSION['phone'])) {
        echo '<div class="form-group">
        <label for="exampleInputPhone">Номер телефона</label>
        <input type="text" class="form-control" id="exampleInputPhone" placeholder="Телефон" name="phone">
    </div>';
    }
    if (empty($_SESSION['name'])) {
        echo '<div class="form-group">
        <label for="exampleInputName">Имя<label>
        <input type="text" class="form-control" id="exampleInputName" placeholder="Имя" name="name" value="'.$_SESSION['name'].'">
    </div>';
    }
    if (empty($_SESSION['surname'])) {
        echo '<div class="form-group">
        <label for="exampleInputFamilia">Фамилия</label>
        <input type="text" class="form-control" id="exampleInputFamilia" placeholder="Фамилия" name="familia" value="'.$_SESSION['surname'].'">
    </div>';
    }

    if (empty($_SESSION['address'])) {
        echo '<div class="form-group">
        <label for="exampleInputAddress">Адрес</label>
        <input type="text" class="form-control" id="exampleInputAddress" placeholder="Адрес" name="address">
    </div>';

    }
        if (!empty(@$phone or $_SESSION['name'] or $_SESSION['surname'] or $_SESSION['photo'] or $_SESSION['address'])) {
            echo '<button type="submit" class="btn btn-default btn-primary" name="submit">Обновить данные</button>';
        }

    } ?>
</form>