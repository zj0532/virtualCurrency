<?php
namespace app\www\validate;

use think\Validate;

class Contentus extends Validate
{
    protected $rule = [
      'lx_name' => 'require|chsAlpha|length:2,20',
      'lx_email' => 'require|email|length:5,30',
//      'countryid' => 'require|number|length:1,20',
       'lx_county_daima' => 'require|number|length:2,15',
      'lx_language' => 'require|alpha|length:2',
      'lx_phone' => 'require|number|length:1,20',
    ];

    protected $message  = [
          'lx_name.require' => '501',
          'lx_name.chsAlpha'  => '502',
          'lx_name.length' => '503',
          'lx_email.require' => '504',
          'lx_email.email'  => '505',
          'lx_email.length' => '506',
          'lx_county_daima.require' => '507',
          'lx_county_daima.number'  => '508',
          'lx_county_daima.length' => '509',
           'lx_phone.require' => '513',
          'lx_phone.number'  => '514',
          'lx_phone.length' => '515',
          'lx_language.require' => '516',
          'lx_language.alpha'  => '517',
          'lx_language.length' => '518',
//          'countryid.require' => '519',
//          'countryid.number'  => '520',
//          'countryid.length' => '521',
    ];

    public function get_message($err_id)
    {
        $err_text = [
          '501' => '姓名必须填写',
          '502' => '姓名只能是汉字、字母',
          '503' => '姓名的长度 只能在3至20位之间',
          '504' => '邮箱必须填写',
          '505' => '邮箱格式不正确',
          '506' => '邮箱的长度 只能在3至20位之间',
          '507' => '国家ID不正确',
          '508' => '国家ID只能为数字',
          '509' => '国家ID长度不正确',
           '513' => '电话必须填写',
          '514' => '电话只能填数字',
          '515' => '电话长度不正确',
          '516' => '语言不正确',
          '517' => '语言不正确',
          '518' => '语言不正确',
//          '519' => '国家代码不正确',
//          '520' => '国家代码只能为数字',
//          '521' => '国家代码长度不正确',
        ];
        return $err_text[$err_id];
    }
}
