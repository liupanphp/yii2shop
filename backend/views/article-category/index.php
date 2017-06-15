
<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['article-category/edit','id'=>$model->id],['class'=>'btn btn-xs btn-warning'])?>
            <?=\yii\bootstrap\Html::a('删除',['article-category/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?></td>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\bootstrap\Html::a('新增',['article-category/add'],['class'=>'btn btn-info'])?>

