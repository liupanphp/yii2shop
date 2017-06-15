
<table class="table table-hover">
    <tr>
        <th>日期</th>
        <th>每日新增的商品数量</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->day?></td>
            <td><?=$model->count?></td>
        </tr>
    <?php endforeach;?>
</table>
