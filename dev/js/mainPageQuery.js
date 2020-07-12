window.onload = function (){
  let xhr = new XMLHttpRequest();
  xhr.onload = function(){
      if(xhr.status==200){
          homePageCards = JSON.parse(xhr.responseText);
          console.log(homePageCards[0]);
          homePageGroups = homePageCards[0];
          homePageSpots = homePageCards[1];
          new Vue({
            el: '#homePageGroup', 
            data: {
                homePageGroups,
            },
          });        
          new Vue({
              el: '#homePageSpot', 
              data: { 
                homePageSpots,   
              },
              computed: {
                output(){
                    s ="./images/lake.jpg"
                    return s;  
                }
            }
          });
          new Vue({
            el: '#smallhomePageGroup', 
            data: {
                homePageGroups,
            },
          });        
        new Vue({
          el: '#smallhomePageSpot', 
          data: { 
            homePageSpots,   
          },
          computed: {
            output(){
                s ="./images/lake.jpg"
                return s;  
            }
        }
      });     
      }else{
          alert(xhr.status);
      }
  }
  xhr.open("post", "mainPage.php", true);
  xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
  xhr.send();   
}