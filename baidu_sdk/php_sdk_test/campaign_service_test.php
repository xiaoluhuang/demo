<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_CampaignService.php';
    require_once './common.php';

    class CampaignServiceTest extends sms_service_CampaignService{

        function add(){
            $request=new AddCampaignRequest();
            $datas=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                $data=new CampaignType();
                $data->setCampaignName(substr(md5(uniqid(mt_rand(), true)),0,29));
                array_push($datas,$data);
            }
            $request->setCampaignTypes($datas);
            $this->setIsJson(true);
            $response=$this->addCampaign($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetCampaignRequest();
            $ids=array();
            $fields=array("campaignName", "campaignId");
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->campaignId);
            }
            $request->setCampaignIds($ids);
            $request->setCampaignFields($fields);
            $this->setIsJson(true);
            $response=$this->getCampaign($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateCampaignRequest();
            for($i=0;$i<BEAN_COUNT;$i++){
                $datas[$i]->campaignName=substr(md5(uniqid(mt_rand(), true)),0,29);
                $datas[$i]->budget=8;
            }
            $request->setCampaignTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateCampaign($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteCampaignRequest();
            $ids=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->campaignId);
            }
            $request->setCampaignIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteCampaign($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test campaign_service begin.#################################\n";
    $testService=new CampaignServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    echo "###########################test campaign_service end.#################################\n";
?>
