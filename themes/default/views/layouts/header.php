<div id="header">
    <div class="space_10"></div>
    <div class="container">
        <div class="col-md-6">
            <a href="<?= Yii::app()->controller->createUrl('site/index'); ?>" title="">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/logo.png" class="logo" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <form class="navbar-form" role="search">
                <div class="input-group add-on">
                    <input class="form-control" placeholder="" name="srch-term" id="srch-term" type="text">

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>