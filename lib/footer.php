 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <?php 
      $endScriptTime=microtime(TRUE);
		$totalScriptTime=$endScriptTime-$startScriptTime;
		echo "Executed in ".number_format($totalScriptTime, 4)." seconds";
       ?>
    </div>
    <strong>Copyright &copy; 2017 - <?php echo date('Y'); ?> <a href="http://arif98741.github.io/profile" target="_blank">Ariful Islam</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include "lib/js/scripts.php"; //scripts file put at lib/js/scripts/js  ?>
<?php include("lib/footer_modal.php"); //all modal content and design in footer_modal.php ?>

</body>
</html>
