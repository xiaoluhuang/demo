<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_ToolkitService.php';
    require_once './common.php';

    class ToolkitServiceTest extends sms_service_ToolkitService{
        function get(){
            $getOperationRecordRequest=new GetOperationRecordRequest();
            $startDate='2016-08-01';
			$endDate='2016-08-08';
			$optLevel=3;
			$optTypes=array();
			$optContents=array();
			$getOperationRecordRequest->setStartDate($startDate);
			$getOperationRecordRequest->setEndDate($endDate);
			$getOperationRecordRequest->setOptLevel($optLevel);
			$getOperationRecordRequest->setOptTypes($optTypes);
			$getOperationRecordRequest->setOptContents($optContents);
            $this->setIsJson(true);
            $response=$this->getOperationRecord($getOperationRecordRequest);
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test toolkit_service begin.#################################\n";
    $testService=new ToolkitServiceTest();
    $testService->get();
    echo "###########################test toolkit_service end.#################################\n";
?>
