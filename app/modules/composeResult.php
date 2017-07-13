<?php
/**
 * Created by PhpStorm.
 * User: poter.hsu
 * Date: 2014/11/27
 * Time: 下午 08:31
 */

abstract class ResultMsgCode{
    const SUCCESS_CALL = "A01";
    const ACCOUNT_ERROR = "E03";
    const QUERY_TOKEN_ERROR = "E04";
    const LDAP_TOKEN_ERROR ="E05";
    const OTHER_ERROR = "E09";
    const API_ERROR = "E10";
    const RESULT_NULL = "I01";
    const QUERY_TOKEN_EXPIRED = "I02";
    const LDAP_CONN_ERROR = "E06";
}

abstract class ResultStatus{
    const SUCCESS_CALL = "OK";
    const ACCOUNT_ERROR = "ID type Error";
    const QUERY_TOKEN_ERROR = "QUERY_TOKEN_Illegal";
    const LDAP_TOKEN_ERROR = "LDAP_TOKEN_Illegal";
    const OTHER_ERROR = "Other Error";
    const API_ERROR = "Api Error";
    const RESULT_NULL = 'result_null';
    const QUERY_TOKEN_EXPIRED = "QUERY_Token_Expired";
}

function composeResult($msgCode, $resultCode, $result) {
    return json_encode(array(
        "msgCode" => $msgCode,
        "status" => $resultCode,
        "result" => $result
    ), JSON_UNESCAPED_UNICODE);
}


function cmp_ay( $ar1, $ar2 )
{

    $filename1 = $ar1;
    $filename2 = $ar2;

    $t1 = date ("F d Y H:i:s.", filemtime($filename1));
    $t2= date ("F d Y H:i:s.", filemtime($filename2));

    $la = strtotime($t1);
    $lb = strtotime($t2);

    if ($la<$lb)
        return -1;
    else if ($la>$lb)
        return 1;

    /*if ($ar1['type']<$ar2['type'])
        return -1;
    else if ($ar1['type']>$ar2['type'])
        return 1;*/
    return 0;
}




function composeResultToJsonFile($msgCode, $resultCode, $result,$filename) {
    $t = json_encode($result
    , JSON_UNESCAPED_UNICODE);

    $tDirPath = __DIR__ . "/../assets/phoneExtension/";
    $tPath=$tDirPath.$filename.'.json';
    $fp = fopen($tPath, 'w');

    fwrite($fp, $t);
    fclose($fp);
    return($fp);
}
