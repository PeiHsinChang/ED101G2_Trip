
let setupTourn = document.getElementById("setupTourn");
  function closeLightBox(){
    tourname = document.getElementById("tourname").value;
    if(tourname != ""){
      setupTourn.style.display = "none";
      document.getElementById("planName").value = tourname;
    }
  }

  let setupGroup = document.getElementById("setupGroup");
    function openNewGroup(){
        setupGroup.style.display = "block";
    };
    function closeNewGroup(){
        setupGroup.style.display = "none";
    };
