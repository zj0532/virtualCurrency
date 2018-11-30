<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/20 0020
 * Time: 17:57
 */

namespace app\admin\validate;

use think\Validate;
class YouShi extends Validate
{
    protected $rule = [
        'you_content' => 'require',
        'you_order' => 'require',
        'you_language' => 'require|alpha|length:2',
        'you_title' => 'require',
    ];

    protected $message  = [
        'you_content.require' => '请填写内容',
        'you_order.require' => '请填写排序',
        'you_title.require' => '请填写标题',
        'you_language.require' => '请选择语言',
        'you_language.alpha'  => '语言格式不正确',
        'you_language.length' => '语言长度不正确',
    ];
}