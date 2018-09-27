<?php
  require('charOperation.php');
  require('des.php');

  //获取字符串
  $strOriginal = $_POST["textarea"];
  //echo("<script>console.log(' 获取的字符:" . $strOriginal . "');</script>");

  //获取radio状态
  $radioState = $_POST["radioEnorDecryption"];
  if ($radioState == "Encryption") {
    //echo("<script>console.log('radioState:" . $radioState . "');</script>");
  }else if($radioState == "Decryption"){
    //echo("<script>console.log('radioState:" . $radioState . "');</script>");
  }

  //获取密码
  $key = $_POST['key'];
  //echo("<script>console.log('Encryption Key:" . $key . "');</script>");

  //处理密码
  $key = fillString($key);
  $fullKey = str_repeat($key,6);
  $fullKeyinBin = strToBin($fullKey);
  //echo "Full Key in Binary: ";echo '<br/>';echo $fullKeyinBin;echo '<br/>';
  //echo strlen($fullKeyinBin);

  //临时测试区域
  // $test = (1+1)%2;
  // echo "1+1%2".$test.'<br/>';
  //echo strlen($strOriginal);

  //加密模式下
  if($radioState == "Encryption"){

    //行分解 变数组
    $rowAfterSplit = splitRows($strOriginal);
    echo "行分解".$rowAfterSplit.'<br/>';
    print_r($rowAfterSplit);
    echo '<br/>';
    echo ("<script>console.log(' 行分解: ".$rowAfterSplit."');</script>");

    //行补足 数组
    $rowAfterFill = fillRows($rowAfterSplit);
    echo "行补足".$rowAfterFill.'<br/>';
    print_r($rowAfterFill);
    echo ("<script>console.log(' 行补足: ".$rowAfterFill."');</script>");
    echo '<br/>';


    //行数据转二进制 数组
    $rowFilledBin = str2Bin($rowAfterFill);
    echo "转二进制".$rowFilledBin.'<br/>';
    print_r($rowFilledBin);
    echo '<br/>';

    //至此数据处理完成 DES算法部分
    foreach ($rowFilledBin as $eachRow) {

      for($i = 0; $i < strlen($eachRow)/64; $i++){
        $plainText64bit = substr($eachRow, $i * 64, 64);
        //初始置换
        $textAfterIP = des_encrypt_IP($plainText64bit);
        //echo "初始置换：".$textAfterIP."长度".strlen($textAfterIP).'<br/>';
        //分左右半区
        $leftSide_00 = substr($textAfterIP,0,32);
        $rightSide_00 = substr($textAfterIP,32,32);
        //第一轮-----------------------------------------
        $leftSide_01 = $rightSide_00;
          //拓展置换
        $leftSide_00 = des_encrypt_EP($leftSide_00);
        //echo "拓展置换：".$rightSide_00."长度".strlen($rightSide_00).'<br/>';

          //获取48位密码
        $key01 = substr($fullKeyinBin,0,48);
          //XOR运算
        $resultXOR = calculateXOR($leftSide_00,$key01);
        //echo "XOR结果：".$resultXOR."长度".strlen($resultXOR).'<br/>'.
          //S盒压缩（32bit string）
        $resultSBox = sBoxCompress($resultXOR);
        //echo "S盒结果：".$resultSBox."长度".strlen($resultSBox).'<br/>';
          //P盒置换
        $resultPBox = pBoxExchange($resultSBox);
        //echo "P盒结果：".$resultPBox."长度".strlen($resultPBox).'<br/>';

        $rightSide_01 = $resultPBox;

        //第二轮------------------------------------------
        $rightSide_02 = $leftSide_01;
          //拓展置换
        $rightSide_01 = des_encrypt_EP($rightSide_01);
        //echo "拓展置换：".$rightSide_00."长度".strlen($rightSide_00).'<br/>';
          //获取48位密码
        $key02 = substr($fullKeyinBin,48,48);
          //XOR运算
        $resultXOR = calculateXOR($rightSide_01,$key02);
        //echo "XOR结果：".$resultXOR."长度".strlen($resultXOR).'<br/>'.
          //S盒压缩（32bit string）
        $resultSBox = sBoxCompress($resultXOR);
        //echo "S盒结果：".$resultSBox."长度".strlen($resultSBox).'<br/>';
          //P盒置换
        $resultPBox = pBoxExchange($resultSBox);
        //echo "P盒结果：".$resultPBox."长度".strlen($resultPBox).'<br/>';

        $leftSide_02 = $resultPBox;

        //第三轮--------------------------------------------
        $leftSide_03 = $rightSide_02;
          //拓展置换
        $leftSide_02 = des_encrypt_EP($leftSide_02);
        //echo "拓展置换：".$rightSide_00."长度".strlen($rightSide_00).'<br/>';
          //获取48位密码
        $key03 = substr($fullKeyinBin,48 * 2,48);
          //XOR运算
        $resultXOR = calculateXOR($leftSide_02,$key03);
        //echo "XOR结果：".$resultXOR."长度".strlen($resultXOR).'<br/>'.
          //S盒压缩（32bit string）
        $resultSBox = sBoxCompress($resultXOR);
        //echo "S盒结果：".$resultSBox."长度".strlen($resultSBox).'<br/>';
          //P盒置换
        $resultPBox = pBoxExchange($resultSBox);
        //echo "P盒结果：".$resultPBox."长度".strlen($resultPBox).'<br/>';

        $rightSide_03 = $resultPBox;

        //第四轮---------------------------------------------
        $rightSide_04 = $leftSide_03;
          //拓展置换
        $rightSide_03 = des_encrypt_EP($rightSide_03);
        //echo "拓展置换：".$rightSide_00."长度".strlen($rightSide_00).'<br/>';
          //获取48位密码
        $key04 = substr($fullKeyinBin,48 * 3,48);
          //XOR运算
        $resultXOR = calculateXOR($rightSide_04,$key04);
        //echo "XOR结果：".$resultXOR."长度".strlen($resultXOR).'<br/>'.
          //S盒压缩（32bit string）
        $resultSBox = sBoxCompress($resultXOR);
        //echo "S盒结果：".$resultSBox."长度".strlen($resultSBox).'<br/>';
          //P盒置换
        $resultPBox = pBoxExchange($resultSBox);
        //echo "P盒结果：".$resultPBox."长度".strlen($resultPBox).'<br/>';

        $leftSide_04 = $resultPBox;

        //第五轮--------------------------------------------
        $leftSide_05 = $rightSide_04;
          //拓展置换
        $leftSide_04 = des_encrypt_EP($leftSide_04);
        //echo "拓展置换：".$rightSide_00."长度".strlen($rightSide_00).'<br/>';
          //获取48位密码
        $key05 = substr($fullKeyinBin,48 * 4,48);
          //XOR运算
        $resultXOR = calculateXOR($leftSide_04,$key05);
        //echo "XOR结果：".$resultXOR."长度".strlen($resultXOR).'<br/>'.
          //S盒压缩（32bit string）
        $resultSBox = sBoxCompress($resultXOR);
        //echo "S盒结果：".$resultSBox."长度".strlen($resultSBox).'<br/>';
          //P盒置换
        $resultPBox = pBoxExchange($resultSBox);
        //echo "P盒结果：".$resultPBox."长度".strlen($resultPBox).'<br/>';

        $rightSide_05 = $resultPBox;







        //$plainText64bit =
      }
    }

  }

 ?>
