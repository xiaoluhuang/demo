<?php
/**
 * User: linyongqi@baidu.com
 * Date: 12/15/14
 * Time: 14:14
 */
require_once 'drapisdk_php/sms_service_AccountService.php';
require_once './common.php';

class AccountServiceTest extends sms_service_AccountService
{
    function get()
    {
        $getAccountInfoRequest = new GetAccountInfoRequest();

        $fields = array("userId", "cost");
        $getAccountInfoRequest->setAccountFields($fields);
        $this->setIsJson(true);
        $response = $this->getAccountInfo($getAccountInfoRequest);
        echo "the response is: " . json_encode($response) . "\n";
        $head = $this->getJsonHeader();
        echo "status:" . json_encode($head) . "\n";
        assert(SUCCESS == $head->desc && 0 == $head->status);
        return $response->data;
    }

    function update()
    {
        $data = $this->get();
        $data[0]->budget = 789;
        $updateAccountInfoRequest = new UpdateAccountInfoRequest();
        $updateAccountInfoRequest->setAccountInfo($data[0]);
        $response = $this->updateAccountInfo($updateAccountInfoRequest);
        //echo json_encode($response)."\n";
        $head = $this->getJsonHeader();
        echo "status:" . json_encode($head) . "\n";
        assert(SUCCESS == $head->desc && 0 == $head->status);
    }
}

echo "###########################test account_service begin.#################################\n";
$testService = new AccountServiceTest();
$testService->get();
$testService->update();
echo "###########################test account_service end.#################################\n";
?>
