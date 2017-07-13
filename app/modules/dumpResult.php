<?php
/**
 * Created by PhpStorm.
 * User: poter.hsu
 * Date: 2014/11/27
 * Time: 下午 08:31
 */
require_once 'composeResult.php';


function dumpResult($msgCode, $resultCode, $result) {
    echo composeResult($msgCode, $resultCode, $result);
}

