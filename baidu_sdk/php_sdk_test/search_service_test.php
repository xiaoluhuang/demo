<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_SearchService.php';
    require_once './common.php';

    class SearchServiceTest extends sms_service_SearchService{

        function testGetMaterialInfo(){
            $request=new GetMaterialInfoBySearchRequest();
         	$request->setSearchLevel(0);
         	$request->setSearchType(1);
         	$request->setSearchWord("NBA");
            $this->setIsJson(true);
            $response=$this->getMaterialInfoBySearch($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function testGetCountById(){
        	$request=new GetCountByIdRequest();
        	$request->setCountType(3);
        	
            $this->setIsJson(true);
            $response=$this->getCountById($request);
            
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }

        function testGetTab(){
            $request=new GetTabRequest();
            $tabIds=array(1,2,3,4,5);
            $request->setIdType(11);
            $request->setTabIds($tabIds);
            $response=$this->getTab($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        
    }
	echo "###########################test search_service begin.#################################\n";
    $testService=new SearchServiceTest();
    
    $testService->testGetMaterialInfo();
	$testService->testGetCountById();
    $testService->testGetTab();
    echo "###########################test search_service end.#################################\n";
?>
