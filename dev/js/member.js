 
//keep click hearts 
function keepSpotLike(obj){
  str = /heart.png/;
  iskeep = str.test(obj.firstChild.src);
  if(iskeep){
    obj.firstChild.src = "./images/heart_r.png";
    iskeep = false;
  }else{
    obj.firstChild.src = "./images/heart.png";
    iskeep = true;
  }
}

