
<!-- Facebook -->

<!--
<script type="text/javascript">// <![CDATA[
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.async=true; js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&#038;appId=xxxxxxxxxxxxx";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// ]]></script>
-->

<!-- Share link -->

<?php require('../php/templates/getURL.php'); ?>

	<div class="col-md-10"><button id="shareLinkBtn" type="btn btn-default">Share link</button>
		<div id="shareLinkTextBoxDiv"style="display:inline">
			<input id="shareLinkTextBox" type="text" value="<?=$pageURL?>">
		</div>
	</div>

<script>
	$(document).ready(function(){	
		$('#shareLinkTextBoxDiv').hide();
		$('#shareLinkBtn').on('click', function() {
			$('#shareLinkTextBoxDiv').show();
			$('#shareLinkTextBox').select();
		});
	});
</script>


	<!-- Twitter -->
<div class="col-md-2">
<script type="text/javascript">// <![CDATA[
(function() {
  var t = document.createElement("script");
  t.type = "text/javascript";
  t.src = "//platform.twitter.com/widgets.js";
  t.async = true;
  document.getElementsByTagName('head')[0].appendChild(t);
})();
// ]]></script><a class="twitter-share-button" href="https://twitter.com/share" data-count="horizontal">Tweet</a>
</div>