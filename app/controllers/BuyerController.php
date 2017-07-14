<?php
require_once dirname(__FILE__) . "/../modules/dumpResult.php";

class BuyerController extends \Phalcon\Mvc\Controller
{

    public function editInfo($bid,$name,$addr)
    {
        $buyer = Buyer::findFirst("bid = '{$bid}'");
        if($buyer==false) {
            dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "Buyer no found");
            exit();
        }

        $buyer->name = $name;
        $buyer->address = $addr;

        if($buyer->update()==false) {
            dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "編輯失敗");
            exit();
        }

        dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,"編輯成功");


    }

}

