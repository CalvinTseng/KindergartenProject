<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Play extends BaseController
{
	public function index()
	{
		# code...
		$types=Db::name('游乐场信息')->select();
		$this->assign("types",$types);
		$play=Db::name('游乐场信息')->paginate(5);
		$this->assign("play",$play);
        return $this->fetch();
	}
	public function add(){
		//处理上传
		$file = request()->file('ppic');
    	$pic="";
    // 移动到框架应用根目录/public/uploads/ 目录下
    if($file){
        $info = $file->rule('uniqid')->validate(['size'=>3000000,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'posters');
        if($info){
            $pic=$info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
		
		
		//获取表单数据
//		$pname=input('pname');
		$data=[
			'pname'=>input('pname'),
			'pintro'=>input('pintro'),
			'hittimes'=>0,
			'ppic'=>empty($pic)?"default.jpg":$pic,
			'paddress'=>input('paddress')
		];
		//存入数据库
		if(Db::name('游乐场信息')->insert($data)){
				$this->success('添加游乐场信息成功');			
		}else{
			$this->error('添加添加游乐场信息失败');
		}
	}
	
	public function deleteplay($id)
	{
		if(Db::name("游乐场信息")->delete($id))
	{
		
		$this->success('删除成功');
	}else $this->error('删除失败');
	}
//	public function addPlay()
//	{
//		return $this->fetch('addPlay');
//	}
//	public function doAddPlay()
//	{
//		# code..
//		$playname=$_POST["playname"];
//		$adminname=$_POST["adminname"];
//		$adminpass=$_POST["adminpass"];
//		$playdata=["pname"=>$playname];
//		if(Db::name("幼儿园信息")->insert($playdata)){
//			$map['pname']=$playname;
//			$play=Db::name("幼儿园信息")->where('pname',$playname)->select();
//			// dump($kinder[0]['kid']);
//			$admindata=["pid"=>$play[0]['pid'],"padacc"=>$adminname,"padpass"=>md5($adminpass)];
//			if(Db::name("管理员")->insert($playadmindata)){
//				$this->success("添加用户成功",'Play/index');
//			}else{
//				$play=Db::name("游乐场信息")->where('pname',$playname)->delete();
//				$this->error("添加用户失败");}
//		}else{
//			$this->error("添加用户失败");
//		}
//
//	}
}