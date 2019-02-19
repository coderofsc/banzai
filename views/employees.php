<?php
if ($data) {?>

<button class="btn btn-default" id="toggle-info" data-state="false">Показать доп. информацию</button>

<table class="table table-hover table-striped" id="emp-list">
    <colgroup>
        <col width="20px" />
        <col width="100px" />
        <col width="150px" />
        <col width="150px" />
        <col width="150px" />
        <col width="150px" />
        <col width="10px" />
    </colgroup>
    <thead>
        <th>№</th>
        <th>ФИО</th>
        <th>Должность</th>
        <th class="toggle-column hidden">Год рождния</th>
        <th class="toggle-column hidden">Пол</th>
        <th class="toggle-column hidden">Группы</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>

    <?php
    foreach ($data as $row) {?>
    <tr>
        <td><?=$row["id"]?></td>
        <td><?=$row["fio"]?></td>
        <td><? if ($row["pos_name"]) echo $row["pos_name"]; else echo "&mdash;";?></td>
        <td class="toggle-column hidden"><?=$row["bd_year"]?></td>
        <td class="toggle-column hidden">
            <?php
                if ($row["sex"] == 1) echo "Мужской";
                elseif ($row["sex"] == 2) echo "Женский";
                else echo "Не указан";
            ?>
        </td>
        <td class="toggle-column hidden">
            <?if (isset($row["ar_groups"])) {

                echo "<ul class=\"list-group\">";
                foreach ($row["ar_groups"] as $group) {
                    echo "<li>".$group["name"]."</li>";
                }
                echo "</ul>";

            } else {
                echo "&mdash;";
            }?>

        </td>
        <td class="text-right"><a href="index.php?route=employees/form&id=<?=$row["id"]?>"><i class="glyphicon glyphicon-edit"></i></a></td>
    </tr>
    <?}?>
    </tbody>
</table>


<script>
    $(function() {
        $('#toggle-info').on('click', function (e) {

            $("#emp-list").find(".toggle-column").toggleClass("hidden");

            var state = $(this).data("state");
            if (state === 0) state = 1; else state = 0;
            $(this).data("state", state);

            $(this).text(((state === 1)?"Показать":"Скрыть") + " доп. информацию");

            return false;
        });
    })
</script>

<?php } else {?>
    <div class="alert alert-info">Данные не найдены</div>
<?}?>
