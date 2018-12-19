<?php

use yii\db\Migration;

class m180919_015622_favorite extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%favorite}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) NOT NULL',
            'list_id' => 'int(11) NOT NULL',
            'xianlu' => 'tinyint(4) NOT NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%favorite}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

