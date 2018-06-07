<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Db;
use \think\Session;

class News EXTENDS BaseController
{
	public function index($kid)
	{
		$types=Db::name("幼教资讯")->select();
		$this->assign("types",$types);
		$news=Db::name("幼教资讯")->where("kid",$kid)->select();
		$this->assign('news',$news);
		return	$this->fetch();
	}
    public function edit($kid)
    {
        $news=Db::name("幼教资讯")->where("kid",$kid)->select();
        $this->assign('news',$news);
        return 	$this->fetch();
    }
    public function addNews()
	{
		return $this->fetch('addNews');
	}
    public function doAddNews(){
    	$file = request()->file('npic');
    	$pic="";
    // 移动到框架应用根目录/public/uploads/ 目录下
    if($file){
        $info = $file->rule('uniqid')->validate(['size'=>3000000,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'news');
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
			'ntitle'=>input('ntitle'),
			'kid'=>Session::get("KidForEdit"),
			'narticle'=>input('post.narticle'),
			'nhittimes'=>0,
			'npic'=>empty($pic)?"default.jpg":$pic,
		];
		//存入数据库
		if(Db::name('幼教资讯')->insert($data)){
				$this->redirect('News/index',['kid'=>Session::get("KidForEdit")]);			
		}else{
			$this->error('添加幼教资讯失败');
		}
    }
    
    public function update()
    {
        # code...
        if(request()->isPost()){
            $ntitle=input("param.ntitle");
            $nhittimes=input('param.nhittimes');
            $content = input('post.content');
            $yid=Db::name("幼教资讯")->where("kid",Session::get("KidForEdit"))->find();
            $data=["nid"=>$yid['nid'],"ntitle"=>$ntitle,"kid"=>Session::get("KidForEdit"),"narticle"=>$content,"nhittimes"=>$nhittimes,"npic"=>"1.jpg"];
            if(Db::table("幼教资讯")->update($data)){
                $this->redirect('News/index',['kid'=>Session::get("KidForEdit")]);
            }else{
                $this->error("修改失败");
            }
        }
    }
    public function delete($nid){
        if(Db::name('幼教资讯')->delete($nid))
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }
}