<?php
namespace app\index\controller;

use \think\Controller;
use \think\Db;

class You extends Controller
{
    public function index($kid)
    {
    	$aa = Db::name('幼儿园信息')->find($kid);
    	$bb = Db::name('留言')->where('kid',$kid)->select();
    	$this->assign('kcon',$aa);
    	$this->assign('kcon1',$bb);
    	return $this->fetch();
      }
     public function liuyan(){
        $content = input('content');
	  	$data=[	  	      
	  	      'kid'=>input('kid'),
	  	      'codetail'=>$content,
	  	      'codata'=>date('Y-m-d H:i:s')	  	      	  	      
	  	];
	  	
	  	if(Db::name('留言')->insert($data)){
	  		$this->success('发表评论成功');
	  	}else $this->error('发表评论失败');
}

public function jubao($juid){
	
	$con = Db::name('留言')->field('codetail')->find($juid);
	dump($con);
	
	$data = [
	    'jbcon'=>$con['codetail'],
	    'coid'=>$juid
	];
	if(Db::name('举报')->insert($data)){
				$this->success('成功');			
		}else{
			$this->error('失败');
		}
}
}