<?php
/**
 * User: guojidong@baidu.com
 * Date: 7/22/15
 * Time: 14:16
 */
    require_once 'drapisdk_php/sms_service_KRService.php';
    require_once './common.php';
    
    echo 'krJob test debug..\n';
    class KRServiceTest extends sms_service_KRService{
    	
    	public $aFileId = "eaa0c088c72fa28d505636f6b3dae276";
    	public $planId = 27850776;
    	
    	function getKRByQueryTest(){
    		$request = new GetKRByQueryRequest();
    		$request->setQueryType(1);
    		$request->setQuery("鲜花");
    		$response = $this->getKRByQuery($request);
    		$head=$this->getJsonHeader();
    		echo "status getKRByQuery:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getKRCustomTest(){
    		$request = new GetKRCustomRequest();
    		$request->setId($this->planId);
    		$request->setIdType(3);
    		$response = $this->getKRCustom($request);
    		$head=$this->getJsonHeader();
    		echo "status getKRCustom:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getEstimatedDataByBidTest(){
    		$request = new GetEstimatedDataByBidRequest();
    		$kret = new KREstimatedType();
    		$kret -> setBid(50);
    		$kret -> setWord("flower");
    		$request ->setWords(array($kret));
    		$response = $this->getEstimatedDataByBid($request);
    		$head=$this->getJsonHeader();
    		echo "status getEstimatedDataByBid:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getEstimatedDataTest(){
    		$request = new GetEstimatedDataRequest();
    		$kret = new KREstimatedType();
    		$kret -> setWord("flower");
    		$request ->setWords(array($kret));
    		$response = $this->getEstimatedData($request);
    		$head=$this->getJsonHeader();
    		echo "status getEstimatedData:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getKRFileIdByWordsTest(){
    		$request = new GetKRFileIdByWordsRequest();
    		$request->setSeedWords(array("鲜花"));
    		$response = $this->getKRFileIdByWords($request);
    		$head=$this->getJsonHeader();
    		echo "status getKRFileIdByWords:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	function getFilePathTest(){
    		$request = new GetKRFileRequestParams();
    		$request ->setFileId($this->aFileId);
    		$response = $this->getFilePath($request);
    		$head=$this->getJsonHeader();
    		echo "status getFilePath:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		return $response->data;
    	}
    	
    	
    	function getFileStatusTest(){
    		$request = new GetFileStatusRequest();
    		$request->setFileId($this->aFileId);
    		$response = $this->getFileStatus($request);
    		$head=$this->getJsonHeader();
    		echo "status getFileStatus:".json_encode($head)."\n";
    		assert(SUCCESS==$head->desc&&0==$head->status);
    		//$this->aFileId = $response->data[0]->fileId;
    		return $response->data;
    	}
    }
    
    echo "###########################test kr_service begin.#################################\n";
    $testService=new KRServiceTest();
//     $datas = $testService->getKRByQueryTest();
//     $datas = $testService ->getKRCustomTest();
//     $datas = $testService -> getEstimatedDataByBidTest();
//     $datas = $testService ->getEstimatedDataTest();
//     $datas = $testService -> getKRFileIdByWordsTest();
//     $datas = $testService -> getFileStatusTest();
//     $datas = $testService -> getFilePathTest();
    $datas = $testService ->getEstimatedDataByBidTest();


    echo "###########################test kr_service end.#################################\n";
    
?>
