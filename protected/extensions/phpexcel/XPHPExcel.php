<?php

    /**
     * Wrapper for the PHPExcel library.
     *
     * @see README.md
     */
    class XPHPExcel extends CComponent
    {
        private static $_isInitialized = false;

        /**
         * Register autoloader.
         */
        public static function init()
        {
            if (!self::$_isInitialized) {
                spl_autoload_unregister(array('YiiBase', 'autoload'));
                require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                spl_autoload_register(array('YiiBase', 'autoload'));

                self::$_isInitialized = true;
            }
        }

        /**
         * Returns new PHPExcel object. Automatically registers autoloader.
         *
         * @return PHPExcel
         */
        public static function createPHPExcel()
        {
            self::init();

            return new PHPExcel;
        }

        public static function import($modelName, $path, $uploadFile)
        {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (isset($uploadFile)) {
                $type = $uploadFile->getExtensionName();
                if ($type != 'xls' && $type != 'xlsx') {
                    return array('error' => 'Sai định dạng file!');
                }

                $fileName = "{$uploadFile}";
                $fileName = time() . '_' . str_replace(' ', '_', strtolower($fileName));

                $uploadFile->saveAs($path . $fileName);

                if (!file_exists($path . $fileName)) {
                    return array('error' => 'Upload failed!');
                }

                if ($type == 'xls')
                    $objReader = PHPExcel_IOFactory::createReader('Excel5');
                else
                    $objReader = PHPExcel_IOFactory::createReader('Excel2007');

                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($path . $fileName);
                $worksheet   = $objPHPExcel->setActiveSheetIndex(0);

                $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                $model        = new $modelName();
                $array_fields = Yii::app()->db->schema->getTable($model->tableSchema->name)->getColumnNames();

                $array_fields_exits = array();
                $data               = array();
                $error_msg          = array();
                $data_obj           = array();
                for ($row = 1; $row <= $highestRow; ++$row) {
                    //--- read each excel column for each row ----
                    $item = array();
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        if ($row == 1) {
                            // show column name with the title
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val  = $cell->getValue();
                            //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//                            if (in_array($val, $array_fields) && $val != 'id') {
                            if (in_array($val, $array_fields)) {
                                $array_fields_exits[$col] = $val;
                            }
                        } else {
                            //----- get value ----
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val  = $cell->getValue();
                            if (isset($array_fields_exits[$col]) && $val != '') {
                                //format lại định dạng date YYYY-MM-DD
                                $field_is_date = array(
                                    'publish_time',
                                    'public_time',
                                    'create_time',
                                    'last_update',
                                );
                                if (in_array($array_fields_exits[$col], $field_is_date)) {
//                                    $val = str_replace('/', '-', $val);
                                    $val = date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP($val));
                                }

                                $item[$array_fields_exits[$col]] = $val;
                            }
                            //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        }
                    }
                    if ($item) {
                        //validate...dòng thứ bao nhiêu, vì sao
                        $model             = new $modelName();
                        $model->attributes = $item;
                        $model->scenario   = 'import';
                        $errors            = CActiveForm::validate($model);
                        if ($errors != '[]') {
                            foreach (json_decode($errors) as $error) {
                                foreach ($error as $value) {
                                    $error_msg[] = '<p><strong>Cell ' . PHPExcel_Cell::stringFromColumnIndex($col - 1) . $row . ':</strong> ' . $value . '</p>';
                                }
                            }
                        } else {
                            $data[]     = $item;
                            $data_obj[] = $model;
                        }
                    }
                }

                // delete file
                unlink($path . $fileName);

                if ($error_msg) {
                    $error_msg[] = '<br/><div><strong>Bạn cần sửa các lỗi trên và upload lại file!</strong></div>';

                    return array('error' => implode('', $error_msg));
                }

                if (!$data) {
                    return array('error' => 'File không có dữ liệu phù hợp!');
                }

//                $builder = Yii::app()->db->schema->commandBuilder;
//                $command = $builder->createMultipleInsertCommand($model->tableSchema->name, $data);
//                $command->execute();

                foreach ($data_obj as $objItem) {
                    $objItem->save();
                }


                //tổng số row đã import thành công
                return array('success' => "Import dữ liệu thành công <strong>" . count($data) . " rows</strong>!");
            }
        }
    }