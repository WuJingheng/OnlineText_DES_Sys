//文件限制
//目前限制为文件不能为空
function fileLimit(){
  if(document.getElementById('file').value == ""){
    document.getElementById('keyLimit03').style.display = "inline";
    console.log("EMPTY");
    return false;
  }else {
    document.getElementById('keyLimit03').style.display = "none";
    console.log("File Received!");
    return true;
  }
}

function textLimit(){
  if(document.getElementById('textarea').value == ""){
    document.getElementById('textLimit').style.display = "inline";
  }else{
    document.getElementById('textLimit').style.display = "none";
  }
}


//index页密码规则
//1. 9-16位
//2.只能英文大小写，数字，符号
function wordsLimit(){

  //测试用
  //console.log(document.getElementById('key').value);

  //定义约束条件
  var limit_01 = 0;
  var limit_02 = 0;
  var limit_03 = 0;

  //不能为空
  if(document.getElementById('key').value.length > 0){
    document.getElementById('keyLimit04').style.display = "none";
    //console.log("PASS Rule 3! Length: " + document.getElementById('key').value.length);
    limit_01 = 1;
  }else{
    document.getElementById('keyLimit04').style.display = "inline";
    document.getElementById('keyLimit02').style.display = "inline";
    limit_01 = 0;
    //console.log("Against Rule 3! Length: " + document.getElementById('key').value.length);
  }

  //9-16位
  if(document.getElementById('key').value.length < 9 || document.getElementById('key').value.length > 16){
    document.getElementById('keyLimit01').style.display = "inline";
    limit_02 = 0;
    //console.log("Against Rule 1!");
    return false;
  }else{
    document.getElementById('keyLimit01').style.display = "none";
    limit_02 = 1;
    //console.log("PASS Rule 1!");
  }

  //内容
  var rulePattern = /^[a-zA-Z0-9]{0,16}$/;
  //console.log(rulePattern.test(document.getElementById('key').value));
  if(rulePattern.test(document.getElementById('key').value)){
    document.getElementById('keyLimit02').style.display = "none";
    limit_03 = 1;
    //console.log("PASS Rule 2!");
  }else {
    document.getElementById('keyLimit02').style.display = "inline";
    limit_03 = 0;
    console.log("Against Rule 2!");
  }

  if(limit_01 == 0 && limit_02 == 0 && limit == 0){
    return true;
  }else {
    return false;
  }
}

function checkSubmit(){

  //var fileCheck = document.getElementById('file').fileLimit();
  //var keyCheck = document.getElementById('key').keyLimit();

  var rulePattern = /^[a-zA-Z0-9]{9,16}$/;

  if(document.getElementById('textarea').value != "" && rulePattern.test(document.getElementById('key').value)){
    document.getElementById('submit').disabled = false;
  }else {
    document.getElementById('submit').disabled = true;
  }
}
