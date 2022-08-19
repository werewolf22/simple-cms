<footer><hr/><br> <span id="copyrignt-content">&copy; 2022 Simple CMS</span></footer>
          </div>
       </body>
</html>
<?php 
     if (isset($con)) {
         mysql_close();
     }
     if (isset($db)) {
     	$db=NULL;
     }     
?>