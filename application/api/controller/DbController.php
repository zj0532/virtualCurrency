<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:20
 */

namespace app\api\controller;

use think\Controller;
use think\Log;

class DbController extends Controller
{
    public function db(){
        try{

        }catch (\Exception $e){
            Log::write($e->getMessage(),'error');
        }
        return $this->fetch('db');
    }
}