<html>
  <head>
    <title>DES Encryption/Decryption System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../res/favicon.ico"/>
    <link href="style/style.css" type="text/css" rel="Stylesheet" />
    <script type="text/javascript" src="js/pageAnimation.js"></script>

  </head>

  <body onload="final()">

    <!-- 标题部分 -->
    <h1>DES Encryption/Decryption System</h1>
    <h2>Just wait a second. And you can see the Encrypted/Decrypted text.</h2>

    <!-- 上传中gif展示 -->
    <p id="starting">Starting</p>
    <p id="processing">Processing</p>
    <p id="ellipsis01">.</p>
    <p id="ellipsis02">.</p>
    <p id="ellipsis03">.</p>
    <!-- <p id="ellipsis04">&nbsp;</p> -->
    <p id="ellipsis05">.</p>
    <p id="ellipsis06">.</p>
    <p id="ellipsis07">.</p>
    <br/><br/>
    <div id="processbarParent"><img class="processbar" id="processbar" src="res/uploading.gif"/></div>

    <h3 id="download"> Done! Click <a href="testOutputFile.txt" download="output.txt">HERE</a> to download the file ^_^<br/><br/></h3>

    <h4 id="backToHome"> Back to the <a href="index.php">HOME</a> and Encrypt/Decrypt another piece of text.</h4>

    <!-- 两个测试按钮
    <button onclick="delEllipsis()">删省略号</button>
    <button onclick="showEllipsis()">出省略号</button> -->

    <!-- 页脚部分 -->
    <div class="footer">
      <hr/>
      <i>DES Encryption/Decryption System Posted By Jingheng&#169;.</i>
    </div>

  </body>

</html>
