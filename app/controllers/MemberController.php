<?php

require_once dirname(__FILE__) . "/../modules/dumpResult.php";

class MemberController extends \Phalcon\Mvc\Controller
{

    public function getAllMembers()
    {
        $data = Member::find();
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['memberID'] = $item->memberID;
                $result[$i]['type'] = $item->type;
                $i++;
            }

            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

    public function getByPid($pid)
    {
        $sql = "CALL `sp_get_member_type_by_pid`('{$pid}');";
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

}

