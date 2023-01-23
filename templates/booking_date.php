        <div class="form-cent">
            <form class="form-100" action="booking.php" method="post" autocomplete="off">
                <h1>Создание брони</h1>
                <h2>Выберете время</h2>
                <p>Начало брони</p>
                <input type="datetime-local" name="date_from" id="date_from" <?php if($_SERVER['REQUEST_METHOD'] == 'POST'):?>value="<?=$dateFrom?>"<?php endif?> <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errors[0]['status'] == TRUE || $errors[1]['status'] == TRUE || $errors[2]['status'] == TRUE || $errors[3]['status'] == TRUE || $errors[4]['status'] == TRUE)):?> class="error-input" <?php endif?>>
                <p>Конец брони</p>
                <input type="datetime-local" style="margin-bottom: 25px;" name="date_do" id="date_do" <?php if($_SERVER['REQUEST_METHOD'] == 'POST'):?>value="<?=$dateDo?>"<?php endif?> <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errors[0]['status'] == TRUE || $errors[1]['status'] == TRUE || $errors[2]['status'] == TRUE || $errors[3]['status'] == TRUE || $errors[4]['status'] == TRUE)):?>class="error-input"<?php endif?>>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[0]['status'] == TRUE):?> <p class="error_mes"><?=$errors[0]['name_error']?> </p><?php endif?>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[1]['status'] == TRUE):?> <p class="error_mes"><?=$errors[1]['name_error']?> </p><?php endif?>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[2]['status'] == TRUE):?> <p class="error_mes"><?=$errors[2]['name_error']?> </p><?php endif?>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[3]['status'] == TRUE):?> <p class="error_mes"><?=$errors[3]['name_error']?> </p><?php endif?>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[4]['status'] == TRUE):?> <p class="error_mes"><?=$errors[4]['name_error']?> </p><?php endif?>
                <?php if($errors[5]['status'] == TRUE):?> <p class="error_mes"><?=$errors[5]['name_error']?> </p><?php endif?>
                <button <?php if($errors[5]['status'] == TRUE):?>disabled<?php endif?>>Далее</button>
            </form>
        </div>