<?php

if(isset($_FILES['photo']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  /*
  echo '<pre>';
  print_r($_FILES['photo']);
  echo '</pre>';
  */

  $file_name = $_FILES['photo']['name'];
  $file_type = $_FILES['photo']['type'];
  $file_tmp = $_FILES['photo']['tmp_name'];
  $file_error = $_FILES['photo']['error'];
  $file_size = $_FILES['photo']['size'];

  //Extensions allowed.
  $ext_allows = array("jpeg", "jpg", "png", "bmp");
  $size_allow = 2097152;   //2MB.

  //Extracting the extension from the file.
  $file_ext = explode(".", $file_name);
  $file_ext = end($file_ext);
  $file_ext = strtolower($file_ext);

  //Checking for error in the file.
  if($file_error <= 0){
    //No Error in file.

    //Checking for correct extension of the file.
    if(in_array($file_ext, $ext_allows) === true){
      //Correct extension.

      //Checking the size of the file.
      if($file_size <= $size_allow){
        //Appropriate size.

        //Uploading the file.
        $new_name = time() . '.' . $file_ext;
        move_uploaded_file($file_tmp, 'uploads/'.$new_name);
        echo 'File uploaded successfully.';

        echo '<br/><img src="uploads/'.$new_name.'" style="height: 200px; width: 200px;">';

      }else{
        //Inappropriate size.
        echo 'File size must be 2MB or less in size.';
      }
    }else{
      //Incorrect extension.
      echo 'Extension not allowed.';
      return false;
    }

  }else{
    //Error in the file.
    echo 'Error in the file.';
    return false;
  }

}else{
  echo 'Failed';
}

?>
