<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<?php require_once("./phpTemplate/head.php");?> 
<style>
        .nav-linkblogView::after {
        width: 100% !important;
    }
</style>

<body>
    <?php require_once("./phpTemplate/nav.php");?> 
    <?php require_once("./phpTemplate/blogShow.php");?> 
    <?php require_once("./phpTemplate/footer.php");?> 

</body>

</html>
