function checklinkform(form)
{
	var def = document.getElementById("defaulterror");
	var tit = document.getElementById("titleerror");
	var url = document.getElementById("urlerror");
	
	var err = setuperrvar();

    if(form.title.value != "" && form.url.value != "") 
    {
        //All Complete        
       	return true;
	} else {
		setuperr(def,err);
		
    	if(form.title.value != ""){tit.style.display = "none";}
    	if(form.url.value != ""){url.style.display = "none";}
	
       	return false;
    }
}