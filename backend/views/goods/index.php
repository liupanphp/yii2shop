<?php
$form = \yii\bootstrap\ActiveForm::begin([
    //get方式提交,需要显式指定action
    'method'=>'get',
    'action'=>\yii\helpers\Url::to(['goods/index']),
    'options'=>['class'=>'form-inline'] //样式横着一排
]);
    echo $form->field($model,'name')->textInput(['placeholder'=>'商品名称'])->label(false);
    echo $form->field($model,'sn')->textInput(['placeholder'=>'货号'])->label(false);
    echo $form->field($model,'minPrice')->textInput(['placeholder'=>'最低价￥'])->label(false);
    echo $form->field($model,'maxPrice')->textInput(['placeholder'=>'最高价￥'])->label(false);
    echo \yii\bootstrap\Html::submitButton(' 搜索');

$form = \yii\bootstrap\ActiveForm::end();
?>

<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>货号</th>
        <th>图片</th>
        <th>商品分类id</th>
        <th>品牌分类</th>
        <th>市场价格</th>
        <th>商品价格</th>
        <th>库存</th>
        <th>是否在售</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sn?></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['width'=>50])?></td>
            <td><?=$model->goods_category_id?></td>
            <td><?=$model->brand_id?></td>
            <td><?=$model->market_price?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->stock?></td>
            <td><?=$model->is_on_sale==1?'在售':'下架'?></td>
            <td><?=$model->status==1?'正常':'回收'?></td>
            <td><?=$model->sort?></td>
            <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-picture"></span>相册',['gallery','id'=>$model->id],['class'=>'btn btn-default btn-xs'])?>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-trash"></span>删除',['goods/del','id'=>$model->id],['class'=>'btn btn-default btn-xs'])?>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-edit"></span>编辑',['goods/edit','id'=>$model->id],['class'=>'btn btn-default btn-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\bootstrap\Html::a('新增',['goods/add'],['class'=>'btn btn-info'])?>
<br />
<?=\yii\widgets\LinkPager::widget(['pagination'=>$pager])?>

