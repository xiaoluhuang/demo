<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_CreativeService.php';
    require_once './common.php';
    const BEAN_COUNT = 2;
    const SUCCESS = "success";
    const ADGROUPID =1594131197;
    const IDTYPE = 7;
    const ISTMP = 0;
    const DESC1 = "add_creative_by_requelqi";
    const MODIFY_DESC1 = "modify_creative_by_requelqi";
    const URL = "https://www.baidu.com";
    class CreativeServiceTest extends sms_service_CreativeService{

        function add(){
            $request=new AddCreativeRequest();
            $datas=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                $data=new CreativeType();
                $data->setTitle(substr(md5(uniqid(mt_rand(), true)),0,29));
                $data->setAdgroupId(ADGROUPID);
                $data->setDescription1(DESC1);
                $data->setPcDestinationUrl(URL);
                array_push($datas,$data);
            }
            $request->setCreativeTypes($datas);
            $this->setIsJson(true);
            $response=$this->addCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetCreativeRequest();
            $ids=array();
            $fields=array("title", "creativeId", "description1", "pcDestinationUrl");
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->creativeId);
            }
            $request->setIds($ids);
            $request->setCreativeFields($fields);
            $request->setIdType(IDTYPE);
            $request->setGetTemp(ISTMP);
            $this->setIsJson(true);
            $response=$this->getCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateCreativeRequest();
            for($i=0;$i<BEAN_COUNT;$i++){
                $datas[$i]->title=substr(md5(uniqid(mt_rand(), true)),0,29);
                $datas[$i]->description1=MODIFY_DESC1;
            }
            $request->setCreativeTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteCreativeRequest();
            $ids=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->creativeId);
            }
            $request->setCreativeIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteCreative($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test creative_service begin.#################################\n";
    $testService=new CreativeServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    echo "###########################test creative_service end.#################################\n";
?>
