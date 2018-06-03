<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class Yuan extends Controller
{
    public function index()
    {
    	return $this->fetch();
      }
}
