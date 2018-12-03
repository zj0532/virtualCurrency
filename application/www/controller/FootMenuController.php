<?php
namespace app\www\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Log;

class FootMenuController extends Controller
{
    //公告中心
    public function notice(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('noticess');
    }
    //使用条款
    public function terms_of_use(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('terms_of_use');
    }
    //隐私条款
    public function privacy(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('privacy');
    }
    //费率说明
    public function rate(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('rate');
    }
    //充值多久到账
    public function account(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('account');
    }
    //交易指南
    public function transaction(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('transaction');
    }
    //常见问题
    public function common(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('common');
    }
}
