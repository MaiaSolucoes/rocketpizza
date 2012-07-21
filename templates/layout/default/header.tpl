<div id="header">
	<div id="logo">
		{if isset($data.logo) && !empty($data.logo)}
			{$data.logo}
		{else}
			Sua marca na Internet
		{/if}
	</div>

	<div id="menu_bar">
		{foreach from=$data.nav item=menu}
			<a href="{$menu->href}" class="option_header_menu">{$menu->description}</a>
		{/foreach}
	</div>
</div>