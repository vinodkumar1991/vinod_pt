  <ul class="nav nav-tabs" role="tablist">
                                        <li><a href="<?php echo $this->createUrl('VehicleGuide/VehicleGuideContent');?>">Vehicle Guide Category</a></li>
                                        <li class="active"><a href="<?php echo $this->createUrl('VehicleGuide/VehicleGuideContent');?>">Add Category Post</a></li>
                                       <!-- <li class="active"><a href="<?php echo Yii::app()->baseurl; ?>/index.php/site/Map">Map</a></li> -->
                                    </ul>
                                    </div>	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/tinymce.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/tinymce.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/table/plugin.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/paste/plugin.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/tic/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>
<script>
	tinymce.init({
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
		content_css: "css/development.css",
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
<form method="post" action="VehicleGuide">
	<div>
		<div>
			Category <input type="text" name="category" ><br/>
			Sub Category <input type="text" name="subcategory" >
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%"></textarea>
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
		<input type="submit" name="save" value="Submit" />
		<input type="reset" name="reset" value="Reset" />
	</div>
</form>


<?php
if(isset($_POST['save'])) 
{
	print_r($_POST['elm1']);
}
?>