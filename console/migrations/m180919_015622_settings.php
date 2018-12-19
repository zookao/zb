<?php

use yii\db\Migration;

class m180919_015622_settings extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%settings}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'type' => 'varchar(255) NOT NULL',
            'section' => 'varchar(255) NOT NULL',
            'key' => 'varchar(255) NOT NULL',
            'value' => 'text NULL',
            'active' => 'tinyint(1) NULL',
            'created' => 'datetime NULL',
            'modified' => 'datetime NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('settings_unique_key_section','{{%settings}}','section, key',1);
        
        
        /* 表数据 */
        $this->insert('{{%settings}}',['id'=>'1','type'=>'integer','section'=>'global','key'=>'days','value'=>'31','active'=>'1','created'=>'2018-08-29 09:11:03','modified'=>'2018-08-29 09:11:50']);
        $this->insert('{{%settings}}',['id'=>'2','type'=>'integer','section'=>'global','key'=>'free_time','value'=>'900','active'=>'1','created'=>'2018-08-31 17:16:53','modified'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%settings}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

