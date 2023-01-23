        <section class="bookings">
            <ul class="bookings_block">
                <li>
                    <p class="id">ID</p>
                    <p class="date">Начало</p>
                    <p class="date">Конец</p>
                    <p class="price">Цена</p>
                    <p class="p-end" style="border-right: 0;">Действие</p>
                </li>
                <?php if(sizeof($booking_user)):?>
                    <?php foreach($booking_user as $item):?>
                            <li <?php if($item['Active'] == 0):?> class="disabled" <?php endif?>>
                                <p class="id"><?=$id?></p> <?php $id++?>
                                <p class="date"><?=date("Y.m.d H.i", strtotime($item['Date_start']))?></p>
                                <p class="date"><?=date("Y.m.d H.i", strtotime($item['Date_end']))?></p>
                                <p class="price"><?=$item['Price']?> р.</p>
                                <form action="disable_booking.php?id=<?=$item['Id']?>" method="post" autocomplete="off">
                                    <button class="button-close" <?php if($item['Active'] == 0):?> disabled <?php endif?>>Отменить</button>
                                </form>
                            </li>
                    <?php endforeach?>
                <?php else:?>
                    <li><p class="not-found" style="border-right: 0;">Вы ещё не бронировали</p></li>
                <?php endif?>
            </ul>
        </section>

