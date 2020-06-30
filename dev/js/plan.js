// $(document).ready(function(){

  col_lg_8 = document.getElementsByClassName("col-lg-8")[0];
  col_lg_4 = document.getElementsByClassName("col-lg-4")[0];
  function myFunction(){
    if(window.innerWidth < 992){
      col_lg_8.style.display = "none";
      col_lg_4.style.display = "block";
    } else {
      col_lg_8.style.display = "block";
      col_lg_4.style.display = "block";
    }
  }
      
  function changePlanAndSearch() {
    mybutton = document.getElementById("changePlanAndSearch");
    mybuttonText = mybutton.innerText;
    if(mybuttonText =="搜尋") {
      mybutton.innerText = "排行程";
      col_lg_8.style.display ="block";
      col_lg_4.style.display = "none";
    } else {
      mybutton.innerText = "搜尋";
      col_lg_8.style.display = "none";
      col_lg_4.style.display = "block";
    }
  }
  window.addEventListener("resize", myFunction); 
  
  let isOpenPlanWall = true;
  function openPlanWall(){
    if(isOpenPlanWall == true){
      document.getElementsByClassName("planWall")[0].style.display = "none";
      document.getElementById("openPlanWall").innerHTML = `<img src='./images/icon/global.png' alt=''>查看地圖`
      document.getElementsByClassName("planminus")[0].innerText = `+`;
      return isOpenPlanWall=false;
    } else{
      document.getElementsByClassName("planWall")[0].style.display = "block";
      document.getElementById("openPlanWall").innerHTML = `<img src='./images/icon/grey_search.png' alt=''>搜尋景點`
      document.getElementsByClassName("planminus")[0].innerText = `-`;
      return isOpenPlanWall=true;
    }
  } 
  
  function changeTransWay(index){
    transSelect = document.getElementsByClassName("transSelect")[0];
    transWayClick = document.getElementsByClassName("transWayClick")[0];
    if(index == 0){
      document.getElementById("car").src = "./images/icon/car_w.png";
    }else if(index == 1){
      document.getElementById("train").src = "./images/icon/train_w.png";
    }else{
      document.getElementById("walking").src = "./images/icon/walking_w.png";
    }
    transWayIconUrl = document.getElementsByClassName("transWayClick")[0].childNodes[0].src;
    transWayIconUrl = transWayIconUrl.replace(/_w/,"");
    transWayClick.childNodes[0].src = transWayIconUrl;
    transWayClick.className="transWay";
    transSelect.children[index].className ="transWayClick";
  }
  
  isPlanKeepWall = false;
  keepWall = document.getElementsByClassName("planKeepWall")[0]
  function openPlanKeepWall(){
    if(isOpenPlanWall == true){
      keepWall.style.display ="none";
      isOpenPlanWall=false;
    } else{
      keepWall.style.display ="flex";
      isOpenPlanWall=true;
    }
    console.log(isOpenPlanWall);
    return isOpenPlanWall;
  }
  
  
  let left = 0;
  dateWall = document.getElementsByClassName('planDate')[0];
  dateWallWidth = window.getComputedStyle(dateWall,null).getPropertyValue("width");
  dateBlock = document.getElementsByClassName('dateBlock')[0];
  datedateBlock = parseInt(window.getComputedStyle(dateBlock,null).getPropertyValue("width"));
  datedateBlockLenght = document.getElementsByClassName('dateBlock').length;
  dateRedpixelWidth = datedateBlockLenght * datedateBlock;
  document.getElementsByClassName("sliderInnerblock")[0].style.width = dateRedpixelWidth;
  sliderInnerblock = document.getElementsByClassName("sliderInnerblock")[0];
  function goRight(){  
  if(parseInt(dateWallWidth) > parseInt(dateRedpixelWidth)){
    left=0;
  }else{
    if(left==0){
      left =0;
    }else {
      left+=20;
      sliderInnerblock.style.left = left + "px";
    }      
  }
  }
  function goLeft(){
    if(parseInt(dateWallWidth) > parseInt(dateRedpixelWidth)){
      left=0;
    }else {
      left-=20;
      sliderInnerblock.style.left = left + "px";
    }
  }


// })