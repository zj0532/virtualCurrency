<?php
/**
 * Created by PhpStorm.
 * User: administarot
 * Date: 2018/10/28
 * Time: 14:36
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class DailyModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'base_daily';
    // 定义时间戳字段名
    protected $createTime = 'daily_create';
    protected $updateTime = 'daily_update';

    use SoftDelete;
    protected $deleteTime = 'daily_del';
}