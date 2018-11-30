<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 11:22
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class ComeModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'm_come';
    // 定义时间戳字段名
    protected $createTime = 'come_create';
    protected $updateTime = 'come_update';

    use SoftDelete;
    protected $deleteTime = 'come_del';
}