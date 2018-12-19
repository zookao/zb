<?php

use yii\db\Migration;

class m180919_015622_zb_lists extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%zb_lists}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'plant_id' => 'int(11) NOT NULL',
            'title' => 'varchar(200) NOT NULL',
            'address' => 'varchar(500) NOT NULL',
            'img' => 'varchar(500) NOT NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        $this->createIndex('plant_id','{{%zb_lists}}','plant_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%zb_lists}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

