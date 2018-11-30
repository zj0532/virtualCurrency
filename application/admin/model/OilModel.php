<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 10:37
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class OilModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'm_oil_fee';
    // 定义时间戳字段名
    protected $createTime = 'of_create';
    protected $updateTime = 'of_update';

    use SoftDelete;
    protected $deleteTime = 'of_del';
}