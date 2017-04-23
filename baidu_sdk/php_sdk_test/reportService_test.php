<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
  require_once 'drapisdk_php/sms_service_ReportService.php';
    require_once './common.php';
    class ReportServiceTest extends sms_service_ReportService{

        function getRealTimeDataTest(){
           $request=new GetRealTimeDataRequest();
           $type=new ReportRequestType();
           $type->setPerformanceData(array("impression","click","conversion"));
           $type->setLevelOfDetails(2);
           $type->setUnitOfTime(1);
           $type->setReportType(2);
           $type->setStartDate("2015-12-31 12:00:00");
           $type->setEndDate("2016-01-01 12:00:00");
           $request->setRealTimeRequestType($type);
           $response=$this->getRealTimeData($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
          return $response->data;
        }
        function getRealTimeQueryDataTest(){
           $request=new GetRealTimeQueryDataRequest();
           $type=new ReportRequestType();
           $type->setPerformanceData(array("impression","click"));
           $type->setLevelOfDetails(7);
           $type->setUnitOfTime(5);
           $type->setReportType(6);
           $type->setStartDate("2015-12-31 12:00:00");
           $type->setEndDate("2016-01-02 12:00:00");
           $request->setRealTimeQueryRequestType($type);
           $response=$this->getRealTimeQueryData($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
          return $response->data;
        }
        function getRealTimePairDataTest(){
           $request=new GetRealTimePairDataRequest();
           $type=new ReportRequestType();
           $type->setPerformanceData(array("impression","click"));
           $type->setLevelOfDetails(12);
           $type->setUnitOfTime(5);
           $type->setReportType(15);
           $type->setStartDate("2015-12-31 12:00:00");
           $type->setEndDate("2016-01-02 12:00:00");
           $request->setRealTimePairRequestType($type);
           $response=$this->getRealTimePairData($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
          return $response->data;
        }
        function getProfessionalReportIdTest(){
           $request=new GetProfessionalReportIdRequest();
           $type=new ReportRequestType();
           $type->setPerformanceData(array("impression","click"));
           $type->setLevelOfDetails(2);
           $type->setUnitOfTime(1);
           $type->setReportType(2);
           $type->setStartDate("2015-12-01 12:00:00");
           $type->setEndDate("2016-01-02 12:00:00");
           $request->setReportRequestType($type);
           $response=$this->getProfessionalReportId($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
          return $response->data;
        }
        function getReportStateTest(){
           $request=new GetReportStateRequest();
           $request->setReportId("1b187807427215410db2a1023d29bcc0");
           $response=$this->getReportState($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
          return $response->data;
        }
        function getReportFileUrlTest(){
           $request=new GetReportFileUrlRequest();
           $request->setReportId("1b187807427215410db2a1023d29bcc0");
           $response=$this->getReportFileUrl($request);
           $head=$this->getJsonHeader();
           echo "status:".json_encode($head)."\n";
           assert(SUCCESS==$head->desc&&0==$head->status);
           return $response->data;
        }
    }
  echo "###########################test report_service begin.#################################\n";
    $testService=new ReportServiceTest();
//     $datas=$testService->getRealTimeDataTest();
//     $datas=$testService->getRealTimeQueryDataTest();
//     $datas=$testService->getRealTimePairDataTest();
//     $datas=$testService->getProfessionalReportIdTest();
    $datas=$testService->getReportStateTest();
    $datas=$testService->getReportFileUrlTest();
    echo "###########################test report_service end.#################################\n";
?>
