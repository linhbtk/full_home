<div id="header">
    <div class="space_10"></div>
    <div class="container">
        <div class="col-md-6">
            <a href="<?= Yii::app()->controller->createUrl('site/index'); ?>" title="">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/logo.png" class="logo" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <form class="navbar-form" role="search"
                  action="<?= Yii::app()->controller->createUrl('products/search', array('q' => '1')); ?>"
                  method="post">
                <?php echo CHtml::hiddenField("YII_CSRF_TOKEN", Yii::app()->request->csrfToken); ?>
                <div class="input-group add-on">
                    <input class="form-control" placeholder="" name="WProduct[keyword]" id="WProduct_keyword"
                           type="text">

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>