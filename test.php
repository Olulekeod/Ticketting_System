<?php
  

  //move files
  $file='Thankyou';

  if(unlink($file))
  {
      echo "file named $file has been deleted successfully";
  }
  else
  {
      echo "file is not deleted";
  }

//if file is in other folder then do as follows

unlink("cam9/".$file);


  
?>