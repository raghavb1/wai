<link rel="stylesheet" href="jqcss/jquery.ui.base.css">
<link rel="stylesheet" href="jqcss/jquery.ui.datepicker.css">
<link rel="stylesheet" href="jqcss/jquery.ui.theme.css">
	<script src="javascripts/jquery-1.4.4.js"></script>
<script type="text/javascript" src="javascripts/jquery.ui.core.js"></script>
<script type="text/javascript" src="javascripts/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="javascripts/jquery.ui.widget.js"></script>
		<script>
	$(function() {
		$( "#datepicker" ).datepicker();
				$( "#datepicker" ).click(function() {
							$( "#datepicker" ).css("width","245px");
			$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		});
	});
	</script>

<div>

Date: <input type="text" id="datepicker" class="datepicker">
</div>

