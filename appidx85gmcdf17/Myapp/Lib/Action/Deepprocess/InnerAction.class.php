<?php

class InnerAction extends Action {
	/************** 注模质检信息 start ******************/
	public function zhumo(){
		$right = getRight(session('user'),'deepprocess-zhumo');
		if ( $right == '0000') {
			$this->error('您没有权限查看,请检查权限配置或用户角色是否正确');
		}else {
	    	$m = M('deepprocess-zhumo');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['batchid'];
	        $map = "batchid like '%$keywords%'";
	        $count = $m->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function updateZhumo(){
        $m=M('deepprocess-zhumo');  //选表
		$data['id']=$_POST['id'];
        $data['batchid']=$_POST['batchid'];
        $data['weight']=$_POST['weight'];
        $data['sensory']=$_POST['sensory'];
        $data['index1']=$_POST['index1'];
        $data['operator']=$_POST['operator'];
        $data['date']=$_POST['date'];
        $count=$m->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Deepprocess/Inner/zhumo");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyZhumo(){
        $id=$_GET['id'];
        $m=M('deepprocess-zhumo');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteZhumo(){
        $m=M('deepprocess-zhumo');
        $id=$_GET['id'];
        $count=$m->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Deepprocess/Inner/zhumo');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addZhumo(){
        $this->display();
    }
    public function insert_database_zhumo(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'batchid'=>$_POST['batchid'],
            'weight'=>$_POST['weight'],
            'sensory'=>$_POST['sensory'],
            'index1'=>$_POST['index1'],
            'operator'=>$_POST['operator'],
            'date'=>$_POST['date']
        );
        $db=M('deepprocess-zhumo');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/zhumo');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/addZhumo');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    /************** 注模质检信息 end ******************/
    /************** 烘烤质检信息 start ******************/
	public function hongkao(){
		$right = getRight(session('user'),'deepprocess-hongkao');
		if ( $right == '0000') {
			$this->error('您没有权限查看');
		}else {
	    	$m = M('deepprocess-hongkao');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['batchid'];
	        $map = "batchid like '%$keywords%'";
	        $count = $m->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function updateHongkao(){
        $m=M('deepprocess-hongkao');  //选表
		$data['id']=$_POST['id'];
        $data['batchid']=$_POST['batchid'];
        $data['index1']=$_POST['index1'];
        $data['index2']=$_POST['index2'];
        $data['index3']=$_POST['index3'];
        $data['operator']=$_POST['operator'];
        $data['date']=$_POST['date'];
        $count=$m->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Deepprocess/Inner/hongkao");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyHongkao(){
        $id=$_GET['id'];
        $m=M('deepprocess-hongkao');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteHongkao(){
        $m=M('deepprocess-hongkao');
        $id=$_GET['id'];
        $count=$m->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Deepprocess/Inner/hongkao');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addHongkao(){
        $this->display();
    }
    public function insert_database_hongkao(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'batchid'=>$_POST['batchid'],
            'index1'=>$_POST['index1'],
            'index2'=>$_POST['index2'],
            'index3'=>$_POST['index3'],
            'operator'=>$_POST['operator'],
            'date'=>$_POST['date']
        );
        $db=M('deepprocess-hongkao');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/hongkao');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/addHongkao');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    /************** 烘烤质检信息 end ******************/
    /************** 脱模质检信息 start ******************/
	public function tuomo(){
		$right = getRight(session('user'),'deepprocess-tuomo');
		if ( $right == '0000') {
			$this->error('您没有权限查看');
		}else {
	    	$m = M('deepprocess-tuomo');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['batchid'];
	        $map = "batchid like '%$keywords%'";
	        $count = $m->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function updateTuomo(){
        $m=M('deepprocess-tuomo');  //选表
		$data['id']=$_POST['id'];
        $data['batchid']=$_POST['batchid'];
        $data['index1']=$_POST['index1'];
        $data['index2']=$_POST['index2'];
        $data['index3']=$_POST['index3'];
        $data['operator']=$_POST['operator'];
        $data['date']=$_POST['date'];
        $count=$m->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Deepprocess/Inner/tuomo");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyTuomo(){
        $id=$_GET['id'];
        $m=M('deepprocess-tuomo');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteTuomo(){
        $m=M('deepprocess-tuomo');
        $id=$_GET['id'];
        $count=$m->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Deepprocess/Inner/tuomo');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addTuomo(){
        $this->display();
    }
    public function insert_database_tuomo(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'batchid'=>$_POST['batchid'],
            'index1'=>$_POST['index1'],
            'index2'=>$_POST['index2'],
            'index3'=>$_POST['index3'],
            'operator'=>$_POST['operator'],
            'date'=>$_POST['date']
        );
        $db=M('deepprocess-tuomo');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/tuomo');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/addTuomo');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    /************** 脱模质检信息 end ******************/
    /************** 冷却/灭菌质检信息 start ******************/
	public function cooling(){
		$right = getRight(session('user'),'deepprocess-sterilization');
		if ( $right == '0000') {
			$this->error('您没有权限查看');
		}else {
	    	$m = M('deepprocess-sterilization');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['batchid'];
	        $map = "batchid like '%$keywords%'";
	        $count = $m->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function updateCooling(){
        $m=M('deepprocess-sterilization');  //选表
		$data['id']=$_POST['id'];
        $data['batchid']=$_POST['batchid'];
        $data['index1']=$_POST['index1'];
        $data['index2']=$_POST['index2'];
        $data['index3']=$_POST['index3'];
        $data['operator']=$_POST['operator'];
        $data['date']=$_POST['date'];
        $count=$m->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Deepprocess/Inner/cooling");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyCooling(){
        $id=$_GET['id'];
        $m=M('deepprocess-sterilization');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteCooling(){
        $m=M('deepprocess-sterilization');
        $id=$_GET['id'];
        $count=$m->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Deepprocess/Inner/cooling');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addCooling(){
        $this->display();
    }
    public function insert_database_cooling(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'batchid'=>$_POST['batchid'],
            'index1'=>$_POST['index1'],
            'index2'=>$_POST['index2'],
            'index3'=>$_POST['index3'],
            'operator'=>$_POST['operator'],
            'date'=>$_POST['date']
        );
        $db=M('deepprocess-sterilization');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/cooling');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/addCooling');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    /************** 冷却/灭菌质检信息 end ******************/
    /************** 内包质检信息 start ******************/
	public function neibao(){
		$right = getRight(session('user'),'deepprocess-neibao');
		if ( $right == '0000') {
			$this->error('您没有权限查看');
		}else {
	    	$m = M('deepprocess-neibao');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['batchid'];
	        $map = "batchid like '%$keywords%'";
	        $count = $m->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,8);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function updateNeibao(){
        $m=M('deepprocess-neibao');  //选表
		$data['id']=$_POST['id'];
        $data['batchid']=$_POST['batchid'];
        $data['index1']=$_POST['index1'];
        $data['index2']=$_POST['index2'];
        $data['index3']=$_POST['index3'];
        $data['operator']=$_POST['operator'];
        $data['date']=$_POST['date'];
        $count=$m->save($data);
        if($count){
            $this->success("数据修改成功","__APP__/Deepprocess/Inner/neibao");
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyNeibao(){
        $id=$_GET['id'];
        $m=M('deepprocess-neibao');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteNeibao(){
        $m=M('deepprocess-neibao');
        $id=$_GET['id'];
        $count=$m->delete($id);
        if($count){
            $this->success('数据删除成功','__APP__/Deepprocess/Inner/neibao');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addNeibao(){
        $this->display();
    }
    public function insert_database_neibao(){
        session_start();
        $id=$_POST['hidden'];
        if($_SESSION['id']!=$id) {return;}
        $data=array(
            'batchid'=>$_POST['batchid'],
            'index1'=>$_POST['index1'],
            'index2'=>$_POST['index2'],
            'index3'=>$_POST['index3'],
            'operator'=>$_POST['operator'],
            'date'=>$_POST['date']
        );
        $db=M('deepprocess-neibao');
        $res=$db->add($data);
        if($res){
        	$ajaxData['info']='数据添加成功';
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/neibao');
        	$ajaxData['status']=1;
        	$this->ajaxReturn($ajaxData,'JSON');
        }else{
        	$ajaxData['url']=U('__APP__/Deepprocess/Inner/addNeibao');
			$ajaxData['info']='数据添加失败';
			$ajaxData['status']=0;
            $this->ajaxReturn($ajaxData,'JSON');
        }
    }
    /************** 内包质检信息 end ******************/
}
?>