<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6 0006
 * Time: 10:57
 */

namespace app\admin\controller;


use think\Controller;
use think\Log;
use app\admin\model\OilModel;
use think\Request;

class OilFeeController extends Controller
{
    private $oil;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->oil = new OilModel();
    }

    public function get_oilFee_list(){
        try{
            $list = $this->oil->order('of_payment_time desc')->paginate(10);
            $this->assign('list',$list);
            $this->assign('sidebar','3');
        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('oil_fee');
    }
}