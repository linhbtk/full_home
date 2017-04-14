<script>
    function secondsToTime2($seconds) {
        var check_is_character = $seconds.split(':');
        if(check_is_character.length>1){
            return $seconds;
        }

        // extract hours
        var $hours = Math.floor($seconds / (60 * 60));

        // extract minutes
        var $divisor_for_minutes = $seconds % (60 * 60);
        var $minutes = Math.floor($divisor_for_minutes / 60);

        // extract the remaining seconds
        var $divisor_for_seconds = $divisor_for_minutes % 60;
        var $seconds = Math.ceil($divisor_for_seconds);

        if ($hours < 10) {
            $hours = '0' + $hours;
        }
        if ($minutes < 10) {
            $minutes = '0' + $minutes;
        }
        if ($seconds < 10) {
            $seconds = '0' + $seconds;
        }
        // return the final array
        if ($hours > 0) {
            return $hours + ":" + $minutes + ":" + $seconds + "";
        }
        else if ($minutes > 0) {
            return $minutes + ":" + $seconds + "";
        }
        else {
            return $seconds + "";
        }
    }
</script>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'           => 'videos-grid',
    'type'         => 'bordered',
    'dataProvider' => $modelFiles->search($model->id),
    'columns'      => array(
        array(
            'header'      => Yii::t('adm/video', 'row_number'),
            'type'        => 'raw',
            'value'       => function ($data, $row) {
                return ++$row . '<input name="vieo_id_"' . $data->id . '" id="vieo_id_"' . $data->id . '" type="hidden" value="' . $data->id . '">';
            },
            'htmlOptions' => array('width' => 30, 'style' => 'vertical-align:middle;')
        ),
        array(
            'name'        => 'part_number',
            'type'        => 'raw',
            'value'       => function ($data) {
                $video_url = $data->createUrl('web', false);

                $return = CHtml::link(
                    '<i class="glyphicon glyphicon-facetime-video"></i> Xem trước',
                    '#modal_preview_video',
                    array('data-toggle' => 'modal',
                          'class'       => 'preview',
                          'onClick'     => 'jwplayer("jwplayer_video").setup({sources: [{file: "' . $video_url . '"}], width: "100%"});',
                    ));
                $return .= '<p>';
                $return .= '<p>Tải lên lúc ';
                $return .= '<br><span style="font-style: italic;font-size: 12px;">' . date('d/m/Y H:i:s', strtotime($data->upload_time)) . '</span>';
                return $return;

            },
            'htmlOptions' => array('style' => 'width:120px;vertical-align:middle;word-break: break-word;')
        ),
        array(
            'name'        => 'file_ext',
            'value'       => '".".$data->file_ext',
            'htmlOptions' => array('width' => 80, 'style' => 'vertical-align:middle;')
        ),

        array(
            'class'       => 'booster.widgets.TbEditableColumn',
            'name'        => 'quality',
            'sortable'    => false,
            'editable'    => array(
                'type'       => 'select2',
                'url'        => array('aMedia/updateFileInfo', array('attribute' => 'quality', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)),
                'placement'  => 'right',
                'inputclass' => 'span3',
                'source'     => AMediaFiles::model()->getQualityList2()
            ),
            'htmlOptions' => array('width' => 90, 'style' => 'vertical-align:middle;')
        ),
        array(
            'name'        => 'file_size',
            'value'       => 'AFunction::formatSizeUnits($data->file_size)',
            'htmlOptions' => array('width' => 90, 'style' => 'vertical-align:middle;')
        ),
        array(
            'class'       => 'booster.widgets.TbEditableColumn',
            'name'        => 'duration',
            'sortable'    => false,
            'editable'    => array(
                'type'      => 'text',
                'url'       => array('aMedia/updateFileInfo', array('attribute' => 'duration', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)),
                'placement' => 'right',
                'display'   => 'js: function(value, sourceData) {
  var escapedValue = $("<div>").text(value).html();  
  $(this).html("<b>" + secondsToTime2(escapedValue) + "</b>")
}'
            ),
            'htmlOptions' => array('width' => 90, 'style' => 'vertical-align:middle;'),

        ),
        array(
            'header'      => Yii::t('adm/video', 'file_status'),
            'type'        => 'raw',
            'value'       => function ($data) {
                //Check File Exist
                $file_path = '../' . $data->folder_path . $data->file_name . '.' . $data->file_ext;
                if (is_file($file_path) && file_exists($file_path)) {
                    return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/tick.png');
                } else {
                    return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/publish_x.png');
                }
            },
            'htmlOptions' => array('style' => 'width:130px;vertical-align:middle;text-align:center;')
        ),
        array(
            'header'      => 'Xóa',
            'type'        => 'raw',
            'value'       => function ($data) {
                $video_url = $data->createUrl('web', false);
                return CHtml::link(
                    '<i class="glyphicon glyphicon-trash"></i>',
                    Yii::app()->createUrl('aMedia/files', array('id' => $data->media_id, 'action' => 'delete', 'files_id' => $data->id))
                );
            },
            'htmlOptions' => array('width' => '30px', 'style' => 'vertical-align:middle;'),
        ),
    ),
)); ?>

