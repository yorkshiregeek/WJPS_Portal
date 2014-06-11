<div id="header">
	<div id="logo"></div>
</div>

<? 
	if(Users::logincheck(3) > 0){
		Menu::generateadminmenu("home");
	} else if(Users::logincheck(1) > 0){
		Menu::generateusermenu("home");
 	} else {
 		Menu::generatemenu("home");
 	} 
?>
