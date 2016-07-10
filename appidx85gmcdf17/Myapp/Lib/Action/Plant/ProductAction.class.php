<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/1
 * Time: 15:22
 */
class ProductAction extends Action{
    public function production(){
        $db = M('plantproduction');
        import('ORG.Util.Page');
        $keywords = $_GET['farmlandid'];
        $map = "farmlandid like '%$keywords%'";
        $count = $db->where($map)->count(); //查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count, 4);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        $list = $db->where($map)->order('id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('data', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->display(); // 输出模板

    }
    //修改数据
    public function updateProduction()
    {
        $db = M('plantproduction ');  //选表
        $data['id'] = $_POST['id'];
        $data['farmlandid'] = $_POST['farmlandid'];
        $data['productionid'] = $_POST['productionid'];
        $data['seedid'] = $_POST['seedid'];
        $data['production'] = $_POST['production'];
        $data['harvestdate'] = $_POST['harvestdate'];
        $data['head'] = $_POST['head'];
        $count = $db->save($data);
        if ($count) {
            $this->success('数据修改成功', '__APP__/Plant/Product/production');
        } else {
            $this->error('数据修改失败');
        }
    }

//显示修改页面
    public function modifyProduction()
    {
        $id = $_GET['id'];
        $db = M('plantproduction ');  //选表
        $arr = $db->find($id);
        $this->assign('data', $arr);
        $this->display();
    }

//删除数据
    public function deleteProduction()
    {
        $db = M('plantproduction');  //选表
        $id = $_GET['id'];
        $count = $db->delete($id);
        if ($count) {
            $this->success('数据删除成功', '__APP__/Plant/Product/production');
        } else {
            $this->error('数据删除失败');
        }
    }

    public function addProduction()
    {
        $this->display();
    }

    public function insert_database_plantdemand()
    {
        session_start();
        $id = $_POST['hidden'];
        if ($_SESSION['id'] != $id) {
            return;
        }
        $data = array(
            'farmlandid' => $_POST['farmlandid'],
            'productionid' => $_POST['productionid'],
            'seedid' => $_POST['seedid'],
            'production' => $_POST['production'],
            'harvestdate' => $_POST['harvestdate'],
            'head' => $_POST['head'],
        );
        $db = M('plantproduction');
        $res = $db->add($data);
        if ($res) {
            $ajaxData['info'] = '数据添加成功';
            $ajaxData['url'] = U('__APP__/Plant/Product/production');
            $ajaxData['status'] = 1;
            $this->ajaxReturn($ajaxData, 'JSON');
        } else {
            $ajaxData['url'] = U('__APP__/Plant/Product/addProduction');
            $ajaxData['info'] = '数据添加失败';
            $ajaxData['status'] = 0;
            $this->ajaxReturn($ajaxData, 'JSON');
        }
    }

}
?>