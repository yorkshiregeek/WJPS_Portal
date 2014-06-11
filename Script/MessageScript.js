function checkmessageform(form,categorys)
{
	var title = document.getElementById("titleerror");
	var notice = document.getElementById("messageerror");
	var categoryerror = document.getElementById("categoryerror");
	
	var CategoryFound = false;
	
	while(categorys > 0){
	
		if(document.getElementById("messagecategory" + categorys).checked){
			CategoryFound = true;
		}
		
		categorys -= 1;
	}
		
	
	var err = setuperrvar();
	
	if(form.title.value != "" && form.message.value != "" && CategoryFound == true){
		//All Complete
			
		return true;
					
	} else {
	
		setuperr(null,err);
	
		if(form.title.value != ""){title.style.display = "none";} else {title.style.display = "list-item"; }
		if(form.message.value != ""){notice.style.display = "none";} else {notice.style.display = "list-item"; }
		if(CategoryFound != ""){categoryerror.style.display = "none";} else {categoryerror.style.display = "list-item"; }
				
		return false;
	}
	
}

function checkreplyform(form)
{

	var reply = document.getElementById("replyerror");
	
	var err = setuperrvar();
	
	if(form.message.value != ""){
	
		return true;
	
	} else {
	
		if(form.message.value != ""){reply.style.display = "none";} else {reply.style.display = "list-item"; }
	
		return false;
	
	}

}