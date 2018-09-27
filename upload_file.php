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
  // $test = 11001100001010101010101010101001;
  // echo bin2Str($test);

  //加密模式下
  if($radioState == "Encryption"){

    //行分解 变数组
    $rowAfterSplit = splitRows($strOriginal);
    // echo "行分解".$rowAfterSplit.'<br/>';
    // print_r($rowAfterSplit);
    // echo '<br/>';
    // echo ("<script>console.log(' 行分解: ".$rowAfterSplit."');</script>");

    //行补足 数组
    $rowAfterFill = fillRows($rowAfterSplit);
    // echo "行补足".$rowAfterFill.'<br/>';
    // print_r($rowAfterFill);
    // echo ("<script>console.log(' 行补足: ".$rowAfterFill."');</script>");
    // echo '<br/>';


    //行数据转二进制 数组
    $rowFilledBin = str2Bin($rowAfterFill);
    // echo "转二进制".$rowFilledBin.'<br/>';
    // print_r($rowFilledBin);
    // echo '<br/>';

    //至此数据处理完成 DES算法部分
    $rowCipher = "";

    foreach ($rowFilledBin as $eachRow) {

      for($i = 0; $i < strlen($eachRow)/64; $i++){
        $plainText64bit = substr($eachRow, $i * 64, 64);
        //初始置换
        $textAfterIP = des_encrypt_IP($plainText64bit);
        //echo "初始置换：".$textAfterIP."长度".strlen($textAfterIP).'<br/>';
        $leftSide = Array();
        $rightSide = Array();
        $key = Array();
        //分左右半区
        $leftSide[0] = substr($textAfterIP,0,32);
        $rightSide[0] = substr($textAfterIP,32,32);

        for ($loop=0; $loop < 16; $loop++) {
            //0,2,4,...,16轮
            $leftSide[$loop+1] = $rightSide[$loop];
              //拓展置换
            $leftSide[$loop] = des_encrypt_EP($leftSide[$loop]);
              //获取密码
            $key[$loop] = substr($fullKeyinBin, 48 * $loop, 48);
              //XOR运算
            $resultXOR = calculateXOR($leftSide[$loop],$key[$loop]);
              //S盒压缩
            $resultSBox = sBoxCompress($resultXOR);
              //P盒置换
            $resultPBox = pBoxExchange($resultSBox);
            $rightSide[$loop + 1] = $resultPBox;
        }
        $combine = $leftSide[15].$rightSide[15];
        $rowCipher = $rowCipher.hex2bin(base_convert($combine, 2, 16));
        // echo "combine: ".hex2bin(base_convert($combine, 2, 16)).'<br/>';
      }
      $rowCipher = $rowCipher."\n";
    }

  }else {
    //解密模式

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

    <textarea id="textarea_output" name="textarea_output" wrap="hard" style="height:150px;width:480px;resize:none;display:none;"><?php
      $output = $rowCipher;
      echo $output;
    ?></textarea>

    <br/><br/>
    <script type="text/javascript">
      function jsCopy(){
        var e = document.getElementById("testarea_output");
        e.select();
        document.execCommand("Copy");
        alert("Copy Succeed!");
      }
    </script>
    <h3 id="download"> Done!<br/><br/></h3>

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
