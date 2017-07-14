<?php

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
//die('{"ABC":"success"}');
//var_dump($_FILES);
//exit();

if ($_FILES['file']) {
    // die("ABC");
    $file_ary = reArrayFiles($_FILES['file']);
    $file = 'log.txt';

    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current = date('Y-m-d h:i:s')."-uploadArrayCount-".Count($file_ary)."-"."\r\n";
    file_put_contents($file, $current, FILE_APPEND | LOCK_EX);

    foreach ($file_ary as $file) {

//        print 'File Name: ' . $file['name'];
//        echo "<br>";
//        print 'File Type: ' . $file['type'];
//                echo "<br>";
//        print 'File Size: ' . $file['size'];
//                echo "<br>";
//        print 'File tmp_name: ' . $file['tmp_name'];

        $newFilePath = "images/" . $file['name'];
        $tmpFilePath = $file['tmp_name'];

        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
             $result=array();
             $result["result"]="success";
            echo json_encode($result);

            ImageResize("images/".$file['name'], "trans/".$file['name']);

        }else{
            $result=array();
            $result["result"]="error";
            echo json_encode($result);

        }
    }
}

function ImageResize($from_filename, $save_filename, $in_width=450, $in_height=450, $quality=100)
{
    $allow_format = array('jpeg', 'png', 'gif');
    $sub_name = $t = '';

    // Get new dimensions
    $img_info = getimagesize($from_filename);
    $width    = $img_info['0'];
    $height   = $img_info['1'];
    $imgtype  = $img_info['2'];
    $imgtag   = $img_info['3'];
    $bits     = $img_info['bits'];
    $channels = $img_info['channels'];
    $mime     = $img_info['mime'];

    list($t, $sub_name) = explode('/', $mime);
    if ($sub_name == 'jpg') {
        $sub_name = 'jpeg';
    }

    if (!in_array($sub_name, $allow_format)) {
        return false;
    }

    // 取得縮在此範圍內的比例
    $percent = getResizePercent($width, $height, $in_width, $in_height);
    $new_width  = $width * $percent;
    $new_height = $height * $percent;

    // Resample
    $image_new = imagecreatetruecolor($new_width, $new_height);

    // $function_name: set function name
    //   => imagecreatefromjpeg, imagecreatefrompng, imagecreatefromgif
    /*
    // $sub_name = jpeg, png, gif
    $function_name = 'imagecreatefrom' . $sub_name;

    if ($sub_name=='png')
        return $function_name($image_new, $save_filename, intval($quality / 10 - 1));

    $image = $function_name($from_filename); //$image = imagecreatefromjpeg($from_filename);
    */
    $image = imagecreatefromjpeg($from_filename);

    imagecopyresampled($image_new, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    return imagejpeg($image_new, $save_filename, $quality);
}

/**
 * 抓取要縮圖的比例
 * $source_w : 來源圖片寬度
 * $source_h : 來源圖片高度
 * $inside_w : 縮圖預定寬度
 * $inside_h : 縮圖預定高度
 *
 * Test:
 *   $v = (getResizePercent(1024, 768, 400, 300));
 *   echo 1024 * $v . "\n";
 *   echo  768 * $v . "\n";
 */
function getResizePercent($source_w, $source_h, $inside_w, $inside_h)
{
    if ($source_w < $inside_w && $source_h < $inside_h) {
        return 1; // Percent = 1, 如果都比預計縮圖的小就不用縮
    }

    $w_percent = $inside_w / $source_w;
    $h_percent = $inside_h / $source_h;

    return ($w_percent > $h_percent) ? $h_percent : $w_percent;
}
?>