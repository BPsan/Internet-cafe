           <div class="form-cent">
            <form class="reg100-form" action="SingUp.php" method="post" autocomplete="off">
                <h1>Регистрация</h1>
                <div class="div-inf">
                    <input type="text" id="user_name" name="user_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?><?=$user_name?><?php endif?>" class="inp-log <?php if($errors[0]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Имя">
                </div>
                <?php if($errors[0]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[0]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="text" id="email" name="email" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?><?=$email?><?php endif?>" class="inp-mail <?php if($errors[1]['error_status'] === TRUE || $errors[2]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Почта">
                </div>
                <?php if($errors[1]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[1]['error_name']?></p> <?php endif?>
                <?php if($errors[2]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[2]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="text" id="phone" name="phone" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?><?=$phone?><?php endif?>" class="inp-phone <?php if($errors[3]['error_status'] === TRUE || $errors[4]['error_status'] === TRUE): ?> error-input <?php endif?>" id="phone" name="phone" placeholder="Номер телефона">
                </div>
                <?php if($errors[3]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[3]['error_name']?></p> <?php endif?>
                <?php if($errors[4]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[4]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <input type="password" id="password" name="password" class="inp-pass <?php if($errors[5]['error_status'] === TRUE): ?> error-input <?php endif?>" placeholder="Пароль">
                </div>
                <?php if($errors[5]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[5]['error_name']?></p> <?php endif?>

                <div class="div-inf">
                    <button class="btn btn-dark button-bord">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </main>