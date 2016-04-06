<script type="text/javascript">
jQuery(document).ready(function($){
	$('select[name="item_meta[176]"]').change(function(){

		var val1 = $("select[name='item_meta[176]']").val();
		if (val1 == 'Full format (10 pages)')
			{$("#field_credits").val('350');}
		else if (val1 == 'One pager')
			{$("#field_credits").val('150');}
		else if (val1 == 'Bandeau')
			{$("#field_credits").val('100');}

		$("#field_credits").change();
	});
});
</script>