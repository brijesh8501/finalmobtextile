         $(document).ready(function () {
			 $('#Cou_Com_Id').focus();
			$('#Cou_Comp').on('keypress', function (e) {
    var ingnore_key_codes = [34, 39];
    if ($.inArray(e.which, ingnore_key_codes) >= 0) {
        e.preventDefault();
        $("#error1").html("only valid special character allowed").show();
    } else {
        $("#error1").hide();
    }
});
$(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
		 });
		 history.pushState(null, null);
    window.addEventListener('popstate', function(event)  {
    history.pushState(null, null);
    }); 
    var submitting = false;
    function Courier(mff)
{
	if(mff.Cou_Comp.value=="")
    {
       alert("Courier-Company is required");
       mff.Cou_Comp.focus();
       return false;
    }
 return true;
}
