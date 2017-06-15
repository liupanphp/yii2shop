<?php
/* @var $this yii\web\View */
?>
<h1>aricle/index</h1>

<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>分类</th>
        <th>操作</th>
    </tr>
    <?php foreach($articles as $article):?>
    <tr>
        <td><?=$article->id?></td>
        <td><?=$article->name?></td>
        <td><?=$article->category?$article->category->name:''?></td>
        <td>
            <?=\yii\bootstrap\Html::a('编辑',['article/edit','id'=>$article->id],['class'=>'btn btn-success btn-xs'])?>
            <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$article->id],['class'=>'btn btn-danger btn-xs'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\bootstrap\Html::a('新增',['article/add'],['class'=>'btn btn-info'])?>
    <br/>
<?=\yii\widgets\LinkPager::widget(['pagination'=>$pager])?>