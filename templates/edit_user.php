<div class="form-cent">
            <form class="reg100-form" action="edit_profil.php" method="post" autocomplete="off">
                <h1 class="h-reg">Изменение профиля</h1>
                <div class="div-inf">
                    <input type="text" id="user_name" name="user_name" value="<?=$user_name?>" class="inp-log <?php if($errors[0]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Имя">
                </div>
                <?php if($errors[0]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[0]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="text" id="email" name="email" value="<?=$email?>" class="inp-mail <?php if($errors[1]['error_status'] === TRUE || $errors[2]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Почта">
                </div>
                <?php if($errors[1]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[1]['error_name']?></p> <?php endif?>
                <?php if($errors[2]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[2]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="text" id="phone" name="phone" value="<?=$phone?>" class="inp-phone <?php if($errors[3]['error_status'] === TRUE || $errors[4]['error_status'] === TRUE): ?> error-input <?php endif?>" id="phone" name="phone" placeholder="Номер телефона">
                </div>
                <?php if($errors[3]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[3]['error_name']?></p> <?php endif?>
                <?php if($errors[4]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[4]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="password" id="password_old" name="password_old" class="inp-pass <?php if($errors[5]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Старый пароль">
                    <input type="password" id="password_new" name="password_new" class="inp-pass <?php if($errors[6]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Новый пароль">
                </div>
                <?php if($errors[5]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[5]['error_name']?></p> <?php endif?>
                <?php if($errors[6]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[6]['error_name']?></p> <?php endif?>
                <div class="div-inf">
                    <button class="btn btn-dark button-bord">Сохранит</button>
                </div>
            </form>
        </div>
    </main>