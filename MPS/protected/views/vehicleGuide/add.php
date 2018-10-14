
 <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/vehicleCategory');?>">Vehicle Guide Category</a></li>
                                        <li class="active"><a href="<?php echo $this->createUrl('VehicleGuide/VehicleGuideContent');?>">Add Category Post</a></li>
                                      <li><a href="<?php echo $this->createUrl('VehicleGuide/allcategories');?>">All Posts</a></li>
                                    </ul>
                                   
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/tinymce.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/table/plugin.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/paste/plugin.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>
<script>
	tinymce.init({
		relative_urls : false,
remove_script_host : true,
document_base_url : "/",
convert_urls : true, 
		selector: "textarea#elm1",
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

		template_replace_values : {
			username : "Jack Black"
		},

		template_preview_replace_values : {
			username : "Preview user name"
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

		setup: function(ed) {
			/*ed.on(
				'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
				'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
				'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
				console.log(e.type, e);
			});*/
		},

		spellchecker_callback: function(method, data, success) {
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
			log: function() {
				tinymce.$('<div></div>').text(tinymce.grep(arguments).join(' ')).appendTo(document.body);
			}
		};
	}
</script>
</head>
<body>
<form method="post" action="VehicleGuidecontent"  enctype="multipart/form-data">
		<div> <input type="hidden" name="id" value="<?php if(isset($_GET['cat_id'])) { echo $_GET['cat_id'];	}?>">
		<div class="col-md-4">		<div class="form-group">
		<label>Select Category</label>
		<div>
			<select id="" name="cat_id" style="width:300px;">
				<option>Select Category</option>
				<?php foreach($categories as $cat) { ?>
				<option value="<?php echo $cat['cat_id']; ?>" 														
				<?php if(isset($edit)) { 
				
				if($cat['cat_id']==$edit[0]['cat_id'])
				{ ?>
					selected
				<?php }
				 } ?>
				><?php echo $cat['category_name']; ?></option>
				<?php } ?>
			</select>
		</div>		</div>
	</div>
		  <div class="col-md-4">		  <div class="form-group">
			<label>Sub Category</label>
			<div>
				<input type="text" name="sub_cat_id" class="form-control" value="<?php if(isset($edit)) { 
				echo $edit[0]['sub_cat_name'];
				
				} ?>"/>
			</div>
		</div>		</div>
		  <div class="col-md-4">		<div class="form-group">
			<label>add Feature Image</label>
			<div>
				<input type="file" name="feature_image" class="form-control" id="" >
			</div>		</div>
		</div>					
                                <div class="col-md-12">
   <div class="form-group">
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"><?php if(isset($edit)) { 
													echo $edit[0]['content'];
													
													} ?>
			</textarea>
   </div>   </div>
			<!-- <div>
				<a href="javascript:;" onclick="tinymce.get('elm1').show();return false;">[Show]</a>
				<a href="javascript:;" onclick="tinymce.get('elm1').hide();return false;">[Hide]</a>
				<a href="javascript:;" onclick="tinymce.execCommand('mceAddEditor', false, 'elm1');return false;">[Add]</a>
				<a href="javascript:;" onclick="tinymce.get('elm1').remove();return false;">[Remove]</a>
				<a href="javascript:;" onclick="tinymce.get('elm1').execCommand('Bold');return false;">[Bold]</a>
				<a href="javascript:;" onclick="alert(tinymce.get('elm1').getContent());return false;">[Get contents]</a>
				<a href="javascript:;" onclick="alert(tinymce.get('elm1').getContent({format: 'raw'}));return false;">[Get raw]</a>
				<a href="javascript:;" onclick="alert(tinymce.get('elm1').selection.getContent());return false;">[Get selected HTML]</a>
				<a href="javascript:;" onclick="alert(tinymce.get('elm1').selection.getContent({format : 'text'}));return false;">[Get selected text]</a>
				<a href="javascript:;" onclick="alert(tinymce.get('elm1').selection.getNode().nodeName);return false;">[Get selected element]</a>
				<a href="javascript:;" onclick="tinymce.execCommand('mceInsertContent',false,'<b>Hello world!!</b>');return false;">[Insert HTML]</a>
				<a href="javascript:;" onclick="tinymce.execCommand('mceReplaceContent',false,'<b>{$selection}</b>');return false;">[Replace selection]</a>
			</div> -->

			
		<br />
		<input type="submit" name="<?php if(isset($edit)) { ?>update<?php } else{ ?>save<?php } ?>" value="Submit" />
		<input type="reset" name="reset" value="Reset" /></div>
</form></body>

