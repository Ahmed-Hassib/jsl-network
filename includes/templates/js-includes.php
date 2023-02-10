

<?php if (isset($_SESSION['isRoot']) && $_SESSION['isRoot'] != 1) { ?>
    <!-- include_once add new direction modal -->
    <?php include_once $nav_up_level . '/directions/add-direction-modal.php' ?>
<?php } ?>

<!-- save system language to local storage -->
<?php if (strtolower($pageTitle) != strtolower('login') && isset($_SESSION['UserID']) && strtolower($pageTitle) != strtolower('the directions')) { ?>
    <script>
        // assign systemLang to local storage
        localStorage['systemLang']  = '<?php echo $_SESSION['systemLang'] ?>';
        // check current language
        document.body.style.direction = localStorage['systemLang'] == 'ar' ? 'rtl' : 'ltr';
    </script>

<?php } else if (strtolower($pageTitle) == strtolower('the directions')) { ?>
    
    <script src="<?php echo $js; ?>directions.js"></script>
    <script>document.body.style.overflowX = "unset";</script>

<?php } else if (strtolower($pageTitle) == strtolower('login')) { ?>

    <script>localStorage.removeItem('sidebarMenuClosed');</script>

<?php } else if (strtolower($pageTitle) === strtolower("Sign up")) { ?>

    <script src="<?php echo $js . $curr_version; ?>/sign-up.js"></script>

<?php } ?>

<!-- jquery library -->
<script src="<?php echo $js; ?>jquery-3.5.1.min.js"></script>
<!-- jquery library -->
<script src="<?php echo $js; ?>bootstrap.min.js"></script>

<!-- check if current page contains table to include_once table dependencies -->
<?php if (isset($is_contain_table) && $is_contain_table == true) { ?>
    <script src="<?php echo $node; ?>jszip/dist/jszip.min.js"></script>
    <script src="<?php echo $node; ?>pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo $node; ?>pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo $node; ?>datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $node; ?>datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo $node; ?>datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $node; ?>datatables.net-buttons/js/buttons.colVis.js"></script>
    <script src="<?php echo $node; ?>datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo $node; ?>datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo $node; ?>datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="<?php echo $js . $curr_version; ?>/table-behaviour.js"></script>
<?php } ?>

<script src="<?php echo $js; ?>all.min.js"></script>

<?php if (!isset($noNavBar)) { ?>
    <!-- js main file -->
    <script src="<?php echo $js . $curr_version; ?>/global.js"></script>
    <script src="<?php echo $js . $curr_version; ?>/sidebar-menu.js"></script>
<?php } ?>

<?php if ($level == 0) { ?>
    <script src="<?php echo $landpg ?>js/index.js"></script>
    <script>
        // assign systemLang to local storage
        localStorage['systemLang']  = 'ar';
        // check current language
        document.body.style.direction = 'rtl';
    </script>
<?php } ?>



</body>
</html>

