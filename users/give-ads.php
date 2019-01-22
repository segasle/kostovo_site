<h1 class="text-center">Объявление</h1>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <p>Выберите категорию</p>
        <select class="form-control" name="value">
            <option>1</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputTitle">Заголовок</label>
        <input type="text" class="form-control" id="exampleInputTitle" placeholder="Заголовок" name="title">
    </div>
    <div class="form-group">
        <label for="exampleInputPrice">Укажите цену</label>
        <input type="text" class="form-control" id="exampleInputPrice" placeholder="Цена">
    </div>
    <div class="form-group">
        <label for="exampleInputText">Текст</label>
        <textarea class="form-control" id="exampleInputText" placeholder="Текст"  rows="10"></textarea>
    </div>                                                                                                                    <div class="form-group">
        <p>Выберите фото</p>
        <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide" data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile" class="btn-primary btn btn-default"><span>Выбрать</span></label></div>
    <button type="submit" class="btn btn-default btn-primary">Подать</button>
</form>