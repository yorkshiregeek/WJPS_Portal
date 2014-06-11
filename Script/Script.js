function confirmdialog(Question, Forward)
{
    var ques = confirm( "Are you sure you want to: \n\n" + Question + "\n");
    
    if(ques){
        window.location = Forward;
    }
}

function validatedate(date)
{
    var error;
    if(date.length == 10)
    {
        //lenght ok
        if(date.charAt(2) == "/" && date.charAt(5) == "/"){
            //slashes ok
            var day = date.substr(0,2);
            var month = date.substr(3,2);
            if (day <= 31 && month <= 12)
            {
                //everything ok
                error = false;
            } else {
                error = true;
            }
        } else {
            error = true;
        }
    } else {
        error = true;
    }
    if(error)
    {
        //alert("The date must be in the format DD/MM/YYYY");
        return false;
    } else {
        return true;
    }
}

function validatetime(time)
{
	var error;
	if(time.length == 5)
	{
		//lenght ok
		if(time.charAt(2) == ":"){
			//: ok
			var hour = time.substr(0,2);
			var min = time.substr(3,2);
			if(hour <= 24 && min <= 60)
			{
				//all ok
				error = false;
			} else {
				error = true;
			}
		} else {
			error = true;
		}
	} else {
		error = true;
	}
	if(error)
	{
		//alert("The time must be in the format HH:MM");
		return false;
	} else {
		return true;
	}
}

function validatefileextension(file, extension)
{
    if(file.substr(file.length -3,3) == extension)
    {
        return true;
    } else {
        alert("The file must be a " + extension + " file.");
        return false;
    }
}

function validateemail(field)
{
    with (field)
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2) 
        {
            //alert("Please enter a valid email address!");
            return false;
        } else {
            return true;
        }
    }
}

function getuploadname()
{
	//alert(document.documentsform.file.value);
	if(document.documentsform.file.value != ""){
		var pos = document.documentsform.file.value.indexOf("fakepath");
		//alert(document.documentsform.file.value);
		if(pos>0){
			document.documentsform.filename.value = document.documentsform.file.value.substr(12);
		} else {
			document.documentsform.filename.value = document.documentsform.file.value;
		}
	}
}

function setuperrvar(){
	var err = document.getElementById("errors");
	
	if (!err){
		err = document.getElementById("errorsshow");
	}
	
	return err;
}

function setuperr(def,err){
	if(def){def.style.display = "none";}

    err.style.display = "block";
}

function shownoticecategorys(option){
	var sendmsg = option.checked;
	
	var title = document.getElementById("selectnoticecategoryTitle");
	var field = document.getElementById("selectnoticecategoryField");
	
	if(sendmsg){
		//show
		title.style.display = "block";
		field.style.display = "block";
	} else {
		//dont show
		title.style.display = "none";
		field.style.display = "none";
	}
}
            