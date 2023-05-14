<?php
  session_start();
  $_SESSION['general_id'] = "";
  $_SESSION['merchant_id'] = "";
  $_SESSION['manager_id'] = "";
  $_SESSION['identity'] = "";
  $_SESSION['user_info'] = null;
  $_SESSION['user_check_info'] = null;
  header('location:log_in.php?method=message&&message=已登出');
?>