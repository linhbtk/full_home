<?php

    class ViettelMsisdnDetect
    {
        public $channel_code = 'VIETTEL';

        public static function detect()
        {
            if (!Yii::app()->request->isAjaxRequest && Yii::app()->request->getRequestType() == 'GET') { // avoid ajax request
                if (!isset(Yii::app()->session['session_data']->current_msisdn) || Yii::app()->session['session_data']->current_msisdn == '') { // customer's phonenumber is not detected

                    $generator       = new PaymentCentech();

                    if (!isset($_GET['data'])) { // avoid repeat redirect
                        $service_id = 199;
                        $url        = WCustomers::createPaymentLink(Yii::app()->session['session_data']->current_msisdn, 'DETECTION', $service_id);
                        Yii::app()->getController()->redirect($url);

                    } else {
                        $data_encrypted = $_GET['data'];
                        $signature      = $_GET['signature'];
                        $generator->decryptDetection(Yii::app()->params->cp_id, $data_encrypted, $signature);
                    }
                } else {
                    $generator      = new PaymentCentech();
                    $data_encrypted = $_GET['data'];
                    $signature      = $_GET['signature'];
                    $pay_return     = $generator->decryptDetection(Yii::app()->params->cp_id, $data_encrypted, $signature);
                   

                    if (is_array($pay_return)) {
                        if (isset($pay_return['cmd']) && $pay_return['cmd'] != PaymentCentech::DETECTION) {

                            if (isset($pay_return['responsecode']) && $pay_return['responsecode'] == PaymentCentech::PAYMENTSUCCESS) {
                                if (isset($pay_return['cmd']) && $pay_return['cmd'] == PaymentCentech::REGISTER) {
                                    Yii::app()->session['session_data']->reg_success[] = $pay_return['serviceid'];
                                    $package_name = WCustomers::getPackage($pay_return['serviceid'])['package_name'];
                                    $desc                                              = "Bạn đã đăng ký thành công dịch vụ CiTV [$package_name].\\nVui lòng kiểm tra tin nhắn trong máy điện thoại";
                                    $url = Yii::app()->createUrl('site/customer');
                                    echo "<script>alert('$desc'); location.href='".$url."'</script>";

                                } elseif (isset($pay_return['cmd']) && $pay_return['cmd'] == PaymentCentech::CANCEL) {
                                    $desc = "Hủy dịch vụ thành công";
                                } else {
                                    $desc = "Thao tác thành công";
                                }
                            } else {
                                if (isset($pay_return['cmd']) && $pay_return['cmd'] == PaymentCentech::CANCEL) {
                                    $desc = "Hủy dịch vụ không thành công";
                                }else{
                                    $desc = "Đăng ký không thành công do thuê bao không đủ điều kiện. Chi tiết LH 18006389 (miễn phí)";
                                }

                            }

                            echo "<script>alert('$desc');</script>";
                        }
                    }
                }
            }
        }
    }

?>