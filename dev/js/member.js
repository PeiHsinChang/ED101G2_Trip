window.onload = function (){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status==200){
          AllKeepPackage = JSON.parse(xhr.responseText);
          console.log(AllKeepPackage[7]);
          keepAttras = AllKeepPackage[0];
          keepGroups = AllKeepPackage[1];
          keepSches = AllKeepPackage[2];
          keepBlogs = AllKeepPackage[3];
          memSches = AllKeepPackage[4];
          memGroups = AllKeepPackage[5];
          memBlogs = AllKeepPackage[6];
          areas = AllKeepPackage[7];

          new Vue({
              el: '#spotForKeep', 
              data: {      
                  keepAttras,
              },
              computed: {
                  output(){
                      // if(keepAttras.Attrac_PicURL == "")
                      console.log( keepAttras.Attrac_PicURL);
                      s ="./images/lake.jpg"
                      return s;  
                  }
          },
          });
          groupCard =  new Vue({
              el: '#groupForKeep', 
              data: {      
                  keepGroups,
              },
          });
        scheCard =   new Vue({
              el: '#scheForKeep', 
              data: {
                  keepSches,
              },
          });
          blogCard =      new Vue({
              el: '#blogForKeep', 
              data: {
                  keepBlogs,
              },
          });
          new Vue({
              el: '#schedForMem', 
              data: { 
                  memSches,   
              },
          });
          new Vue({
              el: '#groupForMem', 
              data: { 
                  memGroups,  
              },
          });
          new Vue({
              el: '#blogForMem', 
              data: {      
                  memBlogs,
              },
          });
            new Vue({
                el: '#filterArea', 
                data: {      
                    areas,
                },
            });

      }else{
          alert(xhr.status);
      }
  }
  xhr.open("post", "keepAllquery.php", true);
  xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
  //在 php session_start  取 memberinfo
  xhr.send();   
}


function openTab(obj, index, tabName) {
  var i;
  if (index == 1) {
      x = document.getElementsByClassName("memRightContainer");
      document.getElementsByClassName("tabButtonFocus")[0].classList.add("tabButton");
      document.getElementsByClassName("tabButtonFocus")[0].classList.remove("tabButtonFocus");
      obj.classList.add("tabButtonFocus");
      obj.classList.remove("tabButton");

  } else {
      x = document.getElementsByClassName("keepContainer");
      document.getElementsByClassName("subTabFocus")[0].className = "subTab";
      obj.className = "subTabFocus";
  }
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
}

  var ss = new Vue({
      el: '#spotLightBox', 
      data: {      
          QueryCards:{}
      }, 
  })

function openCardLightBox(obj){
  spotLightBox.style.display = "block";
  mySpotName = obj.dataset.id;
  console.log(mySpotName);
  keepSpotInfo = {
    Spot_Id:mySpotName
  };
let xhr = new XMLHttpRequest();
xhr.open("post", "./openQueryCards.php", true);
xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
//把資料往後傳
xhr.send("keepSpotInfo=" + JSON.stringify(keepSpotInfo));   
xhr.onload = function(){
  if(xhr.status==200){
      let QueryCards = JSON.parse(xhr.responseText);
      ss.$data.QueryCards = QueryCards;
  }else{
      alert(xhr.status);
  }
}
}
function closespotLightBox(){
  spotLightBox.style.display = "none";
}

function keepLikeBtn(obj){
  let likeName = obj.dataset.id;
  let likeTitle = obj.dataset.title;
 
  let patt = new RegExp("heart_r.png");
  iskeep = patt.test(obj.firstChild.src);    
  if(iskeep){
    obj.firstChild.src = "./images/heart.png";
    iskeep = false;
}else{
    obj.firstChild.src = "./images/heart_r.png";
    iskeep = true;
}
  let keepLikeInfo = {
    Like_Title: likeTitle,
    Like_Id: likeName,
    iskeep: iskeep
  };

  let xhr = new XMLHttpRequest();
  xhr.open("post", "./likeBtnQuery.php", true);
  xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
  let sendif ="keepLikeInfo="+JSON.stringify(keepLikeInfo);
  console.log(sendif);
  xhr.send(sendif);   
  console.log(JSON.stringify(keepLikeInfo));
  xhr.onload = function(){
    if(xhr.status==200){
      console.log(xhr.responseText);
    }else{
      alert(xhr.status);
    }
}

}
var sche = new Vue({
    el: '#scheLightBox', 
    data: {      
        keepSche1:{},
        QueryScheCards:{}
        
    }, 
})

