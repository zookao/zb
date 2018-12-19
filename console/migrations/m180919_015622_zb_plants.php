<?php

use yii\db\Migration;

class m180919_015622_zb_plants extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%zb_plants}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'address' => 'varchar(50) NOT NULL',
            'xinimg' => 'varchar(500) NOT NULL',
            'title' => 'varchar(200) NOT NULL',
            'xianlu' => 'tinyint(4) NOT NULL DEFAULT \'1\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        /* 删除表 */
        $this->dropTable('{{%zb_plants}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

