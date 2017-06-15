<table class="table table-bordered table-responsive">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>LOGO</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->logo?\yii\bootstrap\Html::img($model->logo,['height'=>25]):''?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$model->id],['class'=>'btn btn-xs btn-warning'])?>
            <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$model->id],['class'=>'btn btn-xs btn-danger'])?></td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\bootstrap\Html::a('新增',['brand/add'],['class'=>'btn btn-info'])?>
<br/>
<?=\yii\widgets\LinkPager::widget(['pagination'=>$pager]);?>
