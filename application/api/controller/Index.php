<?php
// 用户后台控制器
// User: tianyu
// Date: 18/3/28
// Time: 下午6:48
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
  
  //api接口 更新余额
  public function post_update()
  {
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);
	  $returnstr=array();
	  if($data['apikey']!=config('API_KEY'))
	  {
	      $returnstr['success']=0;
	      $returnstr['msg']="apikey值错误";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  if(!$data['mt5_account'])
	  {
	      $returnstr['success']=0;
	      $returnstr['msg']="mt5_account不能为空";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  
	  
	  if($data['mt5_balance']<0 || $data['mt5_balance']=="")
	  {
	      $returnstr['success']=0;
	      $returnstr['msg']="mt5_balance不能为空或负数";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  
	  //检查帐户是否存在
	  $sql="select bu_id,bu_yue from base_user where bu_mt5='".$data['mt5_account']."'";
	  $userinfo=Db::query($sql);
	  if(!$userinfo)
	  {
		  $returnstr['success']=0;
	      $returnstr['msg']="mt5_account帐户不存在";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  //print_r($userinfo);
	  //更新帐户余额
	  $upsql="update base_user set bu_yue='".$data['mt5_balance']."' where bu_mt5='".$data['mt5_account']."'";
	  //echo $upsql;
	  if(Db::execute($upsql))
	  {
	      
		  //写入资金流水表
		  $upsqlzijin="insert into base_zijinliusui (`zjls_userid`,`zjls_leixing`,`zjls_jine`,`zjls_qian_yue`,`zjls_hou_yue`,`zjls_time`,`zjls_beizhu`) VALUES 
		  ('".$userinfo[0]['bu_id']."','4','".$data['mt5_balance']."','".$userinfo[0]['bu_yue']."','".$data['mt5_balance']."','".time()."','UPDATE接口POST值为 mt5_account=".$data['mt5_account']."，mt5_balance=".$data['mt5_balance']."')";
		  //echo $upsqlzijin;
		  Db::execute($upsqlzijin);
		  
		  
		  $returnstr['success']=1;
	      $returnstr['msg']="";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	   }
	   else
	   {
	      $returnstr['success']=0;
	      $returnstr['msg']="更新失败，请重试或联系接口负责人，谢谢";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	   }
	  
  }
  //api接口 更新 交易明细
  public function post_trade()
  {
	  $data = input('post.');//通过助手将POST所有数据交给 data
	  //print_r($data);
	  $returnstr=array();
	  if($data['apikey']!=config('API_KEY'))
	  {
	      $returnstr['success']=0;
	      $returnstr['msg']="apikey值错误";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  if(!$data['mt5_account'])
	  {
	      $returnstr['success']=0;
	      $returnstr['msg']="mt5_account不能为空";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  //检查帐户是否存在
	  $sql="select bu_id,bu_yue,bu_dl_yaoqingma from base_user where bu_mt5='".$data['mt5_account']."'";
	  $userinfo=Db::query($sql);
	  if(!$userinfo)
	  {
		  $returnstr['success']=0;
	      $returnstr['msg']="mt5_account帐户不存在";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  }
	  
	  
	  //写入 用户交易记录表
	  $sql_insert_jiaoyi="insert into base_jiaoyijilu (`jyjl_userid`,`jyjl_dl_jiaoyima`,`jyjl_gupiaomingcheng`,`jyjl_leixing`,`jyjl_danjia`,`jyjl_shoushu`,`jyjl_zongjine`,`jyjl_time`,`jyjl_beizhu`) VALUES 
	  ('".$userinfo[0]['bu_id']."','".$userinfo[0]['bu_dl_yaoqingma']."','".$data['shares_name']."','".$data['trade_type']."','".$data['shares_price']."','".$data['shares_number']."','".$data['total_price']."','".time()."','".$data['note']."')";
	  //echo $upsqlzijin;
	  Db::execute($sql_insert_jiaoyi);
	  $jiaoyiID=Db::getLastInsID();
	  //更新帐户余额
	  $upsql="update base_user set bu_yue='".$data['after_balance']."' where bu_mt5='".$data['mt5_account']."'";
	  Db::execute($upsql);
	  
	  //写入资金流水表
	  $upsqlzijin="insert into base_zijinliusui (`zjls_userid`,`zjls_leixing`,`zjls_jine`,`zjls_qian_yue`,`zjls_hou_yue`,`zjls_time`,`zjls_beizhu`) VALUES 
	  ('".$userinfo[0]['bu_id']."','5','".$data['total_price']."','".$data['before_balance']."','".$data['after_balance']."','".time()."','TARDE接口 原本地余额为：".$userinfo[0]['bu_yue']."，发生金额为：".$data['total_price'].",发生前余额为：".$data['before_balance'].",发生后余额为：".$data['after_balance']."')";
	  //echo $upsqlzijin;exit();
	  Db::execute($upsqlzijin);
	  

	  //检查此帐户是否属于某代理商
	  if($userinfo[0]['bu_dl_yaoqingma'])
	  {
		  //查出是哪个代理商
		  $sql_dailishang="select dl_id,dl_lirunbi from base_daili where dl_yaoqingma='".$userinfo[0]['bu_dl_yaoqingma']."'";
		  $dlsinfo=Db::query($sql_dailishang);
		  
		  //写入代理利润表
		  $dl_lirun=abs($data['total_price'])*($dlsinfo[0]['dl_lirunbi']/100);
		  $upsqlzijin="insert into base_daili_lirun (`dllr_jyjl_id`,`dllr_dl_id`,`dllr_lirun`,`dllr_intime`) VALUES 
		  ('".$jiaoyiID."','".$dlsinfo[0]['dl_id']."','".$dl_lirun."','".time()."')";
		  //echo $upsqlzijin;
		  Db::execute($upsqlzijin);
		  
		  $up_dls_yue="update base_daili set dl_yue=dl_yue+".$dl_lirun." where dl_id='".$dlsinfo[0]['dl_id']."'";
		  Db::execute($up_dls_yue);
		  
	  }
	  
		  $returnstr['success']=1;
	      $returnstr['msg']="";
		  $jsonstr=json_encode($returnstr);
		  echo $jsonstr;exit();
	  
	  
  }

  
  
}
