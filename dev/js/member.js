window.onload = function (){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status==200){
          AllKeepPackage = JSON.parse(xhr.responseText);
          console.log(AllKeepPackage[6]);
          keepAttras = AllKeepPackage[0];
          keepGroups = AllKeepPackage[1];
          keepSches = AllKeepPackage[2];
          keepBlogs = AllKeepPackage[3];
          memSches = AllKeepPackage[4];
          memGroups = AllKeepPackage[5];
          memBlogs = AllKeepPackage[6];
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
          new Vue({
              el: '#groupForKeep', 
              data: {      
                  keepGroups,
              },
          });
          new Vue({
              el: '#scheForKeep', 
              data: {
                  keepSches,
              },
          });
          new Vue({
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
var ss = new Vue({
    el: '#scheLightBox', 
    data: {      
        QueryCards:{}
    }, 
})
function openScheCardLightBox(obj){
    scheLightBox.style.display = "block";
    myScheName = obj.dataset.id;
    // console.log(myScheName);
    keepSchetInfo = {
        Spot_Id:myScheName
    };
    console.log(keepSchetInfo);
   
    let xhr = new XMLHttpRequest();
    xhr.open("post", "./openQueryCards.php", true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    //把資料往後傳
    xhr.send("keepSchetInfo=" + JSON.stringify(keepSchetInfo));   
    xhr.onload = function(){
        if(xhr.status==200){
            let QueryCards = JSON.parse(xhr.responseText);
            sche.$data.QueryCards = QueryCards;
        }else{
            alert(xhr.status);
        }
    }
  }
 
  
function closescheLightBox(){
    scheLightBox.style.display = "none";
  }