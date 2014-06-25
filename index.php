
<? 

	if (session_status() == 0) {
		session_start();
	}
	
	include_once("Classes/classes.php"); 

	//ini_set('error_reporting',E_ALL);
	
	Templates::PageHeader("Welcome",$Scripts);    		
?>
   
	<div class='col-md-10' id='content'>
	
		<h2 class='page-header'>Welcome</h2>
		
		<p class='lead'>The Association of Teaching Hospital Pharmacists website is designed to give members a place to access group documents, events and contact information. To access this information you must first <a href="welcome.php">login</a>.</p>
		
		<h2 class='page-header'>Association Objectives</h2>
		
		<p>The Association of Teaching Hospital Pharmacists objectives:</p>

		<ul>
		
			<li>To influence the development of government, NHS, professional leadership and professional regulatory policy.</li>
			<li>Where agreed, to respond to consultations on behalf of member organisations which represent a significant proportion of hospital pharmacy.</li>
			<li>To provide a network for joint learning and for the exchange and dissemination of information.</li>
			<li>To encourage links between pharmacists with special interests which could lead to research projects or new developments in hospital pharmacy practice.</li>
			<li>To provide a peer support network for newly appointed teaching hospital chief pharmacists to give them a supportive forum to aid their personal development.</li>
			<li>To promote international contacts with similar institutions and between pharmacists with similar teaching hospital responsibilities and interests.</li>
			<li>To share knowledge and expertise in pharmaceutical work arising from academic and specialist units.</li>
			<li>To provide a peer support network for teaching hospital chief pharmacists to enable shared problem solving.</li>
			<li>To provide a biannual opportunity to visit a range of teaching hospitals to support local development plans and facilitate bench marking.</li>
			<li>To provide a biannual opportunity to visit a range of teaching hospitals to support local development plans and facilitate bench marking.</li>
		
		
		</ul>
	</div>
	
	<?

	if(Users::logincheck(3) > 0){
		Menu::generateadminmenu("home");
	} else if(Users::logincheck(1) > 0){
		Menu::generateusermenu("home");
	 	} else {
 		Menu::generatemenu("home");
 	} 
	
	Templates::PageFooter();
	
	?>