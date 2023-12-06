<?php

class Image{
  public function crop_image($original_file_name, $cropped_file_name, $width, $height){
    if(file_exists($original_file_name)){
      $original_image = imagecreatefromjpeg($original_file_name);

      $original_width = imagesx($original_image);
      $original_height = imagesy($original_image);

      if($original_height > $original_width){
        $ratio = $width / $original_width;

        $new_width = $width;
        $new_height = $original_height * $ratio;
      }else{
        $ratio = $height / $original_height;

        $new_height = $height;
        $new_width = $original_width * $ratio;
      }
    }

    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

    imagedestroy($original_image);

    if($new_height>$new_width){
      $diff = ($new_height-$new_width);
      $y = round($diff/2);
      $x = 0;
    }else{
      $diff = ($new_width-$new_height);
      $y = 0;
      $x = round($diff/2);
    }

    $new_cropped_image = imagecreatetruecolor($width, $height);
    imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $width, $height, $width, $height);
    imagedestroy($new_image);

    imagepng($new_cropped_image, $cropped_file_name);
    imagedestroy($new_cropped_image);

  }
}