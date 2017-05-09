<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_DynamicCreativeService.php';
    require_once './common.php';
    const SUCCESS = "success";
    const CAMPAIGNID = 47027155;
    const ADGROUPID=1594131197;
    const IDTYPE = 13;
    const URL = "https://www.baidu.com";
    class DynamicCreativeServiceTest extends sms_service_DynamicCreativeService{

        function add(){
            $request=new AddDynCreativeRequest();
            $dynCreativeFragment=new DynCreativeType();
            $dynCreativeFragment->setCampaignId(CAMPAIGNID);
            $dynCreativeFragment->setAdgroupId(ADGROUPID);
            $dynCreativeFragment->setBindingType(3);
            $dynCreativeFragment->setTitle(substr(md5(uniqid(mt_rand(), true)),0,29));
            $dynCreativeFragment->setUrl(URL);
            $dynCreativeFragment->setMurl(URL);
            $dynCreativeFragments=array();
            array_push($dynCreativeFragments,$dynCreativeFragment);
            $request->setDynCreativeTypes($dynCreativeFragments);
            
            $response=$this->addDynCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetDynCreativeRequest();
            $ids=array();
            $fields=array("dynCreativeId", "campaignId", "adgroupId", "bindingType", "bindingType","url","murl");
            for($i=0;$i<count($datas);$i++){
                array_push($ids,$datas[$i]->dynCreativeId);
            }
            $request->setIds($ids);
            $request->setDynCreativeFields($fields);
            $request->setIdType(IDTYPE);
            $this->setIsJson(true);
            $response=$this->getDynCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateDynCreativeRequest();
            for($i=0;$i<count($datas);$i++){
				$datas[$i]->title=substr(md5(uniqid(mt_rand(), true)),0,29);
            }
            $request->setDynCreativeTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateDynCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteDynCreativeRequest();
            $ids=array();
            for($i=0;$i<count($datas);$i++){
                array_push($ids,$datas[$i]->dynCreativeId);
            }
            $request->setDynCreativeIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteDynCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test dynamic_creative_service begin.#################################\n";
    $testService=new DynamicCreativeServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    echo "###########################test dynamic_creative_service end.#################################\n";
?>
