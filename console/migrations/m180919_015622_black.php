<?php

use yii\db\Migration;

class m180919_015622_black extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%black}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) NOT NULL',
            'title' => 'varchar(100) NOT NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%black}}',['id'=>'1','user_id'=>'16','title'=>'咪兔']);
        $this->insert('{{%black}}',['id'=>'2','user_id'=>'35','title'=>'约直播']);
        $this->insert('{{%black}}',['id'=>'3','user_id'=>'4','title'=>'蜗牛']);
        $this->insert('{{%black}}',['id'=>'4','user_id'=>'4','title'=>'灰灰']);
        $this->insert('{{%black}}',['id'=>'5','user_id'=>'4','title'=>'偶遇']);
        $this->insert('{{%black}}',['id'=>'6','user_id'=>'4','title'=>'渴望']);
        $this->insert('{{%black}}',['id'=>'7','user_id'=>'4','title'=>'娇喘']);
        $this->insert('{{%black}}',['id'=>'8','user_id'=>'25','title'=>'美夕']);
        $this->insert('{{%black}}',['id'=>'9','user_id'=>'25','title'=>'美人妆']);
        $this->insert('{{%black}}',['id'=>'10','user_id'=>'25','title'=>'偶遇']);
        $this->insert('{{%black}}',['id'=>'11','user_id'=>'25','title'=>'蜗牛']);
        $this->insert('{{%black}}',['id'=>'12','user_id'=>'25','title'=>'灰灰']);
        $this->insert('{{%black}}',['id'=>'13','user_id'=>'50','title'=>'sky']);
        $this->insert('{{%black}}',['id'=>'15','user_id'=>'86','title'=>'幽梦']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%black}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

