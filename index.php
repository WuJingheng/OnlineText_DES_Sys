<?php

?>
<html>
  <head>
    <title>DES Encryption/Decryption System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="res/favicon.ico"/>
    <link href="style/style.css" type="text/css" rel="Stylesheet" />
    <script type="text/javascript" src="js/limit.js"></script>
  </head>
  <body>

    <!-- 标题部分 -->
    <h1>DES Encryption/Decryption System</h1>
    <h2>Please type in the text you wanna encryp/decrypt.</h2>

    <!-- 上传文件 -->
    <form action="upload_file.php" method="post" enctype="multipart/form-data" >
      <label for="text">Text You Want to Encrypt/Decrypt:</label><br/>
      <textarea id="textarea" name="textarea" wrap="soft" style="height:150px;width:480px;resize:none;"
      onkeyup="textLimit()" placeholder="Type your text here..."></textarea>
      <div class="limit"><p id="textLimit"><i>&nbsp;&nbsp;&nbsp;&nbsp;*no EMPTY</i></p></div>
      <br/>
      <label for"key">Key:</label>
      <input type="password" name="key" id="key" onkeyup="wordsLimit();checkSubmit()"/>
      <br/>
      <div class="limit">
        <p id="keyLimit01"><i>&nbsp;&nbsp;&nbsp;&nbsp;*keep your key between 9~16 characters</i><br/></p>
        <p id="keyLimit02"><i>&nbsp;&nbsp;&nbsp;&nbsp;*case letters, numbers only</i><br/></p>
        <p id="keyLimit04"><i>&nbsp;&nbsp;&nbsp;&nbsp;*no EMPTY</i></p>
      </div><br/>
      <input type="radio" name="radioEnorDecryption" value="Encryption" checked="checked">Encryption</input>
      <input type="radio" name="radioEnorDecryption" value="Decryption">Decryption</input>
      <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" id="submit" class="btn" name="submit" value="Submit" disabled="disabled"/>
      <!-- onmouseover="this.style.backgroundColor='#0080ff';
      this.style.color='#fff'"
      onmouseout="this.style.backgroundColor='#fff';
      this.style.color='#000'"/> -->
    </form>

    <!-- 上传说明部分 -->
    <hr/>
    <h3>Notice:</h3>
    <p><i>
      This is a DES(Data Encryption Standard) Encryption/Decryption System base on PHP.<br/>
      You can type in the text with a key then the system will return you a string which has been encrypted/decrypted.<br/>
    </i></p>

    <!-- 页脚部分 -->
    <div class="footer">
      <hr/>
      <i>DES Encryption/Decryption System Posted By Jingheng&#169;.</i>
    </div>

  </body>
</html>
