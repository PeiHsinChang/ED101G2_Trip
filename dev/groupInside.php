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

  .nav-linkgroupView::after{
    width: 100% !important;
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

    <div id="setupGroup" class="lightBoxWall" style="z-index:20; overflow-y: scroll;">
        <?php require_once("./phpTemplate/setupGroup.php");?> 
    </div>
</body>
<script>
    // let setupGroup = document.getElementById("setupGroup");
    // function openNewGroup(){
    //     setupGroup.style.display = "block";
    //     $("body").css({'overflow':'hidden'});
    //     $('body').css('position','fixed');
    // };
    // function closeNewGroup(){
    //     setupGroup.style.display = "none";
    //     $("body").css({'overflow-y':'visible'});
    //     $('body').css('position','initial');
    // };
</script>

<script>
    let setupGroup = document.getElementById("setupGroup");
    function openNewGroup() {
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
                        .append($("<option id="+schedules[index].Sche_NO+"></option>")
                        .attr("value",schedules[index].Sche_NO)
                        .text(schedules[index].Sche_Name));
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError){
                alert(xhr.status);
                alert(thrownError);
            }
        });
    };

    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
    };

    function closeNewGroup() {
        setupGroup.style.display = "none";
        $("body").css({'overflow-y':'visible'});
        $('body').css('position','initial');
    };


    // $('#setgroupSubmit').click(function() {
        //檢查是否有上傳照片
        // if(!($('#file-upload').get(0).files.length== 0)){
        //         let file_data = $('#file-upload').prop('files')[0];
        //         let form_data = new FormData();
        //         form_data.append('Mem_NO', userObj.Mem_NO);
        //         form_data.append('Mem_Name', userObj.Mem_Name);
        //         form_data.append('groupno', userObj.Mem_Name);
        //         form_data.append('file', file_data);
        //         $.ajax({
        //             url: "uploadGroupPic.php",
        //             type: "POST",
        //             data: form_data,
        //             contentType: false,
        //             cache: false,
        //             processData:false,
        //             success: function(data){

        //             }
        //         });
        // }

        // $( "#setupform" ).submit(function (e) {
        //     e.preventDefault();
        //     console.log('hihi');
        // });
        // $.ajax({
        //     type: "POST",
        //     url: 'submission.php',
        //     data: {email: email},
        //     success: function(data){
        //         alert(data);
        //     }
        // });
    // });

</script>
</html>
