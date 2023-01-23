        <div class="form-cent">
            <form class="form-100" style="height: 400px;" action="booking.php" method="post" autocomplete="off">
                <h1>Создание брони</h1>
                <h2>Выберете место</h2>
                <p>Начало брони</p>
                <input type="datetime-local" name="date_from" id="date_from" value="<?=$dateFrom?>">
                <p>Конец брони</p>
                <input type="datetime-local" name="date_do" id="date_do" value="<?=$dateDo?>">
                <p>Свободные места</p>
                <select name="computer" id="" style="margin-bottom: 25px;">
                    <?php if(isset($busy)):?>
                        <?php foreach($all_computer as $item):?>
                            <?php if(!is_int(array_search($item['Id'], $busy))):?> <option value="<?=$item['Id']?>">компьютер <?=$item['Id']?> Цена: <?=$formula*$item['Rate']?></option> <?php endif?>
                        <?php endforeach?>
                    <?php else:?>
                        <?php foreach($all_computer as $item):?>
                            <option value="<?=$item['Id']?>">компьютер <?=$item['Id']?> Цена: <?=$formula*$item['Rate']?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
                <button>Создать</button>
            </form>
        </div>