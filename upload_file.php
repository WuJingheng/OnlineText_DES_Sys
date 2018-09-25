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
  $fullKey = str_repeat($key,4);
  $fullKeyinBin = strToBin($fullKey);
  //echo "Full Key in Binary: ";echo '<br/>';echo $fullKeyinBin;echo '<br/>';
  //echo strlen($fullKeyinBin);

  //临时测试区域
  //echo (9%2);
  //echo strlen($strOriginal);

  //加密模式下
  if($radioState == "Encryption"){

    //行分解 变数组
    $rowAfterSplit = splitRows($strOriginal);

    //行补足 数组
    $rowAfterFill = fillRows($rowAfterSplit);

    //行数据转二进制 数组
    $rowFilledBin = str2Bin($rowAfterFill);

    //至此数据处理完成 DES算法部分
    foreach ($rowFilledBin as $eachRow) {

      for($i = 0; $i < strlen($eachRow)/64; $i++){
        $plainText64bit = substr($eachRow, $i * 64, 64);

        //测试输出64位字符
        echo "splainText in Bin:";echo '<br/>';echo $plainText64bit;echo '<br/>';

        $textAfterIP = des_encrypt($plainText64bit);

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
