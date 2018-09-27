  //延时函数
  //引用来自https://www.oschina.net/question/141209_21625?sort=time
  // function sleep(d){
  //   for(var t = Date.now();Date.now() - t <= d;);
  // }

  //显示Starting
  function showStarting(){
    document.getElementById('starting').style.display = "inline";
  }

  //显示Processing
  function showProcessing(){
    document.getElementById('processing').style.display = "inline";
  }

  //延时显示省略号
  var showEllipsis = function (){

    //这个方法会导致整个页面卡顿
    // showEllipsis01();
    // sleep(100);
    // showEllipsis02();
    // sleep(100);
    // showEllipsis03();
    // sleep(100);
    // showEllipsis05();
    // sleep(100);
    // showEllipsis06();
    // sleep(100);
    // showEllipsis07();
    // sleep(100);

    setTimeout("showEllipsis01()","50");
    setTimeout("showEllipsis02()","100");
    setTimeout("showEllipsis03()","150");
    // setTimeout("showEllipsis04()","200");
    setTimeout("showEllipsis05()","250");
    setTimeout("showEllipsis06()","300");
    setTimeout("showEllipsis07()","350");
  }
  function showEllipsis01(){
    document.getElementById('ellipsis01').style.display = "inline";
  }
  function showEllipsis02(){
    document.getElementById('ellipsis02').style.display = "inline";
  }
  function showEllipsis03(){
    document.getElementById('ellipsis03').style.display = "inline";
  }

  //不好看放弃
  // function showEllipsis04(){
  //   document.getElementById('ellipsis04').style.display = "inline";
  // }

  function showEllipsis05(){
    document.getElementById('ellipsis05').style.display = "inline";
  }
  function showEllipsis06(){
    document.getElementById('ellipsis06').style.display = "inline";
  }
  function showEllipsis07(){
    document.getElementById('ellipsis07').style.display = "inline";
  }

  //显示下载
  function showDone(){
    document.getElementById('download').style.display = "inline";
    document.getElementById('backToHome').style.display = "inline";
  }
  //显示文本框
  function showText(){
    document.getElementById('textarea_output').style.display = "inline";
  }
  //删除Starting
  function delStarting(){
    document.getElementById('starting').style.display = "none";
  }

  //删除Processing
  function delProcessing(){
    document.getElementById('processing').style.display = "none";
  }


  //删除省略号
  function delEllipsis(){
    document.getElementById('ellipsis01').style.display = "none";
    document.getElementById('ellipsis02').style.display = "none";
    document.getElementById('ellipsis03').style.display = "none";
    // document.getElementById('ellipsis04').style.display = "none";
    document.getElementById('ellipsis05').style.display = "none";
    document.getElementById('ellipsis06').style.display = "none";
    document.getElementById('ellipsis07').style.display = "none";
  }

  //
  function delGIF(){
    var self = document.getElementById('processbar');
    var parent = document.getElementById('processbarParent');
    parent.removeChild(self);
  }

  //删除完成标识
  // function delDone(){
  //   document.getElementById('download').style.display = "none";
  //   document.getElementById('backToHome').style.display = "none";
  // }

  function final(){

    //初始化状态
    //1.删除所有元素
    delStarting();
    delEllipsis();
    delProcessing();
    document.getElementById('download').style.display = "none";
    document.getElementById('backToHome').style.display = "none";


    //显示Starting 循环两次省略号后 清除
    showStarting();
    showEllipsis();
    setTimeout("delEllipsis()","1400");
    setTimeout("showEllipsis()","1600");
    setTimeout("delEllipsis()","2600");
    setTimeout("delStarting()","2600");

    //显示Processing 循环两次省略号后 清除
    setTimeout("showProcessing()","2600");
    setTimeout("showEllipsis()","2800");
    setTimeout("delEllipsis()","3800");
    setTimeout("showEllipsis()","4000");
    setTimeout("delEllipsis()","5000");
    setTimeout("delProcessing()","5000");

    //清除gif
    setTimeout(
      "delGIF()"
      ,"5000"
    )

    //显示下载
    setTimeout("showDone()","5000");
    setTimeout("showText()","5000");
  }
