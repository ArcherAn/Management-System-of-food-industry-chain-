<?php

class UserAction extends Action {
	public function index(){
		$right = getRight(session('user'),'admin');
		if ( $right == '0000') {
			$this->error('您没有权限查看,请检查权限配置或用户角色是否正确');
		}else {
	    	$m = M('admin');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['name'];
	        $map = "name like '%$keywords%'";
	        $count = $m->join('left join rms_people_role on admin.id=rms_people_role.people_id')
			->join('left join rms_role on rms_people_role.role_id=rms_role.id')
	        ->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->join('left join rms_people_role on admin.id=rms_people_role.people_id')
			->join('left join rms_role on rms_people_role.role_id=rms_role.id')
	        ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function update(){
    	$name = $_POST['name'];
        $role_id = $_POST['role_id'];
        $people_id=$_POST['id'];
        $data['id']=$people_id;
        $data['name']=$name;
        $db=M('admin');
        $res=$db->save($data);
        
        $m = M('rms_people_role');
	    $data1['role_id']=$role_id;
	    $res1=$m->where('people_id='.$people_id)->save($data1);
        $this->success("数据修改成功","__APP__/User/User/index");
    }
    //显示修改页面
    public function modify(){
        $id=$_GET['id'];//人员id
        $m=M('admin');
        $arr=$m->join('left join rms_people_role on admin.id=rms_people_role.people_id')
			->join('left join rms_role on rms_people_role.role_id=rms_role.id')
			->where('admin.id='.$id)->select();
		$m1=M('rms_role');
        $arr1=$m1->select();
        $this->assign('data',$arr);
        $this->assign('data1',$arr1);
        $this->display();
    }
    //删除数据
    public function delete(){
        $m=M('admin');
        $m2=M('rms_people_role');
        $id=$_GET['id'];
        $where['people_id']=$id;
        $count=$m->delete($id);
		$data=$m2->where($where)->delete();//删除用户时，删除rms_people_role该用户的相关记录
        if($count !== false && $data !== false){
            $this->success('数据删除成功','__APP__/User/User/index');
        }else if($count === false){
            $this->error('删除用户失败');
        }else if($data === false){
			 $this->error('删除用户关联角色记录失败');
		}
    }
    //显示添加页面
    public function add(){
    	$m=M('rms_role');
        $arr=$m->select();
        $this->assign('data',$arr);
        $this->display();
    }
    public function insert_database(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $name = $_POST['name'];
        $pwd = $_POST['pwd'];
        $role_id = $_POST['role_id'];
        $data=array(
            'name'=>$name,
            'psw'=>MD5($pwd)
        );
        $db=M('admin');
        $res=$db->add($data);
        
        if($res){
	        $m = M('rms_people_role');
	        $data1=array(
	            'people_id'=>$res,
	            'role_id'=>$role_id
	        );
	        $res1=$m->add($data1);
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/User/User/index');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/User/User/add');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    //修改密码
    public function change(){
    	$this->display();
    }
    
    public function set_pwd(){
    	$pwd1 = $_POST['pwd1'];
        $pwd2 = $_POST['pwd2'];
        $pwd3 = $_POST['pwd3'];
        $id = session('userid');
        
        $m=M('admin');
        $arr=$m->find($id);
        if ( $arr['psw'] == md5($pwd1) ) {
        	$data['psw'] = md5($pwd2);
			$res = $m->where('id='.$id)->save($data);
			if($res){
				$ajaxData['info']='密码修改成功';
	        	$ajaxData['url']=U('__APP__/Seedlings/Load/show');
	        	$ajaxData['status']=1;
	        	$this->ajaxReturn($ajaxData,'JSON');
			}else {
				$ajaxData['info']='密码修改失败';
	        	$ajaxData['url']=U('__APP__/User/User/change');
	        	$ajaxData['status']=0;
	        	$this->ajaxReturn($ajaxData,'JSON');
			}
		}else {
			$ajaxData['info']='原始密码不正确！';
	        $ajaxData['url']=U('__APP__/User/User/change');
	        $ajaxData['status']=0;
	        $this->ajaxReturn($ajaxData,'JSON');
		}
    }
}
?>