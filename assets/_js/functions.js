
$(function ()
	{
	var OpeningDate = new Date();
	$('#defaultCountdown').countdown({until: new Date(JSParams.launch_date), timezone: +2});
	$('#year').text(OpeningDate.getFullYear());	
	
});
////////////////////////////////////////////////////////////////////////////////////

(function($) {

    $(document).ready(function()
		{    
            $('#clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 10});
            $('#clouds').spRelSpeed(8);    
        });
		
})(jQuery);


$(document).ready(function(){
		
$('#me').hover(
            function(){
                $('#speech-bubble').fadeIn();
            },
            function(){
                $('#speech-bubble').delay(200).fadeOut();
            }
        );
});