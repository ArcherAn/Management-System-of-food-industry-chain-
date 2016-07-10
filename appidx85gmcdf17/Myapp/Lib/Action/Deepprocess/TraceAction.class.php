<?php
//从产品最后包装的信息溯源整个过程的信息
class TraceAction extends Action {
	public function index(){
		$batchid=$_GET['batchid'];
		
		$trace=M('deepprocess-pastrymaterials');
		$where['batchid'] = $batchid;
		$where['materialtype'] = '大米';
        $arr=$trace->where($where)->find();
		if ( $arr != null ) {
			$riceid = $arr['batch'];//大米编号
			$jinliao = substr($riceid,0,5);//进料编号
			$res = M('processfeed')->where("feedid=$jinliao")->find();
			$outid = $res['picihao'];//出库编号
			$m5=M('warehouseout');
	 		$list= $m5->where("outid=$outid")->find();  	
			$batch=$list['batch'];//入库批次号
			$productionid = substr($batch,1,4);//收割编号
			
			/*育秧种植溯源数据*/
	        $m1=M("plantproduction");
	        $data1=$m1->where("productionid=$productionid")->find();//根据收割编号得到收割信息
	        $m2=M("seedingoperate");
	        $data2=$m2->where("seedingid=$data1[seedid]")->find();//根据收割表与育秧表的秧苗批次号得到育秧信息
	        $m3=M("seeddarkening");
	        $data3=$m3->where("trayid=$data2[trayid]")->find();//根据育秧表与暗化表得到相同托盘批次号的操作信息
	        $m4=M("seedsoakoperate");
	        $data4=$m4->where("seedid=$data3[seedid]")->select();//根据托盘种子表与浸种操作表查到相应种子编号的浸种操作信息(可能有多条)
	        $this->assign('data1',$data1);
	        $this->assign('data2',$data2);
	        $this->assign('data3',$data3);
	        $this->assign('data4',$data4);
	        
	        /*仓储溯源数据*/
			$m6=M('warehousein');//入库信息表
			$data5=$m6->where("putid=$batch")->select();
			
		    $m7=M('warehousein-quality ');//入库质量表
			$data6=$m7->where("warehouseinid=$batch")->select();
			  
			$data7=$m7->table(array(
						'warehousein-quality'=>'a',
	                    'warehousein-property'=>'b' 
	                   ))->where("a.propertyid=b.propertyid  and a.warehouseinid=$batch")
						->field("a.date as date1,b.date as date2,a.*,b.*")->select();//入库理化特性		  
			$data8=$m7->table(array(
	                    'warehousein-quality'=>'a',
	                    'warehousein-nutrition'=>'b' 
	                   ))->where("a.nutritionid=b.nutritionid  and a.warehouseinid=$batch")
					    ->field("a.date as date1,b.date as date2,a.*,b.*")->select();//入库营养特性特性  
						
			$m8=M('warehousemonitor-quality ');//仓库质量特性表
			$data9=$m8->where("warehouseinid=$batch")->select();
			  
			$data10=$m8->table(array(
	                      'warehousemonitor-quality'=>'a',
	                      'warehousemonitor-property'=>'b' 
	                    ))->where("a.propertyid=b.propertyid  and a.warehouseinid=$batch")
						->field("a.date as date1,b.date as date2,a.*,b.*")->select();//仓库理化特性					
			$data11=$m8->table(array(
	                      'warehousemonitor-quality'=>'a',
	                      'warehousemonitor-nutrition'=>'b' 
	                    ))->where("a.nutritionid=b.nutritionid  and a.warehouseinid=$batch")
						->field("a.date as date1,b.date as date2,a.*,b.*")->select();//仓库营养特性表
						
		 	$this->assign('data5',$data5);
			$this->assign('data6',$data6);
	        $this->assign('data7',$data7);
			$this->assign('data8',$data8);
			$this->assign('data9',$data9);
			$this->assign('data10',$data10); 
			$this->assign('data11',$data11); 
			     
			/*加工溯源数据*/
		 	$m9=new Model();
		 	$list= $m9->table(array(
	                      'processfeed '=>'a',
	                      'produce-productinfo'=>'b' 
	                    )
	              )->where("b.feedid=a.feedid and riceid=$riceid")
				  ->field(array('b.riceid','b.feedid'=>'feedid','a.feedid'=>'afeedid','b.finericeid','b.chaffid','b.ricebranid','a.picihao','a.source','a.date'=>'adate','b.date'=>'bdate'))
	           ->find();
		 	$feedid=$list[feedid];//进料编号
	
		 	$m10=M('process-info ');
	     	$info=$m10->where("feedid=$feedid")->find();
	     	$clearid=$info[clearid];
	     	$polishingid=$info[polishingid];
		 	$ridgevalleyid=$info[ridgevalleyid];
		 	$sortoutid=$info[sortoutid];
			 
	    	$m11=M('process-clear');//清理工序
		 	$clear=$m11->where("clearid=$clearid")->find();
		 
		 	$m12=M('process-polishing');//碾米抛光
	     	$polishing=$m12->where("polishingid=$polishingid")->find();
		 
		 	$m13=M('process-ridgevalley ');//垄谷工序
	     	$ridgevalley =$m13->where("ridgevalleyid=$ridgevalleyid")->find();
	 
	     	$m14=M('process-sortout');//成品整理
	     	$sortout=$m14->where("sortoutid=$sortoutid")->find();
	     	
		 	$this->assign('data12',$riceid);
		 	$this->assign('data13',$list);// 赋值数据集
		 	$this->assign('clear',$clear);
		 	$this->assign('ridgevalley',$ridgevalley);
		 	$this->assign('sortout',$sortout);
		 	$this->assign('polishing',$polishing);
		}
		
		/*深加工溯源数据*/
		$where['batchid']=$batchid;
		//外包信息
    	$m15=M('deepprocess-packageinfo');
        $arr=$m15->where($where)->find();
        //注模信息
        $m16=M('deepprocess-zhumo');
        $arr1=$m16->where($where)->find();
        //烘烤信息
        $m17=M('deepprocess-hongkao');
        $arr2=$m17->where($where)->find();
        //脱模信息
        $m18=M('deepprocess-tuomo');
        $arr3=$m18->where($where)->find();
        //冷却/灭菌信息
        $m19=M('deepprocess-sterilization');
        $arr4=$m19->where($where)->find();
        //内包信息
        $m20=M('deepprocess-neibao');
        $arr5=$m20->where($where)->find();
        
        $this->assign('data14',$arr);
        $this->assign('data15',$arr1);
        $this->assign('data16',$arr2);
        $this->assign('data17',$arr3);
        $this->assign('data18',$arr4);
        $this->assign('data19',$arr5);
        $this->display();
	}
}
?>