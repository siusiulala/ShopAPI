<?php

class BuyerController extends \Phalcon\Mvc\Controller
{

    public function getAllBuyers()
    {
        $data = Buyer::find();
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
//                $result[$i]['memberID'] = $item->memberID;
//                $result[$i]['type'] = $item->type;

                $i++;
            }

            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

}

