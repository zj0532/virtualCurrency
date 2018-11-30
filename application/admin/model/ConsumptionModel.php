<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 11:19
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class ConsumptionModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'm_consumption';
    // 定义时间戳字段名
    protected $createTime = 'buy_create';
    protected $updateTime = 'buy_update';

    use SoftDelete;
    protected $deleteTime = 'buy_del';
}