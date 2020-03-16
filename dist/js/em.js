function checkemail()
    {
	
	   var email=document.getElementById( "emailfld" ).value;
	
	   if(email)
	   {
	       $.ajax({
			   type: 'post',
			   url: 'chkem.php',
			   data: {
			   emailfld:email,
			   },
			   success: function (response) {
			   $( '#email_status' ).html(response);
		       if(response=="OK")	
               {
                  return true;	
               }
               else
               {
                  return false;	
               }
             }
		   });


	    }
	    else
	    {
		   $( '#email_status' ).html("");
		   return false;
	    }
	
	}