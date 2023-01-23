<div class="form-cent">
    <div class="body-inf">
        <h2>Вы дейтсвительно хотите удалить пост?</h2>
            <div class="conf">
                <form action="deletePost.php?post=<?=$post_id?>&choice=yes" method="post" autocomplete="off">
                    <button class="btn btn-dark button-bord">Да</button>
                </form>
                <form action="deletePost.php?post=<?=$post_id?>&choice=no" method="post" autocomplete="off">
                    <button class="btn btn-dark button-bord">Нет</button>
                </form>
            </div>
    </div>
</div>