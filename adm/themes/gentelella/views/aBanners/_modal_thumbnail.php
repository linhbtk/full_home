<?php
    /* @var $model ABanners*/
    /* @var $form CActiveForm */
?>
<div class="modal fade img_thumbnail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= $model->title ?></h4>
            </div>

            <div class="modal-body">
                <?php
                    // Render detail form
                    $this->renderPartial('_upload_thumbnail_form', array(
                        'model'       => $model
                    ));
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom:5px"><i
                        class="fa fa-close"></i> Đóng
                </button>
            </div>
        </div>
    </div>
</div>