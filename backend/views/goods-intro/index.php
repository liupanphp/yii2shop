
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>商品ID</th>
        <th>商品描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->goods_id?></td>
            <td><?=htmlspecialchars(mb_substr($model->content,0,20,'utf-8'))?></td>
            <td>
                <?=\yii\helpers\Html::a('查看商品详情',['goods-intro/look','id'=>$model->id],['class'=>'btn btn-info btn-xs'])?>
                <?=\yii\helpers\Html::a('删除',['goods-intro/del','id'=>$model->id],['class'=>'btn btn-danger btn-xs'])?>
                <?=\yii\helpers\Html::a('编辑',['goods-intro/edit','id'=>$model->id],['class'=>'btn btn-info btn-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\helpers\Html::a('新增文章',['goods-intro/add'],['class'=>'btn btn-info'])?>

