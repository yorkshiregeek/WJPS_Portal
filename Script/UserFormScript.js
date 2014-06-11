function checkuserform(form)
{
	var def = document.getElementById("defaulterror");
	var username = document.getElementById("usernameerror");
	var email = document.getElementById("emailerror");
	var address = document.getElementById("addresserror");
	
	var err = setuperrvar();

    if(form.username.value != "" && form.email.value != "") 
    {
        //All Complete
       	if(validateemail(form.email)){
        	return true;
        } else {
        	setuperr(def,err);
    	
    		address.style.display = "list-item";
    	
    		email.style.display = "none";
    		username.style.display = "none";
        
        	return false;

        }
    } else {
    	
    	setuperr(def,err);
    	
    	if(form.username.value != ""){username.style.display = "none";}
    	if(form.email.value != ""){email.style.display = "none";}
    	
    	address.style.display = "none";
        
        return false;
    }
}


function checkloginform(form)
{
	//alert("Here");
	var user = document.getElementById("usernameerror");
    var pass = document.getElementById("passworderror");
    var def = document.getElementById("defaulterror");
	
	var err = setuperrvar();
		
    if(form.username.value != "" && form.password.value != "") 
    {
        //All Complete
		return true;
		//err.style.display = "false"
    } else {
    	//cancel default
    	setuperr(def,err);
    
    	//Set All Visable
    	user.style.display = "list-item";
    	pass.style.display = "list-item";
    	
    	
    	if(form.username.value != ""){user.style.display = "none";}
    	if(form.password.value != ""){pass.style.display = "none";}
        
        return false;
    }
}

function checkforgottenpasswordform(form)
{
	var def = document.getElementById("defaulterror");
	var email = document.getElementById("emailerror");
	var adderror = document.getElementById("addresserror");
	
	var err = setuperrvar();

    if(form.email.value != "") 
    {
        //All Complete
        if(validateemail(form.email)){
        	return true;
        } else {
        	setuperr(def,err);
    	
    		adderror.style.display = "list-item";
    	
    		email.style.display = "none";
        
        	return false;

        }
    } else {
    	
    	setuperr(def,err);
    	
    	if(form.email.value != ""){email.style.display = "none";}
    	
    	adderror.style.display = "none";
        
        return false;
    }
}


function checkchangepasswordform(form)
{

	var deferr = document.getElementById("defaulterror");
	var olderr = document.getElementById("oldpassworderror");
	var newerr = document.getElementById("newpassworderror");
	var new1err = document.getElementById("new1passworderror");
	var matcherr = document.getElementById("passwordmatcherror");
	
	var err = setuperrvar();
	
	if(form.old.value != "" && form.password.value != "" & form.password2.value != "")
	{
		//Form OK
		if(form.password.value != form.password2.value){
			//Match Error
			setuperr(deferr,err);
			
			matcherr.style.display = "list-item";
			
			olderr.style.display = "none";
			newerr.style.display = "none";
			new1err.style.display = "none";
			
			return false;
		} else {
			//All ok
			return true;
		}
	} else {
		//Form Not Complete
		setuperr(deferr, err);
		
		if(form.old.value != ""){olderr.style.display = "none";}
		if(form.password.value != ""){newerr.style.display = "none";}
		if(form.password2.value != ""){new1err.style.display = "none";}
		
		matcherr.style.display = "none";
		
		return false;
	}

}
