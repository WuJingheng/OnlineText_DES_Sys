<?php

//补足位数
function fillString($strOriginal){
  if (strlen($strOriginal) % 8 == 0) {
    $str8Times = $strOriginal;
  }else {
    $str8Times = $strOriginal;
    $remainder = strlen($strOriginal) % 8;
    for ($i=0; $i < 8 - $remainder; $i++) {
      $str8Times = $str8Times." ";
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

?>
