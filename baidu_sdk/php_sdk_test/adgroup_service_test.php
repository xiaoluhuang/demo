<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_AdgroupService.php';
    require_once './common.php';
    const CAMPAIGNID=67633301;
    const MAXPRICE=30;
    class AdgroupServiceTest extends sms_service_AdgroupService{

        function add(){
            $request=new AddAdgroupRequest();
            $datas=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                $data=new AdgroupType();
                $data->setAdgroupName(substr(md5(uniqid(mt_rand(), true)),0,29));
                $data->setCampaignId(CAMPAIGNID);
                $data->setMaxPrice(MAXPRICE);
                array_push($datas,$data);
            }
            $request->setAdgroupTypes($datas);
            $this->setIsJson(true);
            $response=$this->addAdgroup($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetAdgroupRequest();
            $ids=array(CAMPAIGNID);
            $fields=array("adgroupName", "adgroupId");
            $request->setIds($ids);
            $request->setAdgroupFields($fields);
            $request->setIdType(3);
            $this->setIsJson(true);
            $response=$this->getAdgroup($request);
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateAdgroupRequest();
            for($i=0;$i<BEAN_COUNT;$i++){
                $datas[$i]->adgroupName=substr(md5(uniqid(mt_rand(), true)),0,29);
            }
            $request->setAdgroupTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateAdgroup($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteAdgroupRequest();
            $ids=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->adgroupId);
            }
            $request->setAdgroupIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteAdgroup($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test adgroup_service begin.#################################\n";
    $testService=new AdgroupServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    echo "###########################test adgroup_service end.#################################\n";
?>
