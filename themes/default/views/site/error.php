<?php
    $this->pageTitle   = Yii::app()->name . ' - Error';
    $this->breadcrumbs = array(
        'Error',
    );
?>
<div class="page-error container wrap">
    <div class="content">
        <div class="error-logo">
            <h1 class="error-code">
                <img class="error-image" src="<?php echo Yii::app()->theme->baseUrl ?>/images/page-404/logo.png"/>
            </h1>
            <p class="error-message">
                <i class="fa fa-info-circle"></i>
                Có lỗi xảy ra, trang bạn yêu cầu không tồn tại!
            </p>
            <p class="error-guide">
                <a href="#" class="btn btn-primary" onclick="return window.history.back()">Quay lại trang trước</a>
                <span class="or-text">hoặc</span>
                <a href="<?= Yii::app()->createAbsoluteUrl('/') ?>" class="btn btn-success" title="vinaplay">
                    Về trang chủ
                </a>
            </p>
        </div>
    </div>

</div>
