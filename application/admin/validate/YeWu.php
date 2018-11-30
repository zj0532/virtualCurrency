<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/25 0025
 * Time: 13:46
 */

namespace app\admin\validate;


use think\Validate;

class YeWu extends Validate
{
    protected $rule = [
        'content' => 'require',
        'order' => 'require',
        'language' => 'require|alpha|length:2',
        'title' => 'require',
    ];

    protected $message  = [
        'content.require' => '请填写内容',
        'order.require' => '请填写排序',
        'title.require' => '请填写标题',
        'language.require' => '请选择语言',
        'language.alpha'  => '语言格式不正确',
        'language.length' => '语言长度不正确',
    ];
}