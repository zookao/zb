<?php

use yii\db\Migration;

class m180919_015622_invite_code extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%invite_code}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'code' => 'char(32) NOT NULL COMMENT \'邀请码\'',
            'status' => 'tinyint(4) NOT NULL COMMENT \'邀请码是否过期，0为没过期，1为已过期\'',
            'type' => 'int(11) NOT NULL DEFAULT \'1\' COMMENT \'邀请码类型\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('invite_code_id_type','{{%invite_code}}','type',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_invite_code_type_3146_00','{{%invite_code}}', 'type', '{{%invite_code_type}}', 'id', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%invite_code}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

