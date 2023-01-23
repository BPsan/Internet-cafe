
        <div class="form-cent">
            <div class="body-inf">
                <div class="info-user">
                    <p class="text">Имя</p>
                    <p class="inf-user"><?php print($sessia['name'])?></p>
                    <p class="text">Номер телефона</p>
                    <p class="inf-user"><?php print($sessia['phone'])?></p>
                    <p class="text">Почта</p>
                    <p class="inf-user"><?php print($sessia['email'])?></p>
                    <p class="text">Пароль</p>
                    <p class="inf-user"><?php echo( str_repeat("*", strlen($sessia['password']) ) )?></p>
                </div>
                <div class="buttons">
                    <ul>
                        <li><a href="index.php">На главную</a></li>
                        <?php if($sessia['role'] == 2):?>
                            <li><a href="postCreate.php">Выложить пост</a></li>
                        <?php else:?>
                            <li><a href="edit_profil.php">Изменить профиль</a></li>
                            <li><a href="booking.php">Забронировать место</a></li>
                            <li><a href="story.php">Все брони</a></li>
                        <?php endif?>
                        <li><a href="logout.php">Выход</a></li>
                    </ul>
                </div>
            </div>
        </div>