	<script type="text/javascript">

   $(function() {
   $(".search_box").Watermark("Search @ iProfile:");
	$("#populate").autocomplete({
		url: 'search.php',
		cache: false,
		onItemSelect: function(item) {
window.location.href=item.data;
document.getElementById('populate').value='';
   $(".search_box").Watermark("Search @ iProfile:");
		},
	});

});


	</script>
	
	<input id="populate" class="search_box" title="Search your buddies"/>

<!--<div>
	<input id="movie" class="search_box"/>
</div>-->

