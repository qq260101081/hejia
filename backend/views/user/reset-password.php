<?php
    use yii\widgets\ActiveForm;
    $this->title = '密码修改';
?>
<div class="col-md-offset-3 col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$model->name;?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <?php $form = ActiveForm::begin([
                'action' => ['reset-password']
            ]);?>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">新密码</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="[User][password]" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">确认密码</label>

                    <div class="col-sm-10">
                        <input name="[User][passowrdok]" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-default">取消</button>
                <button type="submit" class="btn btn-info pull-right">确定</button>
            </div>
            <!-- /.box-footer -->
        <?php $form->end();?>
    </div>
    <!-- /.box -->
</div>