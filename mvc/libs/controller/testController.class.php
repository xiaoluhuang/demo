<?php
/**
 * Created by PhpStorm.
 * User: huangxiaolu
 * Date: 2017/3/20
 * Time: 下午4:49
 */
class testController
{
    function show(){

        $testModel = new testModel();
        $data = $testModel->get();
        $testView = new tsetView();
        $testView->display($data);

     /*  $testModel = M('test');
        $data = $testModel->get();
        $testView = V('test');
        $testView->display($data);
    */
    }
}