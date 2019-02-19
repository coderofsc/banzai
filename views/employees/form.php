<form class="form-horizontal" method="post">
    <div class="form-group">
        <label class="col-sm-2 control-label">ФИО</label>
        <div class="col-sm-6">
            <input type="text" required name="data[fio]" class="form-control" value="<?=@$data["employee"]["fio"]?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Пол</label>
        <div class="col-sm-3">
            <div class="radio">
                <label>
                    <input type="radio" name="data[sex]" value="0" > Не указано
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="data[sex]" value="1" <? if (@$data["employee"]["sex"] == 1) echo "checked";?>> Мужской
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="data[sex]" value="2" <? if (@$data["employee"]["sex"] == 2) echo "checked";?>> Женский
                </label>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">Должность</label>
        <div class="col-sm-6">
            <select name="data[pos_id]" class="form-control">
                <option>Не указано</option>

                <?foreach ($data["ar_positions"] as $row) {?>
                    <option <? if (@$data["employee"]["pos_id"] == $row["id"]) echo "selected";?> value="<?=$row["id"]?>"><?=$row["name"]?></option>
                <?}?>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Год рождения</label>
        <div class="col-sm-3">
            <input type="text" required name="data[bd_year]" class="form-control" value="<?=@$data["employee"]["bd_year"]?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Группы</label>
        <div class="col-sm-3">

            <?foreach ($data["ar_groups"] as $row) {?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="data[id_group][]" <? if (isset($data["employee"]["ar_groups"][$row["id"]])) echo "checked";?> value="<?=$row["id"]?>"> <?=$row["name"]?>
                    </label>
                </div>
            <?}?>

            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" name="save" class="btn btn-default btn-primary">Сохранить</button>
        </div>
    </div>
</form>