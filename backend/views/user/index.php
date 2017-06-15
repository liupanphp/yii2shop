
    <table class="table">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>密码</th>
            <th>Email</th>
            <th>状态</th>
            <th>注册时间</th>
            <th>修改时间</th>
            <th>最后登录时间</th>
            <th>最后登录IP</th>
            <th>操作</th>
        </tr>
        <?php foreach($models as $model):?>
            <tr>
                <td><?=$model->id?></td>
                <td><?=$model->username?></td>
                <td><?=$model->password_hash?></td>
                <td><?=$model->email?></td>
                <td><?=$model->status?></td>
                <td><?=date('Y-m-d H:i:s',$model->created_at)?></td>
                <td><?=date('Y-m-d H:i:s',$model->updated_at)?></td>
                <td><?=date('Y-m-d H:i:s',$model->last_time)?></td>
                <td><?=$model->last_ip?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-trash"></span>删除',['user/del','id'=>$model->id],['class'=>'btn btn-default btn-xs'])?>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-edit"></span>编辑',['user/edit','id'=>$model->id],['class'=>'btn btn-default btn-xs'])?>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-edit"></span>修改密码',['user/password'],['class'=>'btn btn-default btn-xs'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
<?=\yii\bootstrap\Html::a('新增',['user/add'],['class'=>'btn btn-info'])?>
