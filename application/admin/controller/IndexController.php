<?php
// 用户后台控制器
// User: tianyu
// Date: 18/3/28
// Time: 下午6:48
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class IndexController extends Controller
{
  //判断SESSION过期时间，30分钟过期
  function session_end()
  {
     $st=config('SESSION_OPTIONS');
	 $bb=time() - session('session_start_time');
	 $cc=$st['expire'];
	  //判断会话是否过期
      if ($bb>=$cc) {
        session_destroy();//真正的销毁在这里！
         return redirect('/admcncp/login');
     }
	 else
	 {
		 //如果有操作，则记录最新时间，这个是为了有操作时，不退出，按最后一次操作的时间来计算，没有操作过30分钟则退出登陆
		 session('session_start_time', time());
	 }
	  
  }
  //管理员列表页面
  public function get_index()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
	  if(session('admin_leixing')==2)
	  {
			return redirect('/admcncp/shanghu/1');  
			exit();
	  }
	  if(session('admin_leixing')==3)
	  {
			return redirect('/admcncp/zhangdan/1/-1/0/0/0/0');  
			exit();
	  }
      $j["sidebar"] = 1; 
	  $sql="SELECT * FROM base_admin order by adm_id asc";
	  $j['list']=Db::query($sql);
	  //return print_r(session(''));
	  //return print_r($j);
      return view('foot_menu',$j);
  }
  //用户新增 页面
  public function get_index_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
      $j["sidebar"] = 1; 
      return view('index_add',$j);
  }
  //用户新增提交处理 
  public function post_index_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  
	  
	$validate = validate('FootMenuController');//实例化 验证器
	if (!$validate->check($data)) {
		$err_id = $validate->getError();
		return show($err_id, $validate->get_message($err_id), [], 200);
	}
	  
	  
	  //Db::execute('insert into think_user (id, name) values (:id, :name)',['id'=>8,'name'=>'thinkphp']);
	  $sql="insert into base_admin (dengluming,mima,xingming,leixing,zhuangtai) VALUES (:dengluming,md5(:mima),:xingming,:leixing,:zhuangtai)";
	  Db::execute($sql,$data);
	  //print_r($data);
	  //print_r(input(''));
	  //$data = ['dengluming' => input('dengluming'), 'mima' => md5(input('mima')), 'xingming' => input('xingming'), 'leixing' => input('leixing'), 'zhuangtai' => input('zhuangtai')];
	  //Db::table('admin')->insert($data);

	  
      $j["sidebar"] = 1; 
	  $sql="SELECT * FROM base_admin order by adm_id asc";
	  $j['list']=Db::query($sql);
	  
      return view('foot_menu',$j);
  }
  //用户编辑页面
  public function get_index_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
      $j["sidebar"] = 1; 
	  $sql="SELECT * FROM base_admin where adm_id='".input('id')."'";
	  $result=Db::query($sql);
	  $j['userinfo']=$result[0];
      return view('index_edit',$j);
  }
  //用户编辑 提交 页面
  public function post_index_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  //print_r($_POST);
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  
	$validate = validate('IndexValidate');//实例化 验证器
	if (!$validate->check($data)) {
		$err_id = $validate->getError();
		return show($err_id, $validate->get_message($err_id), [], 200);
	}
	  
	  
	  //$sql="update admin set dengluming=:dengluming,mima=md5(:mima),xingming=:xingming,leixing=:leixing,zhuangtai=:zhuangtai where adm_id=:id";
	  if($data['mima'])
	  {
	  	$sql="update base_admin set dengluming=:dengluming,mima=md5(:mima),xingming=:xingming,leixing=:leixing,zhuangtai=:zhuangtai where adm_id=:id";
		 Db::execute($sql,$data);
	  }
	  else
	  {
	  	$sql="update base_admin set dengluming='".$data['dengluming']."',xingming='".$data['xingming']."',leixing='".$data['leixing']."',zhuangtai='".$data['zhuangtai']."' where adm_id='".$data['id']."'";
		Db::execute($sql);
	  }
	  //echo $sql;
      $j["sidebar"] = 1; 
	  $sql="SELECT * FROM base_admin order by adm_id asc";
	  $j['list']=Db::query($sql);
	  //return print_r($j);
      return view('foot_menu',$j);
  }
  
  
  







  
  //代理列表页面
  public function get_daili()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
      $j["sidebar"] = 2; 
	  $data=input(); 
	  $data['page']=intval($data['page'])?intval($data['page']):1;
	  $pagesize=30;
	  $page=$data['page'];
	  $start=($page-1)*$pagesize;
      $step=$pagesize;

	  $sqlnum = "select count(*) num from base_daili where dl_type=1 ";
	  $resultnum=Db::query($sqlnum);
	  //print_r($resultnum); exit();
	  //总记录数
	  $data["countnum"] = $resultnum[0]['num'];
	  //总页数
	  $pagenumber=floor($resultnum[0]['num']/$pagesize)+1;
	  $data['countpage']=$pagenumber;
	  //上一页
	  $data['shangpage']=intval($page)>1?intval($page)-1:1;
	  //下一页
	  $data['xiapage']=intval($page)<$pagenumber?intval($page)+1:intval($page);
	  
	  $j["data"] = $data;
	  //print_r($j); exit();
	  
	  
	  $sql="SELECT * FROM base_daili where dl_type=1 order by dl_id desc limit " . $start . ", " . $step;	
	  $j['list']=Db::query($sql);
	  //return print_r(session(''));
	  //print_r($j);exit();
      return view('daili',$j);
  }
  
  //新增代理商 页面
  public function get_daili_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  $j['page']=$data['page'];
      $j["sidebar"] = 2; 
	 //print_r($j);exit();
      return view('daili_add',$j);
  }
  //新增代理商 提交处理 
  public function post_daili_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);exit();
	  $sql="insert into base_daili (dl_type,dl_shangjiID,dl_username,dl_password,dl_phone,dl_email,dl_status,dl_intime) VALUES 
	  ('1','0','".$data['dl_username']."','".md5($data['dl_password'])."','".$data['dl_phone']."','".$data['dl_email']."','".$data['dl_status']."','".time()."')";
	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/daili/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }
  
  //编辑 代理商 页面
  public function get_daili_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  
	  $sql="select * from base_daili where dl_id='".$data['id']."'";
	  $aa=Db::query($sql);  
	  $j['list']=$aa[0];  
	  $j['id']=$data['id'];
	  $j['page']=$data['page'];
      $j["sidebar"] = 2; 
	  //print_r($j);exit();
      return view('daili_edit',$j);
  }
  //编辑代理商 提交处理 
  public function post_daili_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);exit();
	  
	  if($data['dl_password'])
	  {
		 $sql="update base_daili set dl_username='".$data['dl_username']."',dl_password='".md5($data['dl_password'])."',dl_phone='".$data['dl_phone']."',dl_email='".$data['dl_email']."',dl_status='".$data['dl_status']."' where dl_id='".$data['id']."'";  
	  }
	  else
	  {
		 $sql="update base_daili set dl_username='".$data['dl_username']."',dl_phone='".$data['dl_phone']."',dl_email='".$data['dl_email']."',dl_status='".$data['dl_status']."' where dl_id='".$data['id']."'";  
	  }
	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/daili/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }
  
  //二级代理列表页面
  public function get_daili2()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
      $j["sidebar"] = 2; 
	  $data=input(); 
	  //print_r($data);exit();
	  $data['page']=intval($data['page'])?intval($data['page']):1;
	  $pagesize=30;
	  $page=$data['page'];
	  $start=($page-1)*$pagesize;
      $step=$pagesize;

	  $sqlnum = "select count(*) num from base_daili where dl_type=2 and dl_shangjiID='".$data['id']."' ";
	  $resultnum=Db::query($sqlnum);
	  //print_r($resultnum); exit();
	  //总记录数
	  $data["countnum"] = $resultnum[0]['num'];
	  //总页数
	  $pagenumber=floor($resultnum[0]['num']/$pagesize)+1;
	  $data['countpage']=$pagenumber;
	  //上一页
	  $data['shangpage']=intval($page)>1?intval($page)-1:1;
	  //下一页
	  $data['xiapage']=intval($page)<$pagenumber?intval($page)+1:intval($page);
	  
	  $j["data"] = $data;
	  //print_r($j); exit();
	  
	  
	  $sql="SELECT * FROM base_daili where dl_type=2 and dl_shangjiID='".$data['id']."' order by dl_id desc limit " . $start . ", " . $step;	
	  $j['list']=Db::query($sql);
	  //return print_r(session(''));
	  //print_r($j);exit();
      return view('daili2',$j);
  }
  //编辑 二级代理商 页面
  public function get_daili2_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  $sql="select * from base_daili where dl_id='".$data['id']."'";
	  $aa=Db::query($sql);  
	  $j['list']=$aa[0];  
	  $j['id']=$data['id'];
	  $j['upid']=$data['upid'];
	  $j['page']=$data['page'];
      $j["sidebar"] = 2; 
	  //print_r($j);exit();
      return view('daili2_edit',$j);
  }
  //编辑 二级代理商 提交处理 
  public function post_daili2_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);exit();
	  
	  if($data['dl_password'])
	  {
		 $sql="update base_daili set dl_username='".$data['dl_username']."',dl_password='".md5($data['dl_password'])."',dl_phone='".$data['dl_phone']."',dl_email='".$data['dl_email']."',dl_status='".$data['dl_status']."' where dl_id='".$data['id']."'";  
	  }
	  else
	  {
		 $sql="update base_daili set dl_username='".$data['dl_username']."',dl_phone='".$data['dl_phone']."',dl_email='".$data['dl_email']."',dl_status='".$data['dl_status']."' where dl_id='".$data['id']."'";  
	  }
	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/daili2/".$data['upid']."/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }

  //二级代理商的所有会员列表页面
  public function get_daili2_member()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
      $j["sidebar"] = 2; 
	  $data=input(); 
	  //print_r($data);exit();
	  $data['page']=intval($data['page'])?intval($data['page']):1;
	  $pagesize=30;
	  $page=$data['page'];
	  $start=($page-1)*$pagesize;
      $step=$pagesize;

	  $sqlnum = "select count(*) num from base_user where bu_dl_yaoqingma='".$data['yqm']."' ";
	  $resultnum=Db::query($sqlnum);
	  //print_r($resultnum); exit();
	  //总记录数
	  $data["countnum"] = $resultnum[0]['num'];
	  //总页数
	  $pagenumber=floor($resultnum[0]['num']/$pagesize)+1;
	  $data['countpage']=$pagenumber;
	  //上一页
	  $data['shangpage']=intval($page)>1?intval($page)-1:1;
	  //下一页
	  $data['xiapage']=intval($page)<$pagenumber?intval($page)+1:intval($page);
	  
	  $j["data"] = $data;
	  //print_r($j); exit();
	  
	  
	  $sql="SELECT * FROM base_user where bu_dl_yaoqingma='".$data['yqm']."' order by bu_id desc limit " . $start . ", " . $step;	
	  $j['list']=Db::query($sql);
	  //return print_r(session(''));
	 // print_r($j);exit();
      return view('daili2_member',$j);
  }




 



  //公司新闻 列表
  public function get_news_list()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
      $j["sidebar"] = 3; 
	  $data=input(); 
	  $data['page']=intval($data['page'])?intval($data['page']):1;
	  $pagesize=30;
	  $page=$data['page'];
	  $start=($page-1)*$pagesize;
      $step=$pagesize;

	  $sqlnum = "select count(*) num from base_news  ";
	  $resultnum=Db::query($sqlnum);
	  //print_r($resultnum); exit();
	  //总记录数
	  $data["countnum"] = $resultnum[0]['num'];
	  //总页数
	  $pagenumber=floor($resultnum[0]['num']/$pagesize)+1;
	  $data['countpage']=$pagenumber;
	  //上一页
	  $data['shangpage']=intval($page)>1?intval($page)-1:1;
	  //下一页
	  $data['xiapage']=intval($page)<$pagenumber?intval($page)+1:intval($page);
	  
	  $j["data"] = $data;
	  //print_r($j); exit();
	  
	  
	  $sql="SELECT * FROM base_news order by ns_id desc limit " . $start . ", " . $step;	
	  $j['list']=Db::query($sql);
	  $j['imgpath']=config("news_upload_path");
	  //return print_r(session(''));
	  //print_r($j);exit();
      return view('news',$j);
  }
  
  //新增公司新闻 页面
  public function get_news_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
      $j["sidebar"] = 3; 
	 //print_r($j);exit();
      return view('news_add',$j);
  }
  //新增公司新闻 提交处理 
  public function post_news_add()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);
	  //$files = input('FILES');//通过助手将POST所有数据交给 data
	  //print_r($_FILES);
	  
	  
	  // 获取表单上传文件 例如上传了001.jpg
      $imgUp=0;
	  $file = request()->file('ns_img');
	  $imgname = "";
	  // 移动到框架应用根目录/static/uploads/gonggao/ 目录下
      if ($file) 
	  {
		  $info = $file->rule('uniqid')->move(ROOT_PATH . 'public/static/uploads/news/');
		  if ($info) 
		  {
				// 成功上传后 获取上传信息
				// 输出 jpg
 				$imgname = $info->getSaveName();
				$imgUp=1;
          } 
		  else 
		  {
            // 上传失败获取错误信息
            return show(500,"图片上传失败，请重试",[],200);


			
		  }
	  }
	  $data['ns_title']=addslashes($data['ns_title']);
	  $data['ns_descript']=addslashes($data['ns_descript']);
	  if($imgname)
	  {
		  $sql="insert into base_news (ns_language,ns_title,ns_img,ns_intime,ns_descript,ns_content) VALUES 
		  ('".$data['ns_language']."','".$data['ns_title']."','".$imgname."','".time()."','".$data['ns_descript']."','".$data['editor1']."')";
	  }
	  else
	  {
		  $sql="insert into base_news (ns_language,ns_title,ns_intime,ns_descript,ns_content) VALUES 
		  ('".$data['ns_language']."','".$data['ns_title']."','".time()."','".$data['ns_descript']."','".$data['editor1']."')";
	  }
	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/news/1";
	  return redirect($tiaozhuanlujing);
  }
  
  //编辑公司新闻 页面
  public function get_news_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  
	  $sql="select * from base_news where ns_id='".$data['id']."'";
	  $aa=Db::query($sql);  
	  $j['list']=$aa[0];  
	  $j['id']=$data['id'];
	  $j['page']=$data['page'];
	  $j['imgpath']=config("news_upload_path");
      $j["sidebar"] = 3; 
	  //print_r($j);exit();
      return view('news_edit',$j);
  }
  //编辑公司新闻 提交处理 
  public function post_news_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);exit();

	  // 获取表单上传文件 例如上传了001.jpg
      $imgUp=0;
	  $file = request()->file('ns_img');

	  $imgname = "";
	  // 移动到框架应用根目录/static/uploads/banner/ 目录下
      if ($file) 
	  {
		  $info = $file->rule('uniqid')->move(ROOT_PATH . 'public/static/uploads/news/');
		  if ($info) 
		  {
				// 成功上传后 获取上传信息
				// 输出 jpg
 				$imgname = $info->getSaveName();
				$imgUp=1;
          } 
		  else 
		  {
            // 上传失败获取错误信息
            return show(500,"图片上传失败，请重试",[],200);


			
		  }
	  }
	  $data['ns_title']=addslashes($data['ns_title']);
	  $data['ns_descript']=addslashes($data['ns_descript']);
	  if($imgname)
	  {
	  $sql="update base_news set ns_language='".$data['ns_language']."',ns_title='".$data['ns_title']."',ns_img='".$imgname."',ns_descript='".$data['ns_descript']."',ns_content='".$data['editor1']."' where ns_id='".$data['id']."'";  
      }
	  else
	  {
	  $sql="update base_news set ns_language='".$data['ns_language']."',ns_title='".$data['ns_title']."',ns_descript='".$data['ns_descript']."',ns_content='".$data['editor1']."' where ns_id='".$data['id']."'";  
	  }
 	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/news/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }

  //删除公司新闻 页面
  public function get_news_del()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');exit();
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  
	  $sql="delete from base_news where ns_id='".$data['id']."'";
	  Db::query($sql);  
	  $tiaozhuanlujing="/admcncp/news/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }




  //联系我们 列表
  public function get_lxwm_list()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	 
      $j["sidebar"] = 4; 
	  $data=input(); 
	  $data['page']=intval($data['page'])?intval($data['page']):1;
	  $pagesize=30;
	  $page=$data['page'];
	  $start=($page-1)*$pagesize;
      $step=$pagesize;

	  $sqlnum = "select count(*) num from base_lianxiwomen  ";
	  $resultnum=Db::query($sqlnum);
	  //print_r($resultnum); exit();
	  //总记录数
	  $data["countnum"] = $resultnum[0]['num'];
	  //总页数
	  $pagenumber=floor($resultnum[0]['num']/$pagesize)+1;
	  $data['countpage']=$pagenumber;
	  //上一页
	  $data['shangpage']=intval($page)>1?intval($page)-1:1;
	  //下一页
	  $data['xiapage']=intval($page)<$pagenumber?intval($page)+1:intval($page);
	  
	  $j["data"] = $data;
	  //print_r($j); exit();
	  
	  
	  $sql="SELECT * FROM base_lianxiwomen order by lx_id desc limit " . $start . ", " . $step;	
	  $j['list']=Db::query($sql);
	  //$j['imgpath']=config("news_upload_path");
	  //return print_r(session(''));
	  //print_r($j);exit();
      return view('lxwm',$j);
  }

  //编辑联系我们 页面
  public function get_lxwm_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input();//通过助手将POST所有数据交给 data
	  
	  $sql="select * from base_lianxiwomen where lx_id='".$data['id']."'";
	  $aa=Db::query($sql);  
	  $j['list']=$aa[0];  
	  $j['id']=$data['id'];
	  $j['page']=$data['page'];
	  //$j['imgpath']=config("news_upload_path");
      $j["sidebar"] = 4; 
	  //print_r($j);exit();
      return view('lxwm_edit',$j);
  }
  //编辑联系我们 提交处理 
  public function post_lxwm_edit()
  {
	  //判断过期时间
	  $this->session_end();
	  //判断登陆状态
      if (!session('?admin_dengluming')) {
          return redirect('/admcncp/login');
      }
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);exit();

 	  $data['lx_huifang']=addslashes($data['lx_huifang']);
 	  $sql="update base_lianxiwomen set lx_view='1',lx_huifang='".$data['lx_huifang']."' where lx_id='".$data['id']."'";  
  	  Db::execute($sql);
	  
	  $tiaozhuanlujing="/admcncp/lxwm/".$data['page'];
	  return redirect($tiaozhuanlujing);
  }








}
