<?php

require_once dirname(__FILE__) . "/../modules/dumpResult.php";

class ProductController extends \Phalcon\Mvc\Controller
{

    public function getAllSProduct()
    {
        $data = Product::find();
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['pid'] = $item->pid;
                $result[$i]['name'] = $item->name;
                $result[$i]['stock'] = $item->stock;
                $result[$i]['classify'] = $item->classify;
                $result[$i]['price'] = $item->price;
                $i++;
            }

            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

    public function getByPriceStock($p,$s)
    {
        $data = Product::find(array(
            "price > '{$p}' AND " .
            "stock > '{$s}'"
        ));
        $result = array();
        $i = 0;
        if (count($data) > 0) {
            foreach ($data as $item) {
                $result[$i]['pid'] = $item->pid;
                $result[$i]['name'] = $item->name;
                $result[$i]['stock'] = $item->stock;
                $result[$i]['classify'] = $item->classify;
                $result[$i]['price'] = $item->price;
                $i++;
            }
            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
        }

    }

    public function newProduct($name,$stock,$classify,$price)
    {
        //echo rawurlencode($classify);
        $product = new Product();
        $product->name = $name;
        $product->stock = $stock;
        $product->classify =$classify;
        $product->price = $price;
        if ($product->create() == false) {
            dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "新增失敗");
            exit();
        }
        // Return 'pid'
        $check = Product::findFirst(array(
            "name = '{$name}'"
        ));

        dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL, array(
            "pid" => $check->pid
        ));
    }

    public function deleteProduct($pid)
    {
        $findResult = Product::find([
            "pid = '{$pid}'"
        ]);
        if(count($findResult) > 0) {
            foreach ($findResult as $item) {
                if ($item->delete() == false) {
                    dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "刪除失敗");
                    exit();
                }
            }
            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,"刪除成功");
        }else{
            dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,"沒有可刪除的資料");
        }

    }


}

