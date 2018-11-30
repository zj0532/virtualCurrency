<?php
/**
 * Created by PhpStorm.
 * User: administarot
 * Date: 2018/10/28
 * Time: 14:27
 */

namespace app\admin\controller;


use think\Controller;
use app\admin\model\DailyModel;
use think\Log;

class FreeRideController extends Controller
{
    public function get_free_ride_list(){
        try{
            $daily = new DailyModel();
            $list = $daily->order('daily_create desc')->paginate(10);
            $this->assign('list',$list);
            $this->assign('sidebar','2');
        }catch (\Exception $e){
            Log::write($e->getMessage(),'error ');
        }
        return $this->fetch('get_free_ride_list');
    }
}