<?php
class PermitAction extends Action {
	public function index(){
		$right = getRight(session('user'),'rms_right_role_tables');
		if ( $right == '0000') {
			$this->error('您没有权限查看,请检查权限配置或用户角色是否正确');
		}else {
	    	$m = M('rms_right_role_tables');
	    	// 分页查询
		    import('ORG.Util.Page');
		    $keywords = $_GET['name'];
	        $map = "role_name like '%$keywords%'";
	        $count = $m->join('rms_role ON rms_right_role_tables.role_id = rms_role.id')
	                   ->join('rms_tables ON rms_right_role_tables.table_id = rms_tables.id')
	                   ->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
	        $Page = new Page($count,10);// 实例化分页类 传入总记录数
	        $show  = $Page->show();// 分页显示输出
	        $list = $m->field('rms_right_role_tables.id,role_name,right_id,desc')
	        		   ->join('rms_role ON rms_right_role_tables.role_id = rms_role.id')
	                   ->join('rms_tables ON rms_right_role_tables.table_id = rms_tables.id')
	                   ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
	        $this->assign('data',$list);// 赋值数据集
	        $this->assign('page',$show);// 赋值分页输出
	        $this->assign('right',$right);// 赋值权限
	        $this->display();
		}
	}
    //修改数据
    public function update(){
        $m=M('rms_right_role_tables');  //选表
		$data['id']=$_POST['id'];
		$tmp=$_POST['check1'].$_POST['check2'].$_POST['check3'].$_POST['check4'];
		$data['right_id']=$tmp;
        $count=$m->save($data);
        if($count){
            $this->success("权限修改成功","__APP__/User/Permit/index");
        }else{
            $this->error('权限修改失败');
        }
    }
    //显示修改页面
    public function modify(){
        $id=$_GET['id'];
        $m=M('rms_right_role_tables');
        $arr=$m->find($id);
        $this->assign('data',$arr);
        $this->assign('role_name',$_GET['role_name']);
        $this->assign('desc',$_GET['desc']);
        $this->display();
    }
}
?>