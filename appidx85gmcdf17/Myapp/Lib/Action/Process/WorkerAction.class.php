<?php
class WorkerAction extends Action{
	
  	public function index(){
		// Model实例化对象 = M(表名);
    	$processworker = M('processworker');
    	// 查询
    	// 分页类
	    import('ORG.Util.Page');
	    $keywords = $_GET['username'];
        $map = "name like '%$keywords%'";
        $count = $processworker->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,8);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $processworker->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	}
    //修改数据
    public function update(){
        $worker=M('processworker');  //选表
		$data['id']=$_POST['id'];
        $data['workid']=$_POST['workid'];
        $data['name']=$_POST['name'];
        $data['sex']=$_POST['sex'];
        $data['age']=$_POST['age'];
        $data['workage']=$_POST['workage'];
        $data['post']=$_POST['post'];
        $data['address']=$_POST['address'];
        $data['telephone']=$_POST['telephone'];
        $count=$worker->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Process/Worker/index");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modify(){
        $id=$_GET['id'];
        $worker=M('processworker');  //选表
        $arr=$worker->find($id);
        $this->assign('data',$arr);
        $this->display();
    }

    //删除数据
    public function delete(){
        $worker=M('processworker');  //选表
        $id=$_GET['id'];
        $count=$worker->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Process/Worker/index');
        }else{
            $this->error('数据删除失败');
        }
    }
    public function create(){
        $m=M('processworker');
        $m->workid=$_POST['username'];
        $m->name=$_POST['name'];
        $m->sex=$_POST['sex'];
        $m->age=$_POST['age'];
        $m->workage=$_POST['workage'];
        $m->post=$_POST['post'];
        $m->address=$_POST['address'];
        $m->telephone=$_POST['telephone'];
        $idnum=$m->add();
        if($idnum>0){
            $this->success('数据添加成功','__APP__/Process/Worker/index');
        }else{
            $this->success('数据添加失败');
        }

    }
    public function add(){
        $this->display();
    }

    public function insert_database(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'workid'=>$_POST['workid'],
            'name'=>$_POST['name'],
            'sex'=>$_POST['sex'],
            'age'=>$_POST['age'],
            'workage'=>$_POST['workage'],
            'post'=>$_POST['post'],
            'address'=>$_POST['address'],
            'telephone'=>$_POST['telephone']
        );
        $db=M('processworker');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Process/Worker/index');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Process/Worker/add');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
}

?>