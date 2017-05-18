<?php
/**
 * Created by mumu.
 * Date: 2016/12/15
 * Time: 17:11
 */
namespace Home\Controller;
class PrintbillController extends BaseController
{
    public function index()
    {
        $id = $_POST['id'];
        $res = printBill($id);
        $this->ajaxReturn(toJson($res));
    }
}