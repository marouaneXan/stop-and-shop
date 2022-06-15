<?php


function url($url = '')
{
  echo URL . $url;
}

// Function to upload image
// function uploadImage($oldImage = 'NULL')
// {
//   $target_dir = "../../../frontend/src/assets/uploads";
//   $target_file = $target_dir . basename($_FILES["image"]["name"]);
//   $uploadOk = 1;
//   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//   $types = array('jpg', 'png', 'jpeg', 'gif');
//   $imageName = htmlspecialchars(basename($_FILES["image"]["name"]));

//   // Check Type of Image
//   // if ($imageFileType !='png' || $imageFileType != 'jpg' || $imageFileType != 'jpge' || $imageFileType != 'gif') {
//   //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   //   $uploadOk = 0;
//   // }

//   // Check size of Image
//   // if ($_FILES["image"]["size"] > 500000) {
//   //   echo "Sorry, your file is too large.";
//   //   $uploadOk = 0;
//   // }

//   // if uploadOk=0 set error
//   if ($uploadOk == 0) {
//     return $oldImage;
//   }
//   // if oldImage=1 set success
//   else {
//     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//       return $imageName;
//     }
//   }
// }
