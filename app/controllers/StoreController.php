<?php
require_once dirname(__FILE__) . "/../modules/dumpResult.php";

class StoreController extends \Phalcon\Mvc\Controller
{
    public function getAllStores()
    {
        $data = Store::find();
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['sid'] = $item->sid;
                $result[$i]['name'] = $item->name;
                $result[$i]['address'] = $item->address;
                $result[$i]['tel'] = $item->tel;
                $result[$i]['startTime'] = $item->startTime;
                $result[$i]['endTime'] = $item->endTime;
                $i++;
            }

            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

    public function getStoresByTime($sTime,$eTime)
    {
        $data = Store::find(array(
            "startTime >= '{$sTime}' AND " .
            "endTime <= '{$eTime}'"
        ));
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['sid'] = $item->sid;
                $result[$i]['name'] = $item->name;
                $result[$i]['address'] = $item->address;
                $result[$i]['tel'] = $item->tel;
                $result[$i]['startTime'] = $item->startTime;
                $result[$i]['endTime'] = $item->endTime;
                $i++;
            }
            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

}

