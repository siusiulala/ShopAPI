<?php

require_once dirname(__FILE__) . "/../modules/dumpResult.php";

class RecordController extends \Phalcon\Mvc\Controller
{

    public function getAllRecord()
    {
        $data = Record::find();
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['rid'] = $item->rid;
                $result[$i]['bid'] = $item->bid;
                $result[$i]['sid'] = $item->sid;
                $result[$i]['pid'] = $item->pid;
                $result[$i]['count'] = $item->count;
                $result[$i]['date'] = $item->date;
                $i++;
            }

            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

    public function getAfterTime($time)
    {
        $sql = "CALL `sp_get_after_time`('{$time}');";
//        $con = new Phalcon\Db\Adapter\Pdo\Mysql(array(
//            'host' => '192.168.0.119',
//            'username' => 'root',
//            'password' => 'root',
//            'dbname' => 'shop',
//            'charset' => 'utf8'
//        ));
//        $con->connect();
        $result = $this->db->query($sql);
        $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $result = $result->fetchAll($result);

        dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);

    }

    public function newRecord($bid,$sid,$pid,$count,$time)
    {
        $rcd = new Record();
        $rcd->bid = $bid;
        $rcd->sid = $sid;
        $rcd->pid = $pid;
        $rcd->count = $count;
        $rcd->date = $time;
        if ($rcd->create() == false) {
            dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "新增失敗");
            exit();
        }
        // Return 'rid'
        $checkRecord= Record::find(array(
            "bid = '{$bid}' AND " .
            "sid = '{$sid}' AND " .
            "pid = '{$pid}' AND " .
            "count = '{$count}' AND " .
            "date = '{$time}' "
        ));
        // For repeated data
        $lastRcd = $checkRecord->getLast();

        dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL, array(
            "rid" => $lastRcd->rid
        ));
    }


}

