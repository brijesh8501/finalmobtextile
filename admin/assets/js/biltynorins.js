         $(document).ready(function () {
			 $('#Bilty_Id').focus();
    $('#Ref_No').on('keypress', function (e) {
    var ingnore_key_codes = [34, 39];
    if ($.inArray(e.which, ingnore_key_codes) >= 0) {
        e.preventDefault();
        $("#error1").html("only valid special character allowed").show();
    } else {
        $("#error1").hide();
    }
});
$('#B_Date').datepicker({
                    format: "yyyy-mm-dd"
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
    function Bilty(mff)
{
	if(mff.B_Date.value=="")
    {
       alert("Date is required");
       mff.B_Date.focus();
       return false;
    }	
	if(mff.Ref_No.value=="")
    {
       alert("Reference no is required");
       mff.Ref_No.focus();
       return false;
    }
if(mff.image.value=="")
    {
       alert("Image is required");
       mff.image.focus();
       return false;
    }	
	return true;
}
