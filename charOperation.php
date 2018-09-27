<?php

//补足位数
function fillString($strOriginal){
  if (strlen($strOriginal) % 8 == 0) {
    $str8Times = $strOriginal;
  }else {
    $str8Times = $strOriginal;
    $remainder = strlen($strOriginal) % 8;
    for ($i=0; $i < 8 - $remainder; $i++) {
      $str8Times = $str8Times."0";
    }
  }
  return $str8Times;
}

//分解行
function splitRows($strOriginal){
  $arr = Array();
  $strTmp = bin2hex($strOriginal);
  $arrTmp = explode("0d0a",$strTmp);
  foreach ($arrTmp as $element) {
    $rowWithoutLC = hex2bin($element);
    array_push($arr,$rowWithoutLC);
  }
  return $arr;
}

//行补足
function fillRows($arr){
  $arrReturn = Array();
  foreach ($arr as $tmp) {
    array_push($arrReturn,fillString($tmp));
  }
  return $arrReturn;
}


function str2Bin($arr){
  $arrTmp = Array();
  foreach ($arr as $tmp) {
    array_push($arrTmp,strToBin($tmp));
  }
  return $arrTmp;
}

/**
 * 将字符串转换成二进制
 * @param type $str
 * @return type
 */
 function strToBin($str){
   //1.列出每个字符
   $arr = preg_split('/(?<!^)(?!$)/u', $str);
   //2.unpack字符
   foreach($arr as &$v){
       //
       $temp = unpack('H*', $v);

       $v = base_convert($temp[1], 16, 2);
       //echo("<script>console.log(' 16-2 :" . $v . "');</script>");

       $v = str_pad($v,8,"0",STR_PAD_LEFT);
       //echo("<script>console.log(' 2+0  :" . $v . "');</script>");

       unset($temp);
   }
   return join('',$arr);
 }

 function rowInSBox($num1,$num2){
   return $num1 * 2 + $num2;
 }

function colInSBox($num1,$num2,$num3,$num4){
  return $num1 * 8 + $num2 * 4 + $num3 * 2 + $num4;
}

?>
