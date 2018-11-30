<?php
// 管理员后台 登陆模块
// User: tianyu
// Date: 18/3/23
// Time: 下午2:35
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class LoginController extends Controller
{
  //测试登陆
  public function get_login(){
    //初始为300
    return view('login',["haha" => "huhu123"]);
  }

  //测试登陆
  public function get_register(){
    //初始为300
    return view('register',["haha" => "huhu123"]);
  }

  //登陆
  public function post_login(){
	//初始为300
	$res = ["stat" => "300"];
	
    $data = input('post.');//通过助手将POST所有数据交给 data
	
	$validate = validate('LoginValidate');//实例化 验证器
    if (!$validate->check($data)) {
        $err_id = $validate->getError();
        return show($err_id, $validate->get_message($err_id), [], 200);
    }


	$result = Db::query('SELECT * FROM base_admin WHERE dengluming=:dengluming and mima=md5(:mima) and zhuangtai=1', $data);
	//return $result;
	//$sql="select * from admin where dengluming='".input("ipt_user_id")."'";

    if($result)
	{
        session('admin_id',$result[0]['adm_id']);
        session('admin_dengluming',$result[0]['dengluming']);
        session('admin_xingming',$result[0]['xingming']);
        session('admin_leixing',$result[0]['leixing']);
        session('admin_zhuangtai',$result[0]['zhuangtai']);
		//return print_r(session(''));//打印全部SESSION看
		session('session_start_time', time());//记录会话开始时间！判断会话时间的重点！重点！重点！
		

        return show(200,"登陆成功",[],200);
    }
	else
	{
        return show(300,"登陆失败",[],200);
	}
    
  }

  //退出操作
  public function post_quit(){
    
	session(null);
    $res = ["stat" => "200"];
    return show(200, "退出成功", [], 200);
  }
}
