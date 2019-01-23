<h1 class="text-center">Объявление</h1>
<form method="post" enctype="multipart/form-data" class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <p>Выберите категорию</p>
            <?php
            selected();
            ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputTitle">Заголовок</label>
            <input type="text" class="form-control" id="exampleInputTitle" placeholder="Заголовок" name="title">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputPrice">Укажите цену</label>
            <input type="text" class="form-control" id="exampleInputPrice" placeholder="Цена" name="price">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="exampleInputText">Текст</label>
            <textarea class="form-control" id="exampleInputText" placeholder="Текст" rows="10" name="text"></textarea>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <p>Выберите фото</p>
            <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide"
                   data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile"
                                                                                   class="btn-primary btn btn-default"><span>Выбрать</span></label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <button type="submit" class="btn btn-default btn-primary" name="submit">Подать</button>
    </div>
</form>