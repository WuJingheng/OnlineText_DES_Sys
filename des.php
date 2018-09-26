<?php
  //初始置换
function des_encrypt_IP($plainStr){
  //初始置换表
  $arrIP = Array(
    "58","50","42","34","26","18","10","2",
    "60","52","44","36","28","20","12","4",
    "62","54","46","38","30","22","14","6",
    "64","56","48","40","32","24","16","8",
    "57","49","41","33","25","17","9","1",
    "59","51","43","35","27","19","11","3",
    "61","53","45","37","29","21","13","5",
    "63","55","47","39","31","23","15","7"
  );
  $plainStrSafe = $plainStr;
  for ($i = 0; $i < 64; $i++) {
    //替换部分
    $plainStr = substr_replace($plainStr,substr($plainStrSafe,(int)$arrIP[$i]-1,1),$i,1);
  }
  return $plainStr;
}

//扩展置换
function des_encrypt_EP($strSide){
  //扩展置换表
  $arrEP = Array(
    "32","1","2","3","4","5",
    "4","5","6","7","8","9",
    "8","9","10","11","12","13",
    "12","13","14","15","16","17",
    "16","17","18","19","20","21",
    "20","21","22","23","24","25",
    "24","25","26","27","28","29",
    "28","29","30","31","32","1"
  );
  $arrTmpForEP = Array();
  for ($tmp = 0; $tmp < 48; $tmp++) {
    $arrTmpForEP[$tmp] = substr($strSide,$arrEP[$tmp]-1,1);
  }
  return join('',$arrTmpForEP);
}

//XOR运算
function calculateXOR($str1,$str2){
  $arrTmpXOR = Array();
  for ($tmp=0; $tmp < 48; $tmp++) {
    $arrTmpXOR[$tmp] = ((int)substr($str1, $tmp, 1) + (int)substr($str2, $tmp, 1)) % 2;
  }
  return join('',$arrTmpXOR);
}

?>
