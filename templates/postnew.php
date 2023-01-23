
        <form action="PostCreate.php" method="post" autocomplete="off" class="form_post" enctype="multipart/form-data">
            <h1>Создание поста</h1>
            <label class="form_label" for="title">Заголовок</label>
            <input type="text" name="title" id="title" <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[0]['status'] == TRUE):?>class="error-input"<?php endif?>>
            <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[0]['status'] == TRUE):?><p class="error_mes"><?=$errors[0]['name_error']?></p><?php endif?>

            <label class="form_label" for="body">Содержание</label>
            <textarea type="text" name="body" id="body" <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[1]['status'] == TRUE):?>class="error-input"<?php endif?>></textarea>
            <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[1]['status'] == TRUE):?><p class="error_mes"><?=$errors[1]['name_error']?></p><?php endif?>
            
            <label class="form_label" for="file">Изображение</label>
            <input type="file" name="file" id="file" value="" accept="image/*">
            <button class="btn btn-dark">Создать</button>
        </form>