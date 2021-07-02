
        <?php
        session_start();
        
        session_destroy();
        
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=".CONF_URL_BASE."\"/>";
        
      //  header("location:".CONF_URL_BASE."");
        ?>

