$(document).ready(function(){
	$('#Cu_En_Name').focus();
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
	$('#Taka_Invoice_Date').datepicker({
                    format: "yyyy-mm-dd"
                }); 
	$("#Add1").click(function(){
		t1=$("#Taka_Invoice_Id").val();
		t2=$("#Taka_D_C_Id").val();
		t3=$("#country_no_1").val();
		t4=$("#phone_code_1").val();
		t5=$("#Rate").val();
		t6=$("#country_1").val();
		t7=$("#Amt").val();
		t8=$("#R_Id").val();
		t9=$("#action").val();
sql="?Taka_Invoice_Id="+t1+"&Taka_D_C_Id="+t2+"&country_no_1="+t3+"&phone_code_1="+t4+"&Rate="+t5+"&country_1="+t6+"&Amt="+t7+"&R_Id="+t8+"&action="+t9+"&Add1=Add";
		$("#countryname_1").val("");
		$("#country_no_1").val("");
		$("#phone_code_1").val("");
		$("#Rate").val("");
		$("#country_1").val("");
		$("#Amt").val("");
		$('#countryname_1').focus();
		$("#table").load("Taka_invoicetable85.php"+sql);
	});
  $(function() {
    $('#Total_Amt').bind('keyup', function() {
           count =0;
        count += $('#mybody').children('tr').length;
        $('#Total_Entry1').html(count);
		$('#Total_Entry').val(count);
    });
});
$('#phone_code_1, #Rate').keyup(function(){
    var Total_Meter = parseFloat($('#phone_code_1').val()) || 0;
    var Rate = parseFloat($('#Rate').val()) || 0;
     var Amt = Total_Meter*Rate;
    $('#Amt').val(Amt.toFixed(2));    
});
$('#Total_Amt,#Discount,#Interest').keyup(function(){
    var Total_Amt = parseFloat($('#Total_Amt').val()) || 0;
     var Discount = parseFloat($('#Discount').val()) || 0;
	  var Interest = parseFloat($('#Interest').val()) || 0;
     var Percentage = (Total_Amt/100)*Discount;
	 var Grandtotaltmp = Total_Amt - Percentage;
     var Interest_Amt = (Grandtotaltmp*Interest)/100;
	  var Grandtotal = Grandtotaltmp + Interest_Amt;
    $('#Grandtotal').val(Grandtotal.toFixed(2));         
});
		 $("#Total_Amt").bind('keyup', function() {
                var add = 0;
                $(".rowDataSd").each(function() {
                    add += Number($(this).html());
                });
                $("#Total_Amt").val(add.toFixed(2));
            });
});		
 var submitting = false;     
function checkQuotee(mff)
{
	if (mff.Total_Entry.value=="")
	{
		alert("Please check entry by tab button");
       mff.Total_Entry.focus();
       return false;
	}
      else if (mff.Total_Entry.value>=7)
	{
		alert("More than 6 entry is not acceptable please settle down appropriate records");
       mff.Total_Entry.focus();
       return false;
	}
	if(mff.Total_Amt.value=="")
    {
       alert("Total amount is required");
       mff.Total_Amt.focus();
       return false;
    }
	else if (mff.Total_Amt.value==0.00)
	{
		alert("You cannot submit as there is no entry in invoice");
       mff.Total_Amt.focus();
       return false;
	}
	if(mff.Discount.value=="")
    {
       alert("Discount is required");
       mff.Discount.focus();
       return false;
    }
	if(mff.Grandtotal.value=="")
    {
       alert("Grand total is required");
       mff.Grandtotal.focus();
       return false;
    }
	else if (mff.Grandtotal.value<=0.00)
	{
		alert("You cannot submit as there is no entry in invoice");
       mff.Grandtotal.focus();
       return false;
	}
	return true;
	}
history.pushState(null, null);
    window.addEventListener('popstate', function(event)  {
    history.pushState(null, null);
    });
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	   function isDecimalNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }