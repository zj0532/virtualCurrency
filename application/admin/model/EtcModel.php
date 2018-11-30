<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 11:21
 */

namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class EtcModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'm_tec';
    // 定义时间戳字段名
    protected $createTime = 'etc_create';
    protected $updateTime = 'etc_update';

    use SoftDelete;
    protected $deleteTime = 'etc_del';
}