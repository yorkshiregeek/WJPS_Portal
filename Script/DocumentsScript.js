function checkgroupform(form)
{
	var def = document.getElementById("defaulterror");
	var group = document.getElementById("groupnameerror");
	
	var err = setuperrvar();

    if(form.group.value != "") 
    {
        //All Complete        
       	return true;
	} else {
		setuperr(def,err);
		
    	if(form.group.value != ""){group.style.display = "none";}
	
       	return false;
    }
}

function checksectionform(form)
{
	var def = document.getElementById("defaulterror");
	var section = document.getElementById("sectionnameerror");
	
	var err = setuperrvar();

    if(form.section.value != "") 
    {
        //All Complete        
       	return true;
	} else {
		setuperr(def,err);
		
    	if(form.section.value != ""){section.style.display = "none";}
	
       	return false;
    }
}

function checkdocumentform(form, addedit, categorys)
{
	var def = document.getElementById("defaulterror");
	var documentnameerr = document.getElementById("documentnameerror");
	var fileerror = document.getElementById("documenterror");
	var noticecategoryerror = document.getElementById("noticecategoryerror");
	
	//Loop to find NoticeCategory
	
	var NoticeCategoryFound = true;
	
	if(form.sendnotice.checked){
		NoticeCategoryFound = false;
		
		while(categorys > 0){
		
			if(document.getElementById("selectnoticecategory" + categorys).checked){
				NoticeCategoryFound = true;
			}
			
			categorys -= 1;
		}
		
	}
	
	
	
		
	var err = setuperrvar();
	
	//alert(addedit);
	
	if(addedit){
		//Add
		if(form.filename.value != "" && form.file.value != "" && NoticeCategoryFound == true) 
    	{
    	    //All Complete        
    	   	return true;
		} else {
			setuperr(def,err);
		
    		if(form.filename.value != ""){documentnameerr.style.display = "none";}
    		if(form.file.value != ""){fileerror.style.display = "none";}
    		if(NoticeCategoryFound){noticecategoryerror.style.display = "none"};
		
    	   	return false;
    	}
	} else {
		//Edit
		if(form.filename.value != "") 
    	{
        	//All Complete        
       		return true;
			} else {
				setuperr(def,err);
		
    			if(form.filename.value != ""){documentnameerr.style.display = "none";}
    			
    			fileerror.style.display = "none";
	
       			return false;
    	}
	}
}