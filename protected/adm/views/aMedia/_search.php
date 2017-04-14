<div class="wide form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));


    ?>

    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'id'); ?>
    <!--		--><?php //echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'name'); ?>
    <!--		--><?php //echo $form->textField($model,'name',array('size'=>60,'maxlength'=>300)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'unsign_name'); ?>
    <!--		--><?php //echo $form->textField($model,'unsign_name',array('size'=>60,'maxlength'=>300)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'code'); ?>
    <!--		--><?php //echo $form->textField($model,'code',array('size'=>20,'maxlength'=>20)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'short_description'); ?>
    <!--		--><?php //echo $form->textField($model,'short_description',array('size'=>60,'maxlength'=>2000)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'full_description'); ?>
    <!--		--><?php //echo $form->textArea($model,'full_description',array('rows'=>6, 'cols'=>50)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'link'); ?>
    <!--		--><?php //echo $form->textField($model,'link',array('size'=>60,'maxlength'=>500)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'thumbnail'); ?>
    <!--		--><?php //echo $form->textField($model,'thumbnail',array('size'=>60,'maxlength'=>500)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'public_time'); ?>
    <!--		--><?php //echo $form->textField($model,'public_time'); ?>
    <!--	</div>-->
    <!---->
    <div class="row" style="margin-top:30px;">
        <div class="col-md-3 col-ms-3">
            <div class="form-group">
                <!--                --><?php //echo $form->labelEx($model, 'create_time', array('class' => 'control-label')); ?>
                <?php echo $form->textField($model, 'datefrom', array('class' => 'form-control', 'maxlength' => 255)); ?>

            </div>
        </div>
        <!--        <div class="col-md-2 col-ms-2">-->
        <!--        </div>-->
        <div class="col-md-3 col-ms-3">
            <!--            --><?php //echo $form->labelEx($model, 'create_time', array('class' => 'control-label')); ?>
            <?php echo $form->textField($model, 'dateto', array('class' => 'form-control', 'maxlength' => 255)); ?>
        </div>
        <div class="col-md-2 col-ms-2">
            <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary btn-sm')); ?>
        </div>
        <div class="col-md-4 col-ms-4">
            <a class="btn btn-warning" id="export-excel_<?=$type?>" value="Xuất báo cáo" style="float: right;">Xuất báo cáo</a>
        </div>

    </div>
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'type'); ?>
    <!--		--><?php //echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'views'); ?>
    <!--		--><?php //echo $form->textField($model,'views'); ?>
    <!--	</div>-->

    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'created_by'); ?>
    <!--		--><?php //echo $form->textField($model,'created_by',array('size'=>60,'maxlength'=>255)); ?>
    <!--	</div>-->

    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'approved_by'); ?>
    <!--		--><?php //echo $form->textField($model,'approved_by',array('size'=>60,'maxlength'=>255)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'price'); ?>
    <!--		--><?php //echo $form->textField($model,'price'); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'cp_id'); ?>
    <!--		--><?php //echo $form->textField($model,'cp_id'); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'artist_id'); ?>
    <!--		--><?php //echo $form->textField($model,'artist_id',array('size'=>60,'maxlength'=>300)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'album_id'); ?>
    <!--		--><?php //echo $form->textField($model,'album_id',array('size'=>60,'maxlength'=>100)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'last_update'); ?>
    <!--		--><?php //echo $form->textField($model,'last_update'); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'extra_info'); ?>
    <!--		--><?php //echo $form->textArea($model,'extra_info',array('rows'=>6, 'cols'=>50)); ?>
    <!--	</div>-->
    <!---->
    <!--	<div class="row">-->
    <!--		--><?php //echo $form->label($model,'status'); ?>
    <!--		--><?php //echo $form->textField($model,'status'); ?>
    <!--	</div>-->
    <!---->


    <?php $this->endWidget(); ?>

</div><!-- search-form -->

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/moment.min2.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/daterangepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search-ajax').click(function () {
            var date_from = $('#AMedia_datefrom').val();
            var date_to = $('#AMedia_dateto').val();
            $.ajax({
                type: "POST",
                url: '<?=Yii::app()->createUrl('aMedia/report')?>',
                crossDomain: true,
                dataType: 'json',
                data: {
                    date_from: date_from,
                    date_to: date_to,
                    'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'
                },
                success: function (result) {
                    openViewVideo(result);
                }
            });
        });

        $('#AMedia_datefrom').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePickerIncrement: 5,
            format: 'DD/MM/YYYY hh:mm:ss',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            locale: {
                applyLabel: 'Áp dụng',
                cancelLabel: 'Đóng',
                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                firstDay: 1
            }
        }, function () {
        });
        $('#AMedia_dateto').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePickerIncrement: 5,
            format: 'DD/MM/YYYY hh:mm:ss',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            locale: {
                applyLabel: 'Áp dụng',
                cancelLabel: 'Đóng',
                daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                firstDay: 1
            }
        }, function () {
        });


    });
</script>