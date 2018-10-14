
<script src="<?php echo Yii::app()->params['tic_url'] . '/js/tinymce/tinymce.dev.js'; ?>"></script>
<script src="<?php echo Yii::app()->params['tic_url'] . '/js/tinymce/plugins/table/plugin.dev.js'; ?>"></script>
<script src="<?php echo Yii::app()->params['tic_url'] . '/js/tinymce/plugins/paste/plugin.dev.js'; ?>"></script>
<script src="<?php echo Yii::app()->params['tic_url'] . '/js/tinymce/plugins/spellchecker/plugin.dev.js'; ?>"></script>
<script>
    tinymce.init({
        relative_urls: false,
        remove_script_host: true,
        document_base_url: "/",
        convert_urls: true,
        selector: "textarea#guide_sub_category_description",
        theme: "modern",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor importcss colorpicker textpattern codesample"
        ],
        external_plugins: {
            //"moxiemanager": "/moxiemanager-php/plugin.js"
        },
        add_unload_trigger: false,
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons table codesample",
        image_advtab: true,
        image_caption: true,
        style_formats: [
            {title: 'Bold text', format: 'h1'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        template_replace_values: {
            username: "Jack Black"
        },
        template_preview_replace_values: {
            username: "Preview user name"
        },
        link_class_list: [
            {title: 'Example 1', value: 'example1'},
            {title: 'Example 2', value: 'example2'}
        ],
        image_class_list: [
            {title: 'Example 1', value: 'example1'},
            {title: 'Example 2', value: 'example2'}
        ],
        templates: [
            {title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
            {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
        ],
        setup: function (ed) {
            /*ed.on(
             'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
             'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
             'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
             console.log(e.type, e);
             });*/
        },
        spellchecker_callback: function (method, data, success) {
            if (method == "spellcheck") {
                var words = data.match(this.getWordCharPattern());
                var suggestions = {};

                for (var i = 0; i < words.length; i++) {
                    suggestions[words[i]] = ["First", "second"];
                }

                success({words: suggestions, dictionary: true});
            }

            if (method == "addToDictionary") {
                success();
            }
        }
    });

    if (!window.console) {
        window.console = {
            log: function () {
                tinymce.$('<div></div>').text(tinymce.grep(arguments).join(' ')).appendTo(document.body);
            }
        };
    }
</script>
<div class="card-body">

    <ul class="nav nav-tabs" role="tablist">
        <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideCategory' ?>">Guide Category</a></li>
        <li class="active"><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/GuideSubCategory' ?>">Guide Sub Category</a></li>
        <li class=""><a href="<?php echo Yii::app()->params['webURL'] . 'VehicleGuide/Posts' ?>">Posts</a></li>
    </ul>

    <div class="tab-content">
        <!--Operation Message :: START-->
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
            <div class="throw_success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php } else if (Yii::app()->user->hasFlash('failure')) { ?>
            <div class="throw_warning">
                <?php echo Yii::app()->user->getFlash('failure'); ?>
            </div>
            <?php
        }
        ?>
        <!--Operation Message :: END-->
        <form class="form-horizontal lcns" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
                    <select id="guide_category_id" name="guide_category_id" class="form-control">
                        <option value="">--Select Category--</option>
                        <?php
                        if (!empty($guide_categories)) {
                            foreach ($guide_categories as $arrCategory) {
                                ?>
                                <option value="<?php echo $arrCategory['category_id']; ?>"><?php echo $arrCategory['category_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($errors['guide_category_id'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['guide_category_id'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div> 
            <!--Guide Categories :: END-->

            <!--Name :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-3">
                    <input type="text" name="guide_sub_category_name" id="guide_sub_category_name" class="form-control"/>
                </div>
                <?php
                if (isset($errors['guide_sub_category_name'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_sub_category_name'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Name :: END-->

            <!--Code :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Code</label>
                <div class="col-sm-3">
                    <input type="text" name="guide_sub_category_code" id="guide_sub_category_code" class="form-control"/>
                </div>
                <?php
                if (isset($errors['guide_sub_category_code'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_sub_category_code'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Code :: END-->

            <!--Description :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control alt" placeholder="Enter Category description." name="guide_sub_category_description" id="guide_sub_category_description" style="height:120px;"></textarea>
                </div>
                <?php
                if (isset($errors['guide_sub_category_description'][0])) {
                    ?>
                    <span id="vmodelerr" style="color:red;">
                        <?php
                        echo $errors['guide_sub_category_description'][0];
                        ?>
                    </span>
                    <?php
                }
                ?>
            </div> 
            <!--Description :: END-->


            <!--Logo :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Logo (Note * : valid image extensions are jpg, jpeg, png, gif)</label>
                <div class="col-sm-3">
                    <input type="file" name="guide_sub_category_logo" class="form-control" id="guide_sub_category_logo" data-type="image"  accept="image/*"/>
                    <?php
                    if (isset($errors['guide_sub_category_logo'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['guide_sub_category_logo'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Logo :: END-->

            <!--Status :: START-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-3">
                    <select  name='guide_sub_category_status' id='guide_sub_category_status'>
                        <option value=''>--Select Status--</option>
                        <option value='1'>Active</option>
                        <option value='2'>Inactive</option>
                    </select>
                    <?php
                    if (isset($errors['guide_sub_category_status'][0])) {
                        ?>
                        <span id="vmodelerr" style="color:red;">
                            <?php
                            echo $errors['guide_sub_category_status'][0];
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--Status :: END-->

            <!--Form Submit :: START-->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' class="btn btn-warning" name='guide_sub_create_category' id='guide_sub_create_category' value = 'Create'/>
                </div>
            </div>
            <!--Form Submit :: END-->
        </form>
    </div>
</div>

