<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <?php
        $endScriptTime = microtime(TRUE);
        $totalScriptTime = $endScriptTime - $startScriptTime;
        echo "Executed in " . number_format($totalScriptTime, 4) . " seconds";
        ?>
    </div>

    <p>&copy; 2018 - <?php echo date('Y'); ?> <a href="https://github.com/arif98741/" target="_blank">Ariful
            Islam</a>, All Rights Reserved |
        Version: <strong>V4.0.1</strong> | Access IP: <strong><?php echo $_SERVER['REMOTE_ADDR']; ?></strong>
    </p>


</footer>

<div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->
<?php include "lib/js/scripts.php"; //scripts file put at lib/js/scripts/js  ?>
<?php include("lib/footer_modal.php"); //all modal content and design in footer_modal.php ?>


</body>
</html>
