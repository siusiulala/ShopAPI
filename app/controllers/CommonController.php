<?php

require_once dirname(__FILE__) . "/../modules/dumpResult.php";
class CommonController extends \Phalcon\Mvc\Controller
{

    public function getTotalCount()
    {
        $sql = "CALL `sp_get_total_data_count`();";
        $result = $this->db->query($sql);
        $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $result = $result->fetchAll($result);

        dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL,$result);
    }

    public function uploadImg()
    {
        #check if there is any file
        if($this->request->hasFiles() == true){
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            #do a loop to handle each file individually
            foreach($uploads as $upload){
                #define a “unique” name and a path to where our file must go
                $path = 'uploads/'.md5(uniqid(rand(), true)).'-'.strtolower($upload->getname());
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
            }
            #if any file couldn’t be moved, then throw an message
            if($isUploaded){
                dumpResult(ResultMsgCode::SUCCESS_CALL, ResultStatus::SUCCESS_CALL, "Files successfully uploaded.: ".$path);
            }
            else{
                dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "Some error ocurred.");
            }
        }else{
            #if no files were sent, throw a message warning user
            dumpResult(ResultMsgCode::OTHER_ERROR, ResultStatus::OTHER_ERROR, "No file post.");

        }

    }
}

