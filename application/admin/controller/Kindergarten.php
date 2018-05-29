<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;


class Kindergarten extends BaseController
{
	public function index()
	{
		# code...
		$kinder=Db::name('幼儿园信息')->paginate(5);
		$this->assign("kinder",$kinder);
		return $this->fetch();
	}
	public function deletekinder($id)
	{
		if(Db::name("幼儿园信息")->delete($id))
		{
			$admin=Db::name("幼儿园管理员")->where('kid',$id)->find();
			Db::name("幼儿园管理员")->delete($admin);
			$this->success('删除成功');
		}else $this->error('删除失败');
	}
	public function addKinder()
	{
		return $this->fetch('addKinder');
	}
	public function doAddKinder()
	{
		# code..
		$kindername=$_POST["kindername"];
		$kinderadminname=$_POST["kinderadminname"];
		$kinderadminpass=$_POST["kinderadminpass"];
		$kinderadminemail=$_POST["kinderadminemail"];
		$kinderdata=["kname"=>$kindername];
		if(Db::name("幼儿园管理员")->where("kadacc",$kinderadminname)->count()==0){
			if(Db::name("幼儿园信息")->insert($kinderdata)){
				$map['kname']=$kindername;
				$kinder=Db::name("幼儿园信息")->where('kname',$kindername)->select();
			// dump($kinder[0]['kid']);
				$kinderadmindata=["kid"=>$kinder[0]['kid'],"kadacc"=>$kinderadminname,"kadpass"=>md5($kinderadminpass),"email"=>$kinderadminemail];
				if(Db::name("幼儿园管理员")->insert($kinderadmindata)){
					$this->success("添加用户成功",'Kindergarten/index');
				}else{
					$kinder=Db::name("幼儿园信息")->where('kname',$kindername)->delete();
					$this->error("添加用户失败");}
				}else{
					$this->error("添加用户失败");
				}
			}else{
				$this->error("添加用户失败,该用户名已存在");
			}
			}
		}