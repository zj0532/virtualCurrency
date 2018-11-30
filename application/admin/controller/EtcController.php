<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27 0027
 * Time: 11:25
 */

namespace app\admin\controller;


use think\Controller;
use think\Paginator;
use think\Request;
use think\Log;
use app\admin\model\EtcModel;

class EtcController extends Controller
{
    private  $etc;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->etc = new EtcModel();
    }

    public function get_etc_list(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        $this->fetch('etc');
    }
}