<?php

class FileOperation
{
    /**returns 'success' if successfull else returns error message*/
    public function imageUpload($imageName, $target_dir)
    {

        //if directory does not exists, it is created
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["image"]["name"]); //directory + filename of file which is being uploaded
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //file extension in lower case
        $destination = $target_dir . $imageName . '.' . $imageFileType;//destination directory and file name
        $uploadOk = true;
        $return_param = array();
        $return_param['msg'] = '';

        //if image then we get dimension
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        //check if the file is an image
        if ($check == false) {
            $return_param['msg'] = $return_param['msg'] . ' ' . "File is not an image.";
            $uploadOk = false;
        }

        // Check if file already exists
        if (file_exists($destination)) {
            $return_param['msg'] = $return_param['msg'] . ' ' . "Sorry, file already exists.";
            $uploadOk = false;
        }

        // Check file size, here it's 500KB
        if ($_FILES["image"]["size"] > 500000) {
            $return_param['msg'] = $return_param['msg'] . ' ' . "Sorry, your file is too large.";
            $uploadOk = false;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $return_param['msg'] = $return_param['msg'] . ' ' . "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = false;
        }

        // Check if $uploadOk is set to false by an error
        if (!$uploadOk) {
            $return_param['status'] = 'error';
            return $return_param;
        } else {
            // if everything is ok, try to upload file
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) { //(upload temporary dir to target dir)(including file name)
                $return_param['status'] = 'error';
                $return_param['msg'] = "Sorry, there was an error uploading your file.";
                return $return_param;
            }else{
                $return_param['status'] = 'success';
                $return_param['msg'] = $destination;
                return $return_param;
            }
        }
    }
}
