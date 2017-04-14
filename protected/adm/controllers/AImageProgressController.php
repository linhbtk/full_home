<?php

    /***
     * Class AImageProgressController
     * Controller for progress image through call ajax
     * Gọi Crop ảnh cần GD Library
     */
    class AImageProgressController extends AController
    {
        public function __construct()
        {


        }

        public function actionIndex()
        {
        }

        /**
         * Crop and Save image to server
         *
         * @use ACropThumbnail class. A PHP class of jquery plugin Croper: https://github.com/fengyuanchen/cropper
         *
         * @param array POST contain all information about file
         *
         */
        public function actionCropImage($dir_upload = NULL)
        {
            if (isset($_POST)) {

                // generate file name
                $imageInfo                             = pathinfo($_FILES['avatar_file']['name']);
                $imageInfo['filename']                 = Utils::unsign_string($imageInfo['filename']) . '-' . time();
                $_FILES['avatar_file']['name']         = $imageInfo['filename'] . '.' . $imageInfo['extension'];
                $_FILES['avatar_file']['basefilename'] = $imageInfo['filename'];

                // init folder to save file
                $max_width = 0;
                if ($dir_upload == 'wallpapers' || $dir_upload == 'ebooks' || $dir_upload == 'games' || $dir_upload == 'videos') {
                    $sourceFile = '../' . $dir_upload . '/uploads/images/temp_original';
                    $saveFileTo = '../' . $dir_upload . '/uploads/images/' . date('Y') . '/' . date('n') . '';

                    //độ rộng tối đa của ảnh
                    $max_width = 500;
                } else {
                    $sourceFile = Yii::app()->params->upload_dir_path . $dir_upload . '/temp_original';
                    $saveFileTo = Yii::app()->params->upload_dir_path . $dir_upload . '/' . date('Y') . '/' . date('n') . '';
                }

                if (!is_dir($sourceFile)) {
                    mkdir($sourceFile, 0777, TRUE);
                }

                if (!is_dir($saveFileTo)) {
                    mkdir($saveFileTo, 0777, TRUE);
                }

                //Gọi Cropimage & upload file
                $crop     = new ACropThumbnail($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file'], $sourceFile, $saveFileTo, $max_width);
                $response = array(
                    'state'   => 200,
                    'message' => $crop->getMsg(),
                    'result'  => $crop->getResult()
                );
                echo json_encode($response);
            } else {
                echo '{"Message" : "Missing params"}';
            }
        }

        public function actionConvertPDFBookToImageAjax()
        {
            $bookFileId = $_POST['bookFileId'];
            $quality    = $_POST['quality'];

            // get book file
            $file = ABookFiles::model()->find('id=:bookFileId', array('bookFileId' => $bookFileId));
            if ($file) {
                // checking existing converted images
                $existingImages = ABookImages::model()->findAll('files_id=:fileId', array('fileId' => $bookFileId));
                if ($existingImages) {
                    foreach ($existingImages as $one) {
                        if (file_exists('../' . $one->uri)) unlink('../' . $one->uri);
                        $one->delete();
                    }
                }

                // change convert status to converting
                $file->convert_image = 1;
                $file->save();

                // init path to file
                $pathToFile      = '../' . $file->folder_path . $file->file_name . '.' . $file->file_ext;
                $pathToSaveImage = '../uploads/books/' . $file->books_id . '/images/';

                // set time limit
                set_time_limit(600);

                // convert file
                $converter = new PDFConverter($pathToFile, $pathToSaveImage);
                $converter->ConvertToImage('png', $quality, $quality);

                if ($converter->ArrayPathImages) {
                    $i = 0;
                    foreach ($converter->ArrayPathImages as $one) {
                        // check existing page
                        $image = ABookImages::model()->find('books_id=:bookId AND page=:page AND languages_id=:language', array('bookId' => $file->books_id, 'page' => $i + 1, 'language' => $file->languages_id));

                        if ($image) {
                            // update this image
                            // delete old image on server
                            // then update new uri of this page
                            unlink('../' . $image->uri);

                            $image->uri      = str_replace('../', '', $one);
                            $image->files_id = $file->id;
                            $image->save();
                        } else {
                            // add new
                            $image               = new ABookImages();
                            $image->books_id     = $file->books_id;
                            $image->page         = $i + 1;
                            $image->uri          = str_replace('../', '', $one);
                            $image->languages_id = $file->languages_id;
                            $image->files_id     = $file->id;
                            $image->save();
                        }


                        unset($image);
                        $i++;
                    }

                    // change convert status to converted
                    $file->convert_image = 2;
                    $file->save();
                }
            }

            echo json_encode(array('Message' => 'Do something....'));
        }


    } //end class
?>