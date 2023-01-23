        <section class="posts">
            <ul class="post_block">
                    <?php foreach($posts as $key => $item):?>
                        <li>
                            <h1 class="title_post"><?=$item['Title']?></h1>
                            <p class="body_post"><?=$item['Body']?></p>
                            <?php if ($item['Img'] != NULL): ?><img src="img/<?=$item['Img']?>"><?php endif; ?>
                            <p class="date_post"><?=$item['Date']?></p>
                            <?php if($role == 2):?><p><a href="../PostEdit.php?post=<?=$item['Id']?>">изменить</a>|<a href="../deletePost.php?post=<?=$item['Id']?>">удалить</a></p><?php endif?>
                        </li>
                    <?php endforeach;?>
            </ul>
        </section>