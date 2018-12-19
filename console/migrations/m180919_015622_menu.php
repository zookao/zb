<?php

use yii\db\Migration;

class m180919_015622_menu extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%menu}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(128) NOT NULL',
            'parent' => 'int(11) NULL',
            'route' => 'varchar(255) NULL',
            'order' => 'int(11) NULL',
            'data' => 'blob NULL',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('parent','{{%menu}}','parent',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_menu_3182_00','{{%menu}}', 'parent', '{{%menu}}', 'id', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%menu}}',['id'=>'1','name'=>'权限相关','parent'=>NULL,'route'=>NULL,'order'=>'10','data'=>'{\"icon\":\"gears\"}']);
        $this->insert('{{%menu}}',['id'=>'2','name'=>'权限分配','parent'=>'1','route'=>'/admin/assignment/index','order'=>NULL,'data'=>'{\"icon\":\"arrows-alt\"}']);
        $this->insert('{{%menu}}',['id'=>'3','name'=>'权限管理','parent'=>'1','route'=>'/admin/permission/index','order'=>NULL,'data'=>'{\"icon\":\"sitemap\"}']);
        $this->insert('{{%menu}}',['id'=>'4','name'=>'菜单管理','parent'=>'1','route'=>'/admin/menu/index','order'=>NULL,'data'=>'{\"icon\":\"tasks\"}']);
        $this->insert('{{%menu}}',['id'=>'5','name'=>'规则管理','parent'=>'1','route'=>'/admin/rule/index','order'=>NULL,'data'=>'{\"icon\":\"plug\"}']);
        $this->insert('{{%menu}}',['id'=>'6','name'=>'角色管理','parent'=>'1','route'=>'/admin/role/index','order'=>NULL,'data'=>'{\"icon\":\"user-circle\"}']);
        $this->insert('{{%menu}}',['id'=>'7','name'=>'路由管理','parent'=>'1','route'=>'/admin/route/index','order'=>NULL,'data'=>'{\"icon\":\"link\"}']);
        $this->insert('{{%menu}}',['id'=>'8','name'=>'用户管理','parent'=>NULL,'route'=>'/user/index','order'=>'1','data'=>'{\"icon\":\"user-o\"}']);
        $this->insert('{{%menu}}',['id'=>'9','name'=>'收藏管理','parent'=>NULL,'route'=>'/favorite/index','order'=>'2','data'=>'{\"icon\":\"star\"}']);
        $this->insert('{{%menu}}',['id'=>'10','name'=>'黑名单管理','parent'=>NULL,'route'=>'/black/index','order'=>'3','data'=>'{\"icon\":\"close\"}']);
        $this->insert('{{%menu}}',['id'=>'11','name'=>'平台管理','parent'=>NULL,'route'=>'/zb-plants/index','order'=>'4','data'=>'{\"icon\":\"youtube-play\"}']);
        $this->insert('{{%menu}}',['id'=>'12','name'=>'主播管理','parent'=>NULL,'route'=>'/zb-lists/index','order'=>'5','data'=>'{\"icon\":\"video-camera\"}']);
        $this->insert('{{%menu}}',['id'=>'13','name'=>'邀请码管理','parent'=>NULL,'route'=>'/invite-code/index','order'=>'6','data'=>'{\"icon\":\"envelope\"}']);
        $this->insert('{{%menu}}',['id'=>'14','name'=>'设置','parent'=>NULL,'route'=>'/settings/default/index','order'=>'7','data'=>'{\"icon\":\"cog\"}']);
        $this->insert('{{%menu}}',['id'=>'15','name'=>'邀请码类型管理','parent'=>NULL,'route'=>'/invite-code-type/index','order'=>'6','data'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%menu}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

