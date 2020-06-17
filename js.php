<?php
    header("Content-Type: application/javascript;charset=UTF-8");
    $newfile = file('http://edgeless.my-file.cn/Socket/Data.txt', FILE_IGNORE_NEW_LINES);
    $json_string = file_get_contents("app.json");
    $data = json_decode($json_string,true);
    //$yestmp = array(); //粗略 行 不用了
    $yes = array(); //细致 2维
    $h = $_GET['h'];
    function isInString2($haystack, $needle) { 
        $array = explode($needle, $haystack); 
        return count($array) > 1; 
    } 
    foreach ($newfile as $num => $v) {
        $v = iconv("GB2312", "UTF-8", $v);
        $i = $data[$h];
        //echo $num." ".$i." ".$v." ";  $v是筛出来的cno索引中的行内容
        if(mb_strpos($v, $i, 0, 'utf-8') !== false){
            $yes[] = explode("_", $v); //打散完了 2维下标：0Name 1Version 2Author 3Category
        }
    }
    for($for = 0; $for < count($yes); $for++){
        echo "document.getElementById('Name".$for."').innerHTML+='".$yes[$for][0]."';";
        echo "document.getElementById('Version".$for."').innerHTML+='".$yes[$for][1]."';";
        echo "document.getElementById('Author".$for."').innerHTML+='".$yes[$for][2]."';";
        echo "document.getElementById('Category".$for."').innerHTML+='".$yes[$for][3]."';";
    }
    //print_r($yes);
    //print count($yes);
?>