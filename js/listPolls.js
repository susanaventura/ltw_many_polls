

var pollDialog; 
function showPoll($pollTitle){
	//var $poll = document.getElementById('value').value;
	//alert($pollTitle);
	
	pollDialog = $('<div></div>').load("http://paginas.fe.up.pt/~ei12009/projeto/php/templates/pollX.php");
	
	$(pollDialog).find("#modalPoll").addClass("modal fade");
	$(pollDialog).find("#modalPoll").attr("tabindex", "-1");
	$(pollDialog).find("#modalPoll").attr("role", "dialog");
	$(pollDialog).find("#modalPoll").attr("aria-labelledby", "modalPollLabel");
	$(pollDialog).find("#modalPoll").attr("aria-hidden", "true");
	
	$('#modal_container').empty();
	$('#modal_container').append($(pollDialog));
	
	//change data

	/*$coiso = $(pollDialog).find("#title #titleText");
	$coiso.text($pollTitle['title']);
	$nhe = $(pollDialog).find("#title #userText");
	$nhe.text($pollTitle['title']);*/
	
	
	$(pollDialog).find("#modalPoll").modal('show');
		
};
/*
if(window.location.href.indexOf('id') != -1) {
    showPoll('nhe');
  }*/
/*
$(document).ready(function() {
 
  if(window.location.href.indexOf('id') != -1) {
    showPoll('nhe');
  }
 
});*/
  /*
$('#modalPoll').on('.aria-hidden', function () {
  document.location.reload(true);
})
*/

/*
var function getOutput($pollTitle) {
   $.ajax({
      url:'myAjax.php',
      complete: function (response) {
		  $coiso = $(pollDialog).find("#title #titleText");
		  $coiso.text($pollTitle['title']);
		$nhe = $(pollDialog).find("#title #userText");
		$nhe.text($pollTitle['title']);
          $('#output').html(response.responseText);
      },
      error: function () {
		  alert("error");
      }
  });
  return false;
}
*/

$('.modal').on('shown.bs.modal', function() {
    $(this).find('.modal-dialog-center').css({
        'margin-top': function () {
            return -($(this).outerHeight() / 2);
        },
        'margin-left': function () {
            return -($(this).outerWidth() / 2);
        }
    });
});
