<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
	require_once 'drapisdk_php/sms_service_KeywordService.php';
    require_once './common.php';
    const ADGROUPID =1594131197;
    const MAXPRICE=30;
    const IDTYPE = 11;
    const ISTMP = 0;
    class KeywordServiceTest extends sms_service_KeywordService{

        function add(){
            $request=new AddWordRequest();
            $datas=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                $data=new KeywordType();
                $data->setKeyword(substr(md5(uniqid(mt_rand(), true)),0,29));
                $data->setAdgroupId(ADGROUPID);
                array_push($datas,$data);
            }
            $request->setKeywordTypes($datas);
            $this->setIsJson(true);
            $response=$this->addWord($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function get($datas){
            $request=new GetWordRequest();
            $ids=array();
            $fields=array("keyword", "keywordId");
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->keywordId);
            }
            $request->setIds($ids);
            $request->setWordFields($fields);
            $request->setIdType(IDTYPE);
            $request->setGetTemp(ISTMP);
            $this->setIsJson(true);
            $response=$this->getWord($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
        function update($datas){
            $request=new UpdateWordRequest();
            for($i=0;$i<BEAN_COUNT;$i++){
                $datas[$i]->keyword=substr(md5(uniqid(mt_rand(), true)),0,29);
            }
            $request->setKeywordTypes($datas);
            $this->setIsJson(true);
            $response=$this->updateWord($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $datas;
        }
        function delete($datas){
            $request=new DeleteWordRequest();
            $ids=array();
            for($i=0;$i<BEAN_COUNT;$i++){
                array_push($ids,$datas[$i]->keywordId);
            }
            $request->setKeywordIds($ids);
            $this->setIsJson(true);
            $response=$this->deleteWord($request);
            //echo json_encode($response)."\n";
            $head=$this->getJsonHeader();
            echo "status:".json_encode($head)."\n";
            assert(SUCCESS==$head->desc&&0==$head->status);
            return $response->data;
        }
    }
	echo "###########################test keyword_service begin.#################################\n";
    $testService=new KeywordServiceTest();
    $datas=$testService->add();
    $datas=$testService->get($datas);
    $datas=$testService->update($datas);
    $testService->delete($datas);
    echo "###########################test keyword_service end.#################################\n";
?>
