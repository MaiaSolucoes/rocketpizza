<html>
<head>
<title>{$data.title}</title>

{foreach from=$data.css item=css_file}
	<link rel="stylesheet" type="text/css" href="{$css_file}" />
{/foreach}

{foreach from=$data.js item=js_file}
	<script type="text/javascript" src="{$js_file}"></script>
{/foreach}

<style>
	{$data.custom_layout_code}
</style>

</head>
<body>
	{include file=$data.layout_config->header_template}

	<div id="content">
		{$data.content}
	</div>

	{include file=$data.layout_config->footer_template}

</body>
</html>