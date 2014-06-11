function checktrustsform(form)
{
	var def = document.getElementById("defaulterror");
	var trust = document.getElementById("trusterror");
	
	var err = setuperrvar();

    if(form.trust.value != "") 
    {
        //All Complete        
       	return true;
	} else {
		setuperr(def,err);
		
    	if(form.trust.value != ""){trust.style.display = "none";}
	
       	return false;
    }
}

function checksiteform(form)
{
	var site = document.getElementById("siteerror");
	var address1 = document.getElementById("address1error");
	var town = document.getElementById("townerror");
	var postcode = document.getElementById("postcode");
	var telephone = document.getElementById("telephone");
	
	var err = setuperrvar();
	
	if(form.name.value != "" && form.addressline1.value != "" && form.town.value != "" && form.postcode.value != "" && form.telephone.value != ""){
		//All Complete
		return true
		
	} else {
	
		setuperr(null,err);
		
		if(form.name.value != ""){site.style.display = "none";}
		if(form.addressline1.value != ""){address1.style.display = "none";}
		if(form.town.value != ""){town.style.display = "none";}
		if(form.postcode.value != ""){postcode.style.display = "none";}
		if(form.telephone.value != ""){telephone.style.display = "none";}
		
		return false;
	
	}
}

function checkcontactform(form)
{
	var name = document.getElementById("nameerror");
	var email = document.getElementById("emailerror");
	var emailformat = document.getElementById("emailformaterror");
	var telephone = document.getElementById("telephoneerror");

	var err = setuperrvar();
	
	if(form.name.value != "" && form.email.value != ""){
		//All Complete
		if(validateemail(form.email)){
			return true
		} else {
		
			setuperr(null,err);
			
			name.style.display = "none";
			email.style.display = "none";
			telephone.style.display = "none";
			emailformat.style.display = "list-item";
		
			return false;
		}
		
	} else {
	
		setuperr(null,err);
		
		if(form.name.value != ""){name.style.display = "none";}
		if(form.email.value != ""){email.style.display = "none";}
		
		emailformat.style.display = "none";
		
		return false;
	
	}
}

function checkpositionform(form)
{
	var position = document.getElementById("positionerror");
	
	var err = setuperrvar();

    if(form.position.value != "") 
    {
        //All Complete        
       	return true;
	} else {
		setuperr(false,err);
		
    	if(form.position.value != ""){position.style.display = "none";}
	
       	return false;
    }
	
}