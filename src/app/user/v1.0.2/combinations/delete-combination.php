<?php
// get malfunction id
$combID = isset($_GET['combid']) && intval($_GET['combid']) ? intval($_GET['combid']) : 0;
// check if the current malfunction id is exist or not
$check = checkItem("`comb_id`", "`combinations`", $combID);
?>
<!-- start edit profile page -->
<div class="container">
    <!-- start header -->
    <header class="header">
        <h1 class="text-capitalize"><?php echo language('DELETE', $_SESSION['systemLang'])." ".language('THE COMBINATION', $_SESSION['systemLang']) ?></h1>
        <?php
        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM `combinations` WHERE `comb_id` = :combid");
            $stmt->bindParam(":combid", $combID);
            $stmt->execute();
            // log message
            $logMsg = "Combination dept: deleted combination successfully!.";
            // createLogs($_SESSION['UserName'], $logMsg);

            // show the successfull messgae
            $msg  = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;the malfunction deleted succefully!</div>';
            redirectHome($msg);
        } else {
            // show the warning messgae
            $msg  = '<div class="alert alert-success text-capitalize"><i class="bi bi-check-circle-fill"></i>&nbsp;there is no such id like ' . $combID . '</div>';
            redirectHome($msg);
        }
        ?>
    </header>
</div>