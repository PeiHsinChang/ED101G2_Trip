$(document).ready(function(){
  let $hamburger = $(".hamburger");
  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    $("#panel").slideToggle("slow");
    // Do something else, like open/close menu
  });
  function openTab(index,tabName) {
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

