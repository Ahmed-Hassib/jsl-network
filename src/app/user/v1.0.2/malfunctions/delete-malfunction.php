<?php
// get malfunction id
$malID = isset($_GET['malid']) && intval($_GET['malid']) ? intval($_GET['malid']) : 0;
// check if the current malfunction id is exist or not
$check = checkItem("`mal_id`", "`malfunctions`", $malID);
?>
<!-- start edit profile page -->
<div class="container">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('DELETE', $_SESSION['systemLang'])." ".language('THE MALFUNCTION', $_SESSION['systemLang']) ?></h1>
        <?php
        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM `malfunctions` WHERE `mal_id` = :malid; DELETE FROM `malfunctions_media` WHERE `mal_id` = :malid;");
            $stmt->bindParam(":malid", $malID);
            $stmt->execute();
            // show the successfull messgae
            $msg  = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;the malfunction deleted succefully!</div>';
            redirectHome($msg);
        } else {
            // show the warning messgae
            $msg  = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;there is no such id like ' . $malID . '</div>';
            redirectHome($msg);
        }
        ?>
    </header>
</div>