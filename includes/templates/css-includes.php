    <!-- css files -->
    <link rel="stylesheet" href="<?php echo $css; ?>normalize.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $node; ?>bootstrap-icons/font/bootstrap-icons.css">
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="<?php echo $css; ?>all.min.css">
    
    <!-- check if current page contains table to include_once table dependencies -->
    <?php if (isset($is_contain_table) && $is_contain_table == true) { ?>
        <link rel="stylesheet" href="<?php echo $node; ?>datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="<?php echo $node; ?>datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css">
    <?php } ?>
        
    <?php if (isset($isHomePage) && $isHomePage == true) { ?>
        <link rel="stylesheet" href="<?php echo $fonts . $curr_version ?>/cairo.css">
        <link rel="stylesheet" href="<?php echo $landpg ?>css/index.css">
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo $css . $curr_version; ?>/global.css">
    <?php } ?>
            
    <?php if (strtolower($pageTitle) === strtolower("Login")) { ?>
        <!-- check if it login page -->
        <link rel="stylesheet" href="<?php echo $css ?>login.css">
    <?php } else if (strtolower($pageTitle) === strtolower("Sign up")) { ?>
        <link rel="stylesheet" href="<?php echo $css . $curr_version; ?>/sign-up.css">
    <?php } ?>
    
    <!-- page icon -->
    <link rel="icon" href="<?php echo $assets ?>leadergroupegypt.jpg">

    <?php if (isset($_SESSION['systemLang']) && $_SESSION['systemLang'] == "ar") { ?>
        <style>
            .nav-link {direction: rtl}
        </style>
    <?php } ?>

    
