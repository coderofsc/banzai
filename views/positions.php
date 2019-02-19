<?php
if ($data) {?>
<table class="table table-hover table-striped">
    <colgroup>
        <col width="20px" />
        <col width="100px" />
    </colgroup>
    <thead>
    <th>№</th>
    <th>Название</th>
    </thead>
    <tbody>
    <?php
    foreach ($data as $row) {?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["name"]?></td>
        </tr>
    <?}?>
    </tbody>
</table>
<?php } else {?>
    <div class="alert alert-info">Данные не найдены</div>
<?}?>
