function $id(id){
  return document.getElementById(id);
}	

let member = {};

//Hamburger
$(document).ready(function(){
  let $hamburger = $(".hamburger");
  $hamburger.on("click", function(e){
    $hamburger.toggleClass("is-active");
    $("#panel").slideToggle("slow");
  });
  function openTab(index,tabName){
    var i;
    if(index==1){
      x = document.getElementsByClassName("memRightContainer");
    }else{
      x = document.getElementsByClassName("keepContainer");
    }
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    document.getElementById(tabName).style.display = "block";  
  }
})

//點擊登出
function showLoginForm(){
  //如果aLogin的文字是登出
  //將nav上，登入者資料清空 
  //aLogin的字改成登入
  //將session上的使用者資料清掉
  if ($id('aLogin').innerHTML == "登出"){
      //使用Ajax回server端做登出，宣告xhr，先產生XMLHttpRequest準備要去跟對方要資料
      let xhr = new XMLHttpRequest();
      //使用非同步都等不到資料回傳就跑完程式碼，如果想要觸發事件，可用.onload，它會確認撈完資料才會去執行
      xhr.onload = function(){
          if(xhr.status==200){
              $id('memberPic').innerHTML = '';
              $id('aLogin').innerHTML = '登入'; 
              $id('aRegist').style.display = 'inline-block';
              $id('memberPic').style.display = 'none';
              $id("loginLightBox").style.display = 'none';
              location.href='main.html';
              document.querySelector('.navSmallRight').innerHTML == "登入"

          }else{
              alert(xhr.status);
          }
      } 
      //開啟對伺服器端的連結
      xhr.open("get", "logout.php", true);  
      //傳送一個空值，把遠端的.json資料撈過來，檢查xhr，readyState狀態變成4，responseText也抓到資料，responseURL也正確抓到網址，資料都已經抓取。
      xhr.send(null);              
  }          
}

//登出，手機版登出
function phoneLogout(){
  if(document.querySelector('.navSmallRight').innerHTML == "登出"){
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
      if(xhr.status==200){
          $id('memberPic').innerHTML = '';
          $id('aLogin').innerHTML = '登入'; 
          $id('aRegist').style.display = 'inline-block';
          $id('memberPic').style.display = 'none';
          $id("loginLightBox").style.display = 'none';
          location.href='main.html';
          document.querySelector('.navSmallRight').innerHTML == "登入"

      }else{
          alert(xhr.status);
      }
    }
    xhr.open("get", "logout.php", true); 
    xhr.send(null); 
  }
}

//登入，輸入完帳號密碼後送出
function sendForm(){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status==200){
          console.log(xhr.responseText);
          member = JSON.parse(xhr.responseText);
          console.log(member);
          if(member.Mem_Name){
              $id('memberPic').innerHTML = `<img src="${member.Mem_Photo}">`;
              $id('aLogin').innerText = '登出';
              $id('aRegist').style.display = 'none';
              $id('qwer').style.display = 'none';
              $id('memberPic').style.display = 'inline-block';
              document.querySelector('.modal-backdrop').style.display = 'none';
              document.querySelector('.navSmallRight').innerText = '登出';

          }else{
              alert("帳密錯誤");
              document.querySelector('.modal-backdrop').style.display = 'none';
          }                    
      }else{
          alert(xhr.status);
      }
  }
  xhr.open("post", "login.php", true);
  xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
  //將要送出的資料先放在物件中
  let loginInfo = {
      Mem_Id:$id("memId").value,
      Mem_Psw:$id("memPsw").value
  
  }
  let str = JSON.stringify(loginInfo);

  let data_info = `loginInfo=${str}`;//傳json字串
  xhr.send(data_info);   
  console.log(data_info);

  //將登入表單上的資料清空，並隱藏起來
  $id('loginForm').style.display = 'none';
  $id('memId').value = '';
  $id('memPsw').value = '';
}
// localStorage.setItem("memId", $id('memId').value);

//每次重整頁面，取得seeion中的會員資料
function getMemberInfo(){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status == 200){
          member = JSON.parse(xhr.responseText);
          if(member.Mem_Name){ //已登入
              $id("memberPic").innerHTML = `<img src="${member.Mem_Photo}">`;
              $id("aLogin").innerText = "登出";
              $id('aRegist').style.display = 'none';
              $id('qwer').style.display = 'none';
              $id('memberPic').style.display = 'inline-block';
              document.querySelector('.navSmallRight').innerText = '登出';
          }else{
              $id('aRegist').style.display = 'inline-block';
              $id('qwer').style.display = 'inline-block';
          }
      }
  }
  xhr.open("get", "getMemberInfo.php", true);
  xhr.send(null);
}

//註冊，點擊取消後清空已輸入的資料
function cancelRegist(){
  $id('r_memName').value = '';
  $id('r_memId').value = '';
  $id('r_memPsw').value = '';
  $id('r_memPsw2').value = '';
  $id('r_memEmail').value = '';
  $id('r_memTel').value = '';
  $id('r_memBirth').value = '';
  $id('male').checked = false;
  $id('female').checked = false;
  $id('other').checked = false;
  $id('accountCheck').innerText = '';
  $id('passwordCheck').innerText = '';
  $id('passwordCheck2').innerText = '';
  $id('emailCheck').innerText = '';
}

//登入，點擊取消後清空已輸入的資料
function cancelLogin(){ 
  $id('memId').value = '';
  $id('memPsw').value = '';
}