//sche card open
function openScheCardLightBox(obj){
    scheLightBox.style.display = "block";
    myScheName = obj.dataset.id;
    // console.log(myScheName);
    keepScheInfo = {
        Sche_Id:myScheName
    };
    console.log(keepScheInfo);
    let xhr = new XMLHttpRequest();
    xhr.open("post", "./openQueryScheCard.php", true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    //把資料往後傳
    xhr.send("keepScheInfo=" + JSON.stringify(keepScheInfo));   
    xhr.onload = function(){
        if(xhr.status==200){
            let QueryScheCards = JSON.parse(xhr.responseText);
            console.log(QueryScheCards)
            keepSche1 = {
                Sche_Img:QueryScheCards[0].Sche_Img,
                Sche_Name:QueryScheCards[0].Sche_Name
            };
            sche.$data.QueryScheCards = QueryScheCards;
            sche.$data.keepSche1 = keepSche1;

        }else{
            alert(xhr.status);
        }
    }
  }
 
function closescheLightBox(){
    scheLightBox.style.display = "none";
  }


//會員頁面左側-會員資料修改
//點擊修改會員資料，切換至修改模式
function adjust(){
    document.getElementById('memLeftAdjust').style.display = 'inline-block';
    document.getElementById('memLeft').style.display = 'none';
    MemberInfoToMemLeft();
}
//點擊取消，切換回瀏覽模式
function cancel(){
    document.getElementById('memLeftAdjust').style.display = 'none';
    document.getElementById('memLeft').style.display = 'inline-block';
    $id("memLeftPicAdjust").innerHTML = `<img src="${member.Mem_Photo}">`;
    $id("memLeftNameAdjust").innerText = `${member.Mem_Name}`;
    $id("memLeftAdjustPsw").innerHTML = `密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碼：<input type="text" value="${member.Mem_Psw}">`;
    $id("memLeftAdjustBir").innerHTML = `生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：<input type="text" value="${member.Mem_Birth}">`;
    $id("memLeftAdjustEma").innerHTML = `連絡信箱：<input type="text" value="${member.Mem_Email}">`;
    $id("memLeftAdjustTel").innerHTML = `聯絡電話：<input type="text" value="${member.Mem_Tel}">`;

    $("#memLeftAdjustPswCheck").html("");
    $("#memLeftAdjustBirCheck").html("");
    $("#memLeftAdjustEmaCheck").html("");
    $("#memLeftAdjustTelCheck").html("");
}
//每次重整頁面，取得seeion中的會員資料，呈現在會員資料欄
function MemberInfoToMemLeft(){
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
      if(xhr.status == 200){
          member = JSON.parse(xhr.responseText);
          if(member.Mem_Name){ //已登入
            $id("memLeftPic").innerHTML = `<img src="${member.Mem_Photo}">`;
            $id("memLeftName").innerText = `${member.Mem_Name}`;
            $id("memLeftAcc").innerHTML = `帳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;號： ${member.Mem_Id}`;
            $id("memLeftBir").innerHTML = `生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日： ${member.Mem_Birth}`;
            if(member.Mem_Sex == 0){
                $id("memLeftSex").innerHTML = `性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;別： 男`;
            }else{
                $id("memLeftSex").innerHTML = `性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;別： 女`;
            }       
            $id("memLeftEma").innerHTML = `連絡信箱： ${member.Mem_Email}`;
            $id("memLeftTel").innerHTML = `聯絡電話： ${member.Mem_Tel}`;

            $id("memLeftPicAdjust").innerHTML = `<img src="${member.Mem_Photo}">`;
            $id("memLeftNameAdjust").innerText = `${member.Mem_Name}`;
            $id("memLeftAdjustAcc").innerHTML = `帳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;號：<input id="memLeftAdjustAccContent" name="memLeftAdjustAccContent" type="text" value="${member.Mem_Id}" readonly="readonly" style="outline:none">`;
            $id("memLeftAdjustPsw").innerHTML = `密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碼：<input class="qqq" id="memLeftAdjustPswContent" name="memLeftAdjustPswContent" type="text" value="${member.Mem_Psw}">`;
            $id("memLeftAdjustBir").innerHTML = `生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：<input class="qqq" id="memLeftAdjustBirContent" name="memLeftAdjustBirContent" type="text" value="${member.Mem_Birth}">`;
            $id("memLeftAdjustEma").innerHTML = `連絡信箱：<input class="qqq" id="memLeftAdjustEmaContent" name="memLeftAdjustEmaContent" type="text" value="${member.Mem_Email}">`;
            $id("memLeftAdjustTel").innerHTML = `聯絡電話：<input class="qqq" id="memLeftAdjustTelContent" name="memLeftAdjustTelContent" type="text" value="${member.Mem_Tel}">`;

            // 修改會員修改會員密碼，檢查密碼長度
            $("#memLeftAdjustPswContent").keyup(function(){
                let accountLength = $("#memLeftAdjustPswContent").val().length;
                // console.log(accountLength);
                if(accountLength < 8){
                    $("#memLeftAdjustPswCheck").html("密碼長度不得低於8個字");
                    $("#memLeftAdjustPswCheck").css("color","red");
                    if(accountLength == 0){
                        $("#memLeftAdjustPswCheck").html("");
                    }
                }else{
                    $("#memLeftAdjustPswCheck").html("");
                }
            });

            // 修改會員修改會員生日，檢查生日格式是否正確
            $("#memLeftAdjustBirContent").keyup(function(){
                let reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
                let regExp = new RegExp(reg);
                let birth = $("#memLeftAdjustBirContent").val(); 
                let birthLength = $("#memLeftAdjustBirContent").val().length;
                if(!regExp.test(birth)){
                  $("#memLeftAdjustBirCheck").html("請輸入正確格式:YYYY-MM-DD");
                  $("#memLeftAdjustBirCheck").css("color","red");
                  if(birthLength == 0){
                    $("#memLeftAdjustBirCheck").html("");
                  }
                }else{
                  $("#memLeftAdjustBirCheck").html("");
                }
            });

            // 修改會員修改會員信箱，檢查email格式是否正確
            $("#memLeftAdjustEmaContent").keyup(function(){
                let email = $("#memLeftAdjustEmaContent").val();
                let emailLength = $("#memLeftAdjustEmaContent").val().length;
                if((email.indexOf('.com') == -1)||(email.indexOf('@') == -1)){
                $("#memLeftAdjustEmaCheck").html("請輸入正確e-mail格式");
                $("#memLeftAdjustEmaCheck").css("color","red");
                if(emailLength == 0){
                    $("#memLeftAdjustEmaCheck").html("");
                }
                }else{
                $("#memLeftAdjustEmaCheck").html("");
                }
            });

            // 修改會員修改會員電話，檢查電話格式是否正確
            $("#memLeftAdjustTelContent").keyup(function(){
                let phoneLength = $("#memLeftAdjustTelContent").val().length;
                if((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)){
                  $("#memLeftAdjustTelCheck").html("");
                }else{
                  $("#memLeftAdjustTelCheck").html("請輸入正確電話格式");
                  $("#memLeftAdjustTelCheck").css("color","red");
                  if(phoneLength == 0){
                    $("#memLeftAdjustTelCheck").html("");
                  }
                }     
              });

            //檢查所有欄位是否都已經填妥，未填妥則無法送出表單
            $(document).ready(function(){
                $("#memLeftAdjustSave").click(function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    if($("#memLeftAdjustPswCheck").html().length != 0){
                        alert('密碼長度不得低於8個字');
                    }else if($("#memLeftAdjustEmaCheck").html().length != 0){
                        alert('請輸入正確e-mail格式');
                        console.log('123');
                    }else if($("#memLeftAdjustTelCheck").html().length != 0){
                        alert('請輸入正確電話格式');
                    }else if($("#memLeftAdjustBirCheck").html().length != 0){
                        alert('請輸入正確日期格式:YYYY-MM-DD');
                    }else{
                        document.memLeftAdjustForm.submit();
                        $id("memLeftBir").innerHTML = `生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日： ${$("#memLeftAdjustBirContent").val()}`;
                        $id("memLeftEma").innerHTML = `連絡信箱： ${$("#memLeftAdjustEmaContent").val()}`;
                        $id("memLeftTel").innerHTML = `聯絡電話： ${$("#memLeftAdjustTelContent").val()}`;
                    }
                });
            });
          }else{
            // alert('請先登入');
            // history.go(-1);
          }
      }
    }
    xhr.open("get", "getMemberInfo.php", true);
    xhr.send(null);
}

