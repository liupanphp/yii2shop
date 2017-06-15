<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170611_075234_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            //
            'name'=>$this->string(50)->notNull()->comment('名称'),
            //简介
            'intro'=>$this->text()->comment('简介'),
            //文章分类id
            'article_category_id'=>$this->text()->comment('文章分类id'),
            //排序
            'sort'=>$this->integer()->comment('排序'),
            //状态
            'status'=>$this->smallInteger(2)->comment('状态'),
            //类型
            'create_time'=>$this->smallInteger(1)->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
