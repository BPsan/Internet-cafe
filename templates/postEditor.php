<form action="PostEdit.php?post=<?=$post_id?>" method="post" autocomplete="off" class="form_post" enctype="multipart/form-data">
    <h1>Изменение поста</h1>
    <label class="form_label" for="title">Заголовок</label>
    <input type="text" name="title" id="title" value="<?=$res_post[1]?>">
    <label class="form_label" for="body">Содержание</label>
    <textarea type="text" name="body" id="body"><?=$res_post[2]?></textarea>
    <label class="form_label" for="file">Изображение</label>
    <input type="file" name="file" id="file" value="" accept="image/*">
    <button class="btn btn-dark">Изменить</button>
</form>