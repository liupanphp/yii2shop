<table class="cate table table-hover table-bordered">
    <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>上级分类ID</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr data-lft="<?=$model->lft?>" data-rgt="<?=$model->rgt?>" data-tree="<?=$model->tree?>">
            <td><?=$model->id?></td>
            <td><?=str_repeat('一 ',$model->depth).$model->name?><span class="toggle_cate glyphicon glyphicon-chevron-down" style="float: right"></span></td>
            <td><?=$model->parent?$model->parent->name:''?></td>
            <td><?=$model->intro?></td>
            <td>
                <?=\yii\helpers\Html::a('删除',['goods-category/del','id'=>$model->id],['class'=>'btn btn-danger btn-xs'])?>
                <?=\yii\helpers\Html::a('编辑',['goods-category/edit','id'=>$model->id],['class'=>'btn btn-info btn-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\helpers\Html::a('新增',['goods-category/add'],['class'=>'btn btn-info'])?>
<?php
    $js = <<<JS
    $(".toggle_cate").click(function(){

        var tr = $(this).closest('tr');
        var tree = parseInt(tr.attr('data-tree'));
        var lft = parseInt(tr.attr('data-lft'));
        var rgt = parseInt(tr.attr('data-rgt'));
        //显示还是隐藏
        var show = $(this).hasClass('glyphicon-chevron-up');

        //切换图标
        $(this).toggleClass('glyphicon-chevron-down');
        $(this).toggleClass('glyphicon-chevron-up');

        $(".cate tr").each(function(){
            //查找当前分类的子孙分类（根据当前的tree lft rgt）
            //同一颗树  左值大于lft  右值小于rgt
            if(parseInt($(this).attr('data-tree')) == tree && parseInt($(this).attr('data-lft'))>lft && parseInt($(this).attr('data-rgt'))<rgt){
                show?$(this).fadeIn():$(this).fadeOut();
            }
        });
    });
JS;
$this->registerJS($js);
