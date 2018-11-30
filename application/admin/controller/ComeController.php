<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 11:30
 */

namespace app\admin\controller;


use think\Controller;
use think\Log;
use app\admin\model\ComeModel;
use think\Request;

class ComeController extends Controller
{
    private $come;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->come = new ComeModel();
    }

    public function get_come_list(){
        try{
            $list = $this->come->order('come_time desc')->paginate(10);
            $this->assign('list',$list);
        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        $this->fetch('come');
    }
}