function onlooooad(){
    document.getElementById('adjustProfile').onclick = adjust;
    document.getElementById('memLeftAdjustCancel').onclick = cancel;
    //每次重整頁面，取得seeion中的會員資料，呈現在會員資料欄
    MemberInfoToMemLeft();
}
//window.onload
window.addEventListener("load",onlooooad,false);
/*排序的click*/
function sortKeep(obj){
    //  obj.className= "filterBtnClick";
    keepSort = obj.dataset.keepsort;
    keepSortObj = {
        keepSort: keepSort
    };
    let xhr = new XMLHttpRequest();
    xhr.open("post", "./MemberSort.php", true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    //把資料往後傳
    xhr.send("keepSortObj=" + JSON.stringify(keepSortObj)); 
    console.log(JSON.stringify(keepSortObj));  
    xhr.onload = function(){
        if(xhr.status==200){
            var QueryScheCards = JSON.parse(xhr.responseText);
            console.log(QueryScheCards)
            if(keepSort =="scheNew" || keepSort =="schePop"){
                scheCard.$data.keepSches = QueryScheCards; 
            }else if(keepSort =="blogNew" || keepSort =="blogPop"){
                blogCard.$data.keepBlogs = QueryScheCards; 
            }else{
                groupCard.$data.keepGroups = QueryScheCards;

            }

            // sche.$data.QueryScheCards = QueryScheCards;
            // sche.$data.keepSche1 = keepSche1;

        }else{
            alert(xhr.status);
        }
    }
}