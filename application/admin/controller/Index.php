<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
use app\admin\model\Login;

class Index EXTENDS Controller
{
    public function index()
    {
        Session::clear();
        //方法里面的内容由接下来的视图层页面决定
        if(request()->isPost()){
        	//验证码
        	if(!captcha_check(input('verifycode'))){
        		//验证失败
        		echo "<script>alert('验证码错误');</script>";
        	}else{
            $a=input('adminname');
            $p=input('password');
            $log=new Login;
            //返回值 1 2 3
        	//用户名是否存在
            $result = $log->login($a,$p);
            if($result==1){
                echo "<script>alert('密码错误');</script>";
            }else if($result==2){
                echo "<script>alert('用户不存在');</script>";
            }else{
            $this->redirect('kindergarten/index');
            }        	
        	}
        }
        return $this->fetch();
    }

    public function show_captcha()
    {
    	# code...
    	ob_clean();
    	$captcha = new \think\captcha\Captcha();
    	// $captcha->useZh=true;
    	// $captcha->zhSet="哈哈哈哈";
    	$captcha->codeSet = '0123456789'; 
		$captcha->length   = 2;
		$captcha->useNoise = false;
		return $captcha->entry();
    }
    public function logout()
    {
    	# code...
    	Session::clear();
    	$this->redirect("index/index");
    }
    public function index2()
    {
        return $this->fetch('index2');
    }
}
