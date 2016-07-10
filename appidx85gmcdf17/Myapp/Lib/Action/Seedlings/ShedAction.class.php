<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/23
 * Time: 10:33
 */
/*----大棚基本信息  start   --------*/
class ShedAction extends Action{
    public function  shed(){
        $seedshed = M('seedshed');
        import('ORG.Util.Page');
        $keywords = $_GET['shedid'];
        $map = "shedid like '%$keywords%'";
        $count = $seedshed->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedshed->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updateshed(){
        $seedshed=M('seedshed');  //选表
        $data['id']=$_POST['id'];
        $data['shedid']=$_POST['shedid'];
        $data['site']=$_POST['site'];
        $data['acreage']=$_POST['acreage'];
        $data['head']=$_POST['head'];
        $count=$seedshed->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/shed');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyshed(){
        $id=$_GET['id'];
        $seedshed=M('seedshed');  //选表
        $arr=$seedshed->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteshed(){
        $seedshed=M('seedshed');  //选表
        $id=$_GET['id'];
        $count=$seedshed->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addshed(){
        $this->display();
    }
    public function insert_database_shed()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'shedid' => $_POST['shedid'],
            'site' => $_POST['site'],
            'acreage' => $_POST['acreage'],
            'head' => $_POST['head'],
        );
        $db = M('seedshed');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/shed');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addshed');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----大棚基本信息  end   --------*/

    /*----大棚土壤信息  start   --------*/
    public function shedsoilinfo(){
        $seedshedsoilinfo = M('seedshedsoilinfo');
        import('ORG.Util.Page');
        $keywords = $_GET['shedid'];
        $map = "shedid like '%$keywords%'";
        $count = $seedshedsoilinfo->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedshedsoilinfo->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updateshedsoil(){
        $seedshedsoilinfo=M('seedshedsoilinfo');  //选表
        $data['id']=$_POST['id'];
        $data['shedid']=$_POST['shedid'];
        $data['soiltemp']=$_POST['soiltemp'];
        $data['soilhumidity']=$_POST['soilhumidity'];
        $data['PH']=$_POST['PH'];
        $data['Electricpile']=$_POST['Electricpil'];
        $data['minerals1']=$_POST['minerals1'];
        $data['minerals2']=$_POST['minerals2'];
        $data['minerals3']=$_POST['minerals3'];
        $data['date']=$_POST['date'];
        $count=$seedshedsoilinfo->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/shedsoilinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyshedsoil(){
        $id=$_GET['id'];
        $seedshedsoilinfo=M('seedshedsoilinfo');  //选表
        $arr=$seedshedsoilinfo->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteshedsoil(){
        $seedshedsoilinfo=M('seedshedsoilinfo');  //选表
        $id=$_GET['id'];
        $count=$seedshedsoilinfo->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addshedsoil(){
        $this->display();
    }
    public function insert_database_shedsoil()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'shedid' => $_POST['shedid'],
            'soiltemp' => $_POST['soiltemp'],
            'soilhumidity' => $_POST['soilhumidity'],
            'PH' => $_POST['PH'],
            'Electricpile' => $_POST['Electricpile'],
            'minerals1' => $_POST['minerals1'],
            'minerals2' => $_POST['minerals2'],
            'minerals3' => $_POST['minerals3'],
            'date' => $_POST['date'],
        );
        $db = M('seedshedsoilinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/shedsoilinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addshedsoil');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----大棚土壤信息  end   --------*/
    /*----大棚室内环境基本信息  start   --------*/
    public function shedindoorinfo(){
        $seedshedindoorinfo = M('seedshedindoorinfo');
        import('ORG.Util.Page');
        $keywords = $_GET['shedid'];
        $map = "shedid like '%$keywords%'";
        $count = $seedshedindoorinfo->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedshedindoorinfo->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updateshedindoor(){
        $seedshedindoorinfo=M('seedshedindoorinfo');  //选表
        $data['id']=$_POST['id'];
        $data['shedid']=$_POST['shedid'];
        $data['lightid']=$_POST['lightid'];
        $data['tempid']=$_POST['tempid'];
        $data['waterid']=$_POST['waterid'];
        $data['gasid']=$_POST['gasid'];
        $data['date']=$_POST['date'];
        $count=$seedshedindoorinfo->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/shedindoorinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifyshedindoor(){
        $id=$_GET['id'];
        $seedshedindoorinfo=M('seedshedindoorinfo');  //选表
        $arr=$seedshedindoorinfo->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deleteshedindoor(){
        $seedshedindoorinfo=M('seedshedindoorinfo');  //选表
        $id=$_GET['id'];
        $count=$seedshedindoorinfo->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addshedindoor(){
        $this->display();
    }
    public function insert_database_shedindoor()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'shedid' => $_POST['shedid'],
            'lightid' => $_POST['lightid'],
            'tempid' => $_POST['tempid'],
            'waterid' => $_POST['waterid'],
            'gasid' => $_POST['gasid'],
            'date' => $_POST['date'],
        );
        $db = M('seedshedindoorinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/shedindoorinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addshedindoor');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----大棚室内环境基本信息  end   --------*/
    /*----光照信息  start   --------*/

    public function lightinfo(){
        $seedlightinfo = M('seedlightinfo');
        import('ORG.Util.Page');
        $keywords = $_GET['lightid'];
        $map = "lightid like '%$keywords%'";
        $count = $seedlightinfo->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedlightinfo->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updatelightinfo(){
        $seedlightinfo=M('seedlightinfo');  //选表
        $data['id']=$_POST['id'];
        $data['lightid']=$_POST['lightid'];
        $data['averagelight']=$_POST['averagelight'];
        $data['lighttime']=$_POST['lighttime'];
        $data['indicators1']=$_POST['indicators1'];
        $data['indicators2']=$_POST['indicators2'];
        $data['date']=$_POST['date'];
        $count=$seedlightinfo->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/lightinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifylightinfo(){
        $id=$_GET['id'];
        $seedlightinfo=M('seedlightinfo');  //选表
        $arr=$seedlightinfo->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deletelightinfo(){
        $seedlightinfo=M('seedlightinfo');  //选表
        $id=$_GET['id'];
        $count=$seedlightinfo->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addlightinfo(){
        $this->display();
    }
    public function insert_database_lightinfo()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'lightid' => $_POST['lightid'],
            'averagelight' => $_POST['averagelight'],
            'lighttime' => $_POST['lighttime'],
            'indicators1' => $_POST['indicators1'],
            'indicators2' => $_POST['indicators2'],
            'date' => $_POST['date'],
        );
        $db = M('seedlightinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/lightinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addlightinfo');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----光照信息  end   --------*/

    /*----温度信息  start   --------*/

    public function tempinfo(){
        $seedtempinfo  = M('seedtempinfo ');
        import('ORG.Util.Page');
        $keywords = $_GET['tempid'];
        $map = "tempid like '%$keywords%'";
        $count = $seedtempinfo ->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,8);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedtempinfo ->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
		$json = json_encode($list);
		$this->assign('count',$count);
		$this->assign('json',$json);
        $this->display(); // 输出模板
    }

    //修改数据
    public function updatetempinfo(){
        $seedtempinfo =M('seedtempinfo ');  //选表
        $data['id']=$_POST['id'];
        $data['tempid']=$_POST['tempid'];
        $data['highesttemp']=$_POST['highesttemp'];
        $data['lowesttemp']=$_POST['lowesttemp'];
        $data['averagetemp']=$_POST['averagetemp'];
        $data['cumulativetemp']=$_POST['cumulativetemp'];
        $data['date']=$_POST['date'];
        $count=$seedtempinfo ->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/tempinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifytempinfo(){
        $id=$_GET['id'];
        $seedtempinfo =M('seedtempinfo ');  //选表
        $arr=$seedtempinfo ->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deletetempinfo(){
        $seedtempinfo =M('seedtempinfo ');  //选表
        $id=$_GET['id'];
        $count=$seedtempinfo ->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addtempinfo(){
        $this->display();
    }
    public function insert_database_tempinfo()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'tempid' => $_POST['tempid'],
            'highesttemp' => $_POST['highesttemp'],
            'lowesttemp' => $_POST['lowesttemp'],
            'averagetemp' => $_POST['averagetemp'],
            'cumulativetemp' => $_POST['cumulativetemp'],
            'date' => $_POST['date'],
        );
        $db = M('seedtempinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/tempinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addtempinfo');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----温度信息  end   --------*/

    /*----水信息  start   --------*/

    public function waterinfo(){
        $seedwaterinfo  = M('seedwaterinfo ');
        import('ORG.Util.Page');
        $keywords = $_GET['waterid'];
        $map = "waterid like '%$keywords%'";
        $count = $seedwaterinfo ->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedwaterinfo ->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updatewaterinfo(){
        $seedwaterinfo =M('seedwaterinfo ');  //选表
        $data['id']=$_POST['id'];
        $data['waterid']=$_POST['waterid'];
        $data['absolutehumidity']=$_POST['absolutehumidity'];
        $data['relativehumidity']=$_POST['relativehumidity'];
        $data['indicators1']=$_POST['indicators1'];
        $data['indicators2']=$_POST['indicators2'];
        $data['date']=$_POST['date'];
        $count=$seedwaterinfo ->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/waterinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifywaterinfo(){
        $id=$_GET['id'];
        $seedwaterinfo =M('seedwaterinfo ');  //选表
        $arr=$seedwaterinfo ->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deletewaterinfo(){
        $seedwaterinfo =M('seedwaterinfo ');  //选表
        $id=$_GET['id'];
        $count=$seedwaterinfo ->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addwaterinfo(){
        $this->display();
    }
    public function insert_database_waterinfo()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'waterid' => $_POST['waterid'],
            'absolutehumidity' => $_POST['absolutehumidity'],
            'relativehumidity' => $_POST['relativehumidity'],
            'indicators1' => $_POST['indicators1'],
            'indicators2' => $_POST['indicators2'],
            'date' => $_POST['date'],
        );
        $db = M('seedwaterinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/waterinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addwaterinfo');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----水信息  end   --------*/

    /*----气信息  start   --------*/

    public function gasinfo(){
        $seedgasinfo  = M('seedgasinfo ');
        import('ORG.Util.Page');
        $keywords = $_GET['gasid'];
        $map = "gasid like '%$keywords%'";
        $count = $seedgasinfo ->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,4);// 实例化分页类 传入总记录数
        $show  = $Page->show();// 分页显示输出
        $list = $seedgasinfo ->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //修改数据
    public function updategasinfo(){
        $seedgasinfo =M('seedgasinfo ');  //选表
        $data['id']=$_POST['id'];
        $data['gasid']=$_POST['gasid'];
        $data['O2 ']=$_POST['O2 '];
        $data['CO2 ']=$_POST['CO2 '];
        $data['indicators1']=$_POST['indicators1'];
        $data['indicators2']=$_POST['indicators2'];
        $data['date']=$_POST['date'];
        $count=$seedgasinfo ->save($data);
        if($count){
            $this->success('数据修改成功','__APP__/Seedlings/Shed/gasinfo');
        }else{
            $this->error('数据修改失败');
        }
    }
    //显示修改页面
    public function modifygasinfo(){
        $id=$_GET['id'];
        $seedgasinfo =M('seedgasinfo ');  //选表
        $arr=$seedgasinfo ->find($id);
        $this->assign('data',$arr);
        $this->display();
    }
    //删除数据
    public function deletegasinfo(){
        $seedgasinfo =M('seedgasinfo ');  //选表
        $id=$_GET['id'];
        $count=$seedgasinfo ->delete($id);
        if($count){
            $this->success('数据删除成功');
        }else{
            $this->error('数据删除失败');
        }
    }
    //显示添加页面
    public function addgasinfo(){
        $this->display();
    }
    public function insert_database_gasinfo()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'gasid' => $_POST['gasid'],
            'O2' => $_POST['O2'],
            'CO2' => $_POST['CO2'],
            'indicators1' => $_POST['indicators1'],
            'indicators2' => $_POST['indicators2'],
            'date' => $_POST['date'],
        );
        $db = M('seedgasinfo');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/gasinfo');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Seedlings/Shed/addgasinfo');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }
    /*----气信息  end   --------*/
}

?>