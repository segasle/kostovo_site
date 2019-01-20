<h1 class="text-center">Профиль</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <p>Выберите фото</p>
        <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide" data-multiple-caption="{count} files selected" multiple>     <label for="exampleInputFile" class="btn-primary btn btn-default"><span>Выбрать</span></label>
    </div>
    <div class="form-group">
        <label for="exampleInputName">Имя</label>
        <input type="text" class="form-control" id="exampleInputName" placeholder="Имя" name="name">
    </div>
    <div class="form-group">
        <label for="exampleInputFamilia">Фамилия</label>
        <input type="text" class="form-control" id="exampleInputFamilia" placeholder="Фамилия" name="familia">
    </div>
    <div class="form-group">
        <label for="exampleInputPhone">Номер телефона</label>
        <input type="text" class="form-control" id="exampleInputPhone" placeholder="Телефон" name="phone">
    </div>
    <button type="submit" class="btn btn-default btn-primary" name="submit">Обновить данные</button>

</form>