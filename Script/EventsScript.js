function checkeventsform(form, categorys)
{
	var tit = document.getElementById("titleerror");
	var desc = document.getElementById("descriptionerror");
	var loca = document.getElementById("locationerror");
	var evedat = document.getElementById("eventdateerror");
	var evetim = document.getElementById("eventtimeerror");
	var evedur = document.getElementById("eventdurationerror");
	var dateform = document.getElementById("eventdateformaterror");
	var timeform = document.getElementById("eventtimeformaterror");
	var categoryerror = document.getElementById("eventcategoryerror");
	
	var EventCategoryFound = true;
	
	if(form.sendnotice.checked){
		EventCategoryFound = false;
		
		while(categorys > 0){
		
			if(document.getElementById("selectnoticecategory" + categorys).checked){
				EventCategoryFound = true;
			}
			
			categorys -= 1;
		}
		
	}
	
	var err = setuperrvar();
	
	if(form.title.value != "" && form.details.value != "" && form.location.value != "" && form.eventdate.value != "" && form.eventtime.value != "" & form.duration.value != "" && EventCategoryFound == true){
		//All Complete
		if(validatedate(form.eventdate.value)){
			//All Ok
			if(validatetime(form.eventtime.value)){
				//All Ok
				return true;
			} else {
				setuperr(null,err);
				
				tit.style.display = "none";
				desc.style.display = "none";
				loca.style.display = "none";
				evedat.style.display = "none";
				evetim.style.display = "none";
				evedur.style.display = "none";
				dateform.style.display = "none";
				categoryerror.style.display = "none";
				
				return false;
			
			}
			
		} else {
			setuperr(null,err);
			
			tit.style.display = "none";
			desc.style.display = "none";
			loca.style.display = "none";
			evedat.style.display = "none";
			evetim.style.display = "none";
			evedur.style.display = "none";
			categoryerror.style.display = "none";
			
			return false;
		}
		
	} else {
	
		setuperr(null,err);
	
		if(form.title.value != ""){tit.style.display = "none";}
		if(form.details.value != ""){desc.style.display = "none";}
		if(form.location.value != ""){loca.style.display = "none";}
		if(form.eventdate.value != ""){evedat.style.display = "none";}
		if(form.eventtime.value != ""){evetim.style.display = "none";}
		if(form.duration.value != ""){evedur.style.display = "none";}
		if(EventCategoryFound){categoryerror.style.display = "none";}
		
		dateform.style.display = "none";
		timeform.style.display = "none";
		
		return false;
	}

}