//檢查所有欄位是否都已經填妥，填妥則無法送出表單
$(document).ready(function(){
  $(".enrollleftbutton").click(function(){
    if($("#accountCheck").html().length != 0){
      alert('帳號長度不得低於6個字');
    }else if($("#passwordCheck").html().length != 0){
      alert('密碼長度不得低於8個字');
    }else if($("#passwordCheck2").html().length != 0){
      alert('密碼不一致');
    }else if($("#emailCheck").html().length != 0){
      alert('請輸入正確e-mail格式');
    }else if($("#phoneCheck").html().length != 0){
      alert('請輸入正確電話格式');
    }else if($("#birthCheck").html().length != 0){
      alert('請輸入正確日期格式:YYYY-MM-DD');
    }else{
      document.enrollfrom.submit();
    }
  })
});

//點擊會員專區，判斷是否已登入
function checkLogin(){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status == 200){
          member = JSON.parse(xhr.responseText);
          if(member.Mem_Name){ //已登入
            location.href="member.html";
          }else{
            alert('您尚未登入喔！');
          }
      }
  }
  xhr.open("get", "getMemberInfo.php", true);
  xhr.send(null);
}

// ============================================
function init(){
  //使用Ajax回server端,取回會員的登入資訊
  getMemberInfo();
  //===設定aLogin.onclick 事件處理程序是 showLoginForm
  $id('aLogin').onclick = showLoginForm;
  //===設定loginleftbutton.onclick 事件處理程序是 sendForm
  $id('loginbutton').onclick = sendForm;
  //===設定btnRegistCancel.onclick 事件處理程序是 cancelRegist
  $id('registrightbutton').onclick = cancelRegist;
  //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
  $id('loginrightbutton').onclick = cancelLogin;
  //手機版登出
  document.querySelector('.navSmallRight').onclick = phoneLogout;
  //點擊會員專區，判斷是否已登入
  $id('nav-linkMember').onclick = checkLogin;
  $id('navSmallMember').onclick = checkLogin;

  //註冊，檢查帳號長度
  $("#r_memId").keyup(function(){
    let accountLength = $("#r_memId").val().length;
    console.log(accountLength);
    if(accountLength < 6){
        $("#accountCheck").html("帳號長度不得低於6個字");
        $("#accountCheck").css("color","red");
        if(accountLength == 0){
            $("#accountCheck").html("");
        }
    }else{
        // $("#accountCheck").html("帳號長度ok");
        // $("#accountCheck").css("color","green");
        $("#accountCheck").html("");
    }
  });

  //註冊，檢查密碼長度
  $("#r_memPsw").keyup(function(){
    let accountLength = $("#r_memPsw").val().length;
    // console.log(accountLength);
    if(accountLength < 8){
        $("#passwordCheck").html("密碼長度不得低於8個字");
        $("#passwordCheck").css("color","red");
        if(accountLength == 0){
            $("#passwordCheck").html("");
        }
    }else{
        // $("#passwordCheck").html("密碼長度ok");
        // $("#passwordCheck").css("color","green");
        $("#passwordCheck").html("");
    }
  });

  //註冊，檢查驗證密碼是否一致
  $("#r_memPsw2").keyup(function(){
    let psw = $("#r_memPsw").val();
    let psw2 = $("#r_memPsw2").val();
    let psw2Length = $("#r_memPsw2").val().length;
    if(psw == psw2){
        $("#passwordCheck2").html("");
        // $("#passwordCheck2").css("color","green");               
    }else{
        $("#passwordCheck2").html("密碼不一致");
        $("#passwordCheck2").css("color","red");
        if(psw2Length == 0){
            $("#passwordCheck2").html("");
        }
    }
  });

  //註冊，檢查email格式是否正確
  $("#r_memEmail").keyup(function(){
    let email = $("#r_memEmail").val();
    let emailLength = $("#r_memEmail").val().length;
    if((email.indexOf('.com') == -1)||(email.indexOf('@') == -1)){
      $("#emailCheck").html("請輸入正確e-mail格式");
      $("#emailCheck").css("color","red");
      if(emailLength == 0){
        $("#emailCheck").html("");
      }
    }else{
      $("#emailCheck").html("");
    }
  });

  //註冊，檢查電話格式是否正確
  $("#r_memTel").keyup(function(){
    let phoneLength = $("#r_memTel").val().length;
    if((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)){
      $("#phoneCheck").html("");
    }else{
      $("#phoneCheck").html("請輸入正確電話格式");
      $("#phoneCheck").css("color","red");
      if(phoneLength == 0){
        $("#phoneCheck").html("");
      }
    }     
  });

  //註冊，檢查生日格式是否正確
  $("#r_memBirth").keyup(function(){
    let reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
    let regExp = new RegExp(reg);
    let birth = $("#r_memBirth").val(); 
    let birthLength = $("#r_memBirth").val().length;
    if(!regExp.test(birth)){
      $("#birthCheck").html("請輸入正確格式:YYYY-MM-DD");
      $("#birthCheck").css("color","red");
      if(birthLength == 0){
        $("#birthCheck").html("");
      }
    }else{
      $("#birthCheck").html("");
    }
  });

  $(".navSmallRight1").click(function(){
    $(".hamburger").click();
  });  
  $(".navSmallRight").click(function(){
    $(".hamburger").click();
  });  
}; 
//window.onload
window.addEventListener("load",init,false);