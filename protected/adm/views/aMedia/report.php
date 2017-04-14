<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        Yii::t('adm/app', 'manage'),
    );

    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl . '/themes/gentelella/js/jquery.battatech.excelexport.js');
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Yii::t('adm/app', 'manage'); ?></h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="clearfix"></div>

        <?php $this->widget(
            'booster.widgets.TbTabs',
            array(
                'type'        => 'tabs',
                'tabs'        => array(
                    array(
                        'label'   => Yii::t('adm/media', 'status_' . AMedia::ACTIVE),
                        'content' => $this->renderPartial('_tab_report_by_status', array('model' => $model, 'type' => AMedia::ACTIVE), TRUE),
                        'active'  => TRUE,
                    ),
                    array(
                        'label'   => Yii::t('adm/media', 'status_' . AMedia::INACTIVE),
                        'content' => $this->renderPartial('_tab_report_by_status', array('model' => $model, 'type' => AMedia::INACTIVE), TRUE),
                    ),
                    array(
                        'label'   => Yii::t('adm/media', 'status_' . AMedia::PENDING),
                        'content' => $this->renderPartial('_tab_report_by_status', array('model' => $model, 'type' => AMedia::PENDING), TRUE),
                    ),
                ),
                'htmlOptions' => array('class' => 'site_manager')
            )
        );
        ?>
        <!--modal preview video-->
        <?php $this->beginWidget(
            'booster.widgets.TbModal',
            array('id' => 'modal_preview_video', 'htmlOptions' => array('style' => 'z-index: 1041;'))
        ); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4><?php echo Yii::t('adm/media', 'preview'); ?> <span id="video_name"></span></h4>
        </div>

        <div class="modal-body">
            <!-- JWPlayer -->
            ​
            <script src="<?= Yii::app()->theme->baseUrl ?>/js/jwplayer/jwplayer.js"></script>
            <script>jwplayer.key = "ekOj7z6QgNVVyJrzCEIIJDRRUIO9zxJkB4eHAQ==";</script>

            <div id="jwplayer_video_admin">Loading the player...</div>

        </div>

        <div class="modal-footer">
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label'       => 'Close',
                    'url'         => '#',
                    'htmlOptions' => array(
                        'data-dismiss' => 'modal')
                )
            ); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php $status_list    = AMedia::model()->getStatusList();
    $status_list_data = '';
    foreach ($status_list as $k => $row) {
        $status_list_data .= "'$k': '$row',";
    }
?>
<script language="javascript">

    //    jwplayer("jwplayer_video").onTime(function (event) {
    //        duration = Math.floor(jwplayer().getDuration());//parseInt()
    //        alert(duration);
    //    });
    function changeStatus(id, current_status, new_status) {
        var array_text = {<?=$status_list_data;?>};
        if (confirm('Đổi trạng thái sang: ' + array_text[new_status] + '?')) {
//            var _url = 'index.php?r=aMedia/setStatus&id=' + id + '&status=' + new_status;
//            location.href = _url;
//            var _url = '';
            $.ajax({

                type: "POST",
                url: '<?=Yii::app()->createUrl('aMedia/setStatus')?>',
                crossDomain: true,
                dataType: 'json',
                data: {id: id, status: new_status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
                success: function (result) {
//                    if (current_status == 0) {
//                        _url = 'index.php?r=aMedia/admin#yw3_tab_2';
//                    } else if (current_status = 2) {
//                        _url = 'index.php?r=aMedia/admin#yw3_tab_3';
//                    } else {
//                        _url = 'index.php?r=aMedia/admin';
//                    }
//                    window.location.href = _url;
                    if (result === true) {
                        $('#' + tab).yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        return false;
                    }
                }
            });
        } else {
            window.location.reload(true);
        }
    }

    function setHot(id, status, tab) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aMedia/setHot')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                if (result === true) {
                    $('#' + tab).yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            }
        });
    }

    function openViewVideo($file) {
//        alert($file);
//        $file = '../uploads/media/1.mp4';
        jwplayer("jwplayer_video_admin").setup({sources: [{file: $file}], width: "100%"});
        $('#modal_preview_video').modal('show');

    }

    function ajaxViewVideo(id) {
        var select_data = $('#AMedia_status_' + id).val();
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aMedia/getUrl')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, select_data: select_data, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                openViewVideo(result);
            }
        });
    }


</script>