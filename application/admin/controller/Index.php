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
        
        //方法里面的内容由接下来的视图层页面决定
        if(request()->isPost()){
        	//验证码
        	if(!captcha_check(input('verifycode'))){
        		//验证失败
        		echo "<script>alert('验证码错误');</script>";
        	}else{
            $a=input('adminname');
            $p=input('password');
            $t=input('type');
            $log=new Login;
            //返回值 1 2 3
        	//用户名是否存在
            $result = $log->login($a,$p,$t);
            if($result==1){
                echo "<script>alert('密码错误');</script>";
            }else if($result==2){
                echo "<script>alert('用户不存在');</script>";
            }else if($result==3){
            $this->redirect('kindergarten/index');
            }else{
                $kinderaccount=Session::get("adminid");
                $kid=Db::name('幼儿园管理员')->where("kadacc",$kinderaccount)->find();
                $kadid=$kid['kid'];
                $this->redirect('KinderAdmin/index',['kid'=>$kadid]);
                // dump($kid);
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

    public function findpwd(){
    if(request()->isPost()){
       $email=input('email');
            //该邮箱是否存在
       $emailinfo=Db::name("幼儿园管理员")->where("email",$email)->count();
       if($emailinfo){
          $title = "找回密码通知！";
          $srand = rand ( 11111, 99999 );
          $data ['rand'] = $srand;
                Db::name("幼儿园管理员")->where ( "email = '$email'" )->update ( $data ); // 更新数据库
                // echo Db::name("users")->getLastSQL();die();
                $content = "校验码:$srand";

                if (SendMail ( $email, $title, $content )) {
                    $this->success( "发送成功,请到邮箱查看校验码!", url('setpwd',['email'=>$email]) );
                    die ();
                } else {
                    $this->error( $mail->ErrorInfo );
                    die ();
                }
           }else{
              $this->error("邮箱不存在");
          }
            //如果存在，则生成四位随机数，发到该邮箱
      }
      return $this->fetch();
  }


  public function setpwd(){
   if(request()->isPost()){
      $rand=input('rand');
      $newpwd=input('newpwd');
      $dbrand=Db::name("幼儿园管理员")->where("email",session("email"))->find();
            // var_dump($dbrand);
      if($rand!=$dbrand["rand"]){
         $this->error("验证码错误");
     }else{
         Db::name("幼儿园管理员")->where("email",session("email"))->update(["kadpass"=>md5($newpwd)]);
         $this->success('重设密码成功',"index");
     }
 }else{
  $email=input("email");
  session("email",$email);
}
return $this->fetch();
}
}
