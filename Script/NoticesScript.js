function checknoticeform(form,categorys)
{
	var title = document.getElementById("titleerror");
	var notice = document.getElementById("noticeerror");
	
	var categoryerror = document.getElementById("categoryerror");

	var CategoryFound = false;
	
	while(categorys > 0){
	
		if(document.getElementById("noticecategory" + categorys).checked){
			CategoryFound = true;
		}
		
		categorys -= 1;
	}
	
		
	var err = setuperrvar();
	
	if(form.title.value != "" && form.notice.value != "" && CategoryFound == true){
		//All Complete
			
		return true;
					
	} else {
	
		setuperr(null,err);
	
		if(form.title.value != ""){title.style.display = "none";} else {title.style.display = "list-item"; }
		if(form.notice.value != ""){notice.style.display = "none";} else {notice.style.display = "list-item"; }
		if(CategoryFound != ""){categoryerror.style.display = "none";} else {categoryerror.style.display = "list-item"; }
				
		return false;
	}

	
}