<? 
	session_start();
	
	include_once("Classes/classes.php"); 
	
	Templates::PageHeader("Welcome",$Scripts,"home",0);    		
?>
   
	<div class='col-md-12' id='content'>
	
		<h2 class='page-header'>Welcome</h2>
		<?
	//Users::encryptpass()
?>	
		
		<p class='lead'>The Association of Teaching Hospital Pharmacists website is designed to give members a place to access group documents, events and contact information. To access this information you must first <a href="welcome.php">login</a>.</p>
		
		<h2 class='page-header'>Association Objectives</h2>
		
		<p class='lead'>The Association of Teaching Hospital Pharmacists objectives:</p>

		<ul class="list-group">
		
			<li class="list-group-item">To influence the development of government, NHS, professional leadership and professional regulatory policy.</li>
			<li class="list-group-item">Where agreed, to respond to consultations on behalf of member organisations which represent a significant proportion of hospital pharmacy.</li>
			<li class="list-group-item">To provide a network for joint learning and for the exchange and dissemination of information.</li>
			<li class="list-group-item">To encourage links between pharmacists with special interests which could lead to research projects or new developments in hospital pharmacy practice.</li>
			<li class="list-group-item">To provide a peer support network for newly appointed teaching hospital chief pharmacists to give them a supportive forum to aid their personal development.</li>
			<li class="list-group-item">To promote international contacts with similar institutions and between pharmacists with similar teaching hospital responsibilities and interests.</li>
			<li class="list-group-item">To share knowledge and expertise in pharmaceutical work arising from academic and specialist units.</li>
			<li class="list-group-item">To provide a peer support network for teaching hospital chief pharmacists to enable shared problem solving.</li>
			<li class="list-group-item">To provide a biannual opportunity to visit a range of teaching hospitals to support local development plans and facilitate bench marking.</li>
			<li class="list-group-item">To provide a biannual opportunity to visit a range of teaching hospitals to support local development plans and facilitate bench marking.</li>
		
		
		</ul>
	</div>

	<?

	Templates::PageFooter();
	
	?>