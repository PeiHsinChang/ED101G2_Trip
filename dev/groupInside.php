<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<?php require_once("./phpTemplate/head.php");?> 
<style>
       /* scrollbar hidden */
  html {
    overflow: -moz-hidden-unscrollable;
    height: 100%;
  }

  body::-webkit-scrollbar {
    display: none;
  }

  body {
    -ms-overflow-style: none;
    height: 100%;
	width: calc(100vw + 18px);
	overflow: auto;
  }
</style>

<body>
    <?php require_once("./phpTemplate/nav.php");?> 
    <?php require_once("./phpTemplate/groupShow.php");?> 
    <?php require_once("./phpTemplate/footer.php");?> 

    <div id="setupGroup" class="lightBoxWall" style="overflow-y: scroll;">
        <?php require_once("./phpTemplate/setupGroup.php");?> 
    </div>
</body>
<script>
    let setupGroup = document.getElementById("setupGroup");
    function openNewGroup(){
        setupGroup.style.display = "block";
        $("body").css({'overflow':'hidden'});
        $("body").css('position','fixed');
        $.ajax({
            type: "POST",
            url: 'getGroupList.php',
            success: function(response){
                $('#grouplistSelect').html('');
                if ($.parseJSON(response).length>0){
                    let schedules = $.parseJSON(response);
                    console.log(schedules);
                    schedulesArray = schedules;
                    $.each(schedules, function( index, value ) {
                        $('#grouplistSelect')
                        .append($("<option></option>")
                        .attr("value",schedules[index].Sche_Name)
                        .text(schedules[index].Sche_Name));
                    });
                    // let schedele = schedulesArray[0];
                    // $('#partdate').val(schedele.Group_Deadline);
                    // $('#startdate').val(schedele.Group_StartDate);
                    // $('#enddate').val(schedele.Group_EndDate);
                    // $('#partname').val(schedele.Group_title);
                    // $('#partlimit').val(schedele.Group_Ppl);
                    // $('#gendercho').val(schedele.Group_Sex);
                    // $('#yearlimitcho').val(schedele.Group_Age);
                    // $('#estmoney').val(schedele.Group_Fee);
                    // $('#gatherplace').val(schedele.Group_Place);
                    // $('#memogroup').val(schedele.Group_Com);
                    // $('#myImg').attr('src',schedele.Group_Pic)
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                alert(xhr.status);
                alert(thrownError);
            }
        });
    };
    function closeNewGroup(){
        setupGroup.style.display = "none";
        $("body").css({'overflow-y':'visible'});
        $('body').css('position','initial');
    };
</script>
</html>
