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

    public function pushIphone()
    {
        $message = $this->request->getPost('msg');

        $passphrase = '123456';
        $deviceToken = '0cdaa9ea3856df9d2cb3f0f6d5679cad3f55a7bcd0103f70fb7ceed2f5c1211f';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/shop/app/config/ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);


        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

// Encode the payload as JSON
        $payload = json_encode($body);

// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
        fclose($fp);

    }
}

