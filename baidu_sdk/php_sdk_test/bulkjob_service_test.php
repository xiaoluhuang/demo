<?php
/**
 * User: guojidong@baidu.com
 * Date: 7/22/15
 * Time: 14:16
 */
    require_once 'drapisdk_php/sms_service_BulkJobService.php';
    require_once './common.php';
    
    echo 'bulkJob test debug..\n';
    class BulkJobServiceTest extends sms_service_BulkJobService{
    	
    	public $aFileId = "b1e0d101c3b1d3baab3e9ff0bd04c5d3";
    	
    	function getAllObjectsTest(){
    		$request = new GetAllObjectsRequest();
    		$request->setAccountFields(array("all"));
    		$request->setCampaignIds(null);
    		$response = $this->getAllObjects($request);
    		$head=$this->getJsonHeader();
    		echo "status getAllObjects:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		$this->aFileId = $response->data[0]->fileId;   //测试脚本共用一个文件id
    		return $response->data;
    	}
    	
    	function GetAllChangedObjectsTest(){
    		$request = new GetAllChangedObjectsRequest();
    		$request->setAccountFields(array("all"));
			$request->setCampaignFields(array("all"));
    		$request->setCampaignIds(array(67633301));
    		$request->setStartTime("2016-08-25 12:00:00");
    		$response = $this->getAllChangedObjects($request);
    		$head=$this->getJsonHeader();
    		echo "status GetAllChangedObjects:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getUserCacheTest(){
    		$request = new GetUserCacheRequest();
    		$request->setFileId($this->aFileId);        //找一个存在的
    		$response = $this->getUserCache($request);
    		$head=$this->getJsonHeader();
    		echo "status getUserCache:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getFilePathTest(){
    		$request = new GetFilePathRequest();
    		$request->setFileId($this->aFileId);        //找一个存在的
    		$response = $this->getFilePath($request);
    		$head=$this->getJsonHeader();
    		echo "status getFilePath:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getFileStatusTest(){
    		$request = new GetFileStatusRequest();
    		$request->setFileId($this->aFileId);        //找一个存在的
    		$response = $this->getFileStatus($request);
    		$head=$this->getJsonHeader();
    		echo "status getFileStatus:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function cancelDownloadTest(){
    		$request = new CancelDownloadRequest();
    		$request->setFileId($this->aFileId);        //找一个存在的
    		$response = $this->cancelDownload($request);
    		$head=$this->getJsonHeader();
    		echo "status cancelDownload:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getChangedItemIdTest(){
    		$request = new GetChangedItemIdRequest();
    		$request->setIds(array(67633301));
    		$request->setType(3);
    		$request->setItemType(5);
    		$request->setStartTime("2016-08-25 12:00:00");
    		$response = $this->getChangedItemId($request);
    		$head=$this->getJsonHeader();
    		echo "status getChangedItemId:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getChangedIdTest(){
    		$request = new GetChangedIdRequest();
			$request->setCampaignLevel(true);
			$request->setAdgroupLevel(true);
			$request->setKeywordLevel(true);
    		$request->setStartTime("2016-08-25 12:00:00");
    		$response = $this->getChangedId($request);
    		$head=$this->getJsonHeader();
    		echo "status getChangedId:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    	}
    	
    	function getChangedScaleTest(){
    		$request = new GetChangedScaleRequest();
    		$request->setCampaignIds(array(67633301));
    		$request->setChangedCampaignScale(true);
    		$request->setChangedAdgroupScale(true);
    		$request->setChangedKeywordScale(true);
    		$request->setStartTime("2016-08-25 12:00:00");
    		$response = $this->getChangedScale($request);
    		$head=$this->getJsonHeader();
    		echo "status getChangedScale:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    	}
    	
    }
    
    echo "###########################test bulkjob_service begin.#################################\n";
    $testService=new BulkJobServiceTest();
    $datas=$testService->getAllObjectsTest();
    $datas = $testService ->getAllChangedObjectsTest();

    $datas = $testService ->getFilePathTest();
    $datas = $testService -> getFileStatusTest();
    $datas = $testService -> getUserCacheTest();
    $datas = $testService -> cancelDownloadTest();

    $datas = $testService -> getChangedItemIdTest();
    $datas = $testService -> getChangedIdTest();
    $datas = $testService -> getChangedScaleTest();
    echo "###########################test bulkjob_service end.#################################\n";
      
?>
