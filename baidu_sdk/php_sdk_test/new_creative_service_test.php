<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_NewCreativeService.php';
    require_once './common.php';
    const BEAN_COUNT_INNER = 1;
    const SUBLINKINFO_COUNT = 3;
    const SUCCESS = "success";
    const ADGROUPID = 2107515390;
    const IDTYPE = 12;
    const IDTYPE_ADGROUP = 5;
    const ISTMP = 0;
    const URL = "https://www.baidu.com";
    class NewCreativeServiceTest extends sms_service_NewCreativeService{

        function add(){
            $request=new AddSublinkRequest();
            $datas=array();
            for($i=0;$i<BEAN_COUNT_INNER;$i++){
                $data=new SublinkType();
                $sublinkInfos=array();
                for ($j = 0; $j < SUBLINKINFO_COUNT; $j++) {
                    $info = new SublinkInfo();
                    $info->setDescription(substr(md5(uniqid(mt_rand(), true)),0,15));
                    $info->setDestinationUrl(URL);
                    array_push($sublinkInfos,$info);
                }
                $data->setSublinkInfos($sublinkInfos);
                $data->setAdgroupId(ADGROUPID);
                $data->setDevice(0);
                array_push($datas,$data);
            }
            $request->setSublinkTypes($datas);
            $this->setIsJson(true);
            $response=$this->addSublink($request);
//             echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetSublinkBySublinkIdRequest();
            $ids=array();
            $fields=array("adgroupId", "sublinkInfos", "sublinkId");
            for($i=0;$i<BEAN_COUNT_INNER;$i++){
                array_push($ids,$datas[$i]->sublinkId);
            }
            $request->setIds($ids);
            $request->setSublinkFields($fields);
            $request->setIdType(IDTYPE);
            $request->setGetTemp(ISTMP);
            $request->setDevice(0);
            $this->setIsJson(true);
            $response=$this->getSublink($request);
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateSublinkRequest();
            for($i=0;$i<BEAN_COUNT_INNER;$i++){
				for($j=0;$j<SUBLINKINFO_COUNT;$j++){
					$datas[$i]->sublinkInfos[$j]->description=substr(md5(uniqid(mt_rand(), true)),0,15);	
				}
            }
            $request->setSublinkTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateSublink($request);
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteSublinkRequest();
            $ids=array();
            for($i=0;$i<BEAN_COUNT_INNER;$i++){
                array_push($ids,$datas[$i]->sublinkId);
            }
            $request->setSublinkIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteSublink($request);
            echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function addPhoneTest(){
            $request=new AddPhoneRequest();
            $phoneTypes=array();
            $phoneType=new PhoneType();
            $phoneType->setPhoneNum("010-23456780");
            $phoneType->setAdgroupId(ADGROUPID);
            array_push($phoneTypes,$phoneType);
            $request->setPhoneTypes($phoneTypes);
            $response=$this->addPhone($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function getPhoneTest($datas){
            $request=new GetPhoneRequest();
            $ids=array();
            $fields=array("phoneId", "phoneNum", "adgroupId");
            array_push($ids,$datas[0]->phoneId);
            $request->setIds($ids);
            $request->setIdType(9);
            $request->setPhoneFields($fields);
            $response=$this->getPhone($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function updatePhoneTest($datas){
            $request=new UpdatePhoneRequest();
            $request->setPhoneTypes($datas);
            $response=$this->updatePhone($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function addBridgeTest(){
            $request=new AddBridgeRequest();
            $bridgeTypes=array();
            $birdge=new BridgeType();
            $birdge->setAdgroupId(ADGROUPID);
            array_push($bridgeTypes,$birdge);
            $request->setBridgeTypes($bridgeTypes);
            $response=$this->addBridge($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function getBridgeTest($datas){
            $request=new GetBridgeRequest();
            $ids=array();
            $fields=array("bridgeId", "adgroupId", "pause");
            array_push($ids,$datas[0]->bridgeId);
            $request->setIds($ids);
            $request->setIdType(5);
            $request->setBridgeFields($fields);
            $response=$this->getBridge($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function updateBridgeTest($datas){
            $request=new UpdateBridgeRequest();
            $request->setBridgeTypes($datas);
            $response=$this->updateBridge($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }

        function getEcallGroupTest(){
            $request = new GetEcallGroupRequest();
            $response = $this->getEcallGroup($request);
            $head = $this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc && 0==$head->status);
            return $response->data;
        }

        function addEcallTestl() {
            $request = new AddEcallRequest();
            $ecallTypes=array();
            $ecall=new EcallType();
            $ecall->setAdgroupId(ADGROUPID);
            $ecall->setEcallGroupId(1395);
            array_push($ecallTypes, $ecall);
            $request->setEcallTypes($ecallTypes);
            $response=$this->addEcall($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }

        function getEcallTest($datas){
            $request=new GetEcallRequest();
            $ids=array();
            $fields=array("ecallId","ecallGroupName");
            array_push($ids,$datas[0]->ecallId);
            $request->setIds($ids);
            $request->setEcallFields($fields);
            $request->setIdType(23);
            $response=$this->getEcall($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }

        function updEcallTest($datas){
            $request=new UpdateEcallRequest();
            $request->setEcallTypes($datas);
            $response=$this->updateEcall($request);
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }

    }
	echo "###########################test new_creative_service begin.#################################\n";
    $testService=new NewCreativeServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    $datas=$testService->addPhoneTest();
    $datas=$testService->getPhoneTest($datas);
    $datas=$testService->updatePhoneTest($datas);
    $datas=$testService->addBridgeTest();

    $datas=$testService->getEcallGroupTest();
    $datas=$testService->addEcallTestl();
    $datas=$testService->getEcallTest($datas);
    $datas=$testService->updEcallTest($datas);
    echo "###########################test new_creative_service end.#################################\n";
?>
