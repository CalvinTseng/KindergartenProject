<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class You extends Controller
{
    public function index()
    {
    	return $this->fetch();
      }
}
