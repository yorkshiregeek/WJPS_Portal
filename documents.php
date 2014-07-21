<? 

	set_time_limit(120);
	ini_set(max_execution_time,"120");

	session_start();

	include_once("Classes/classes.php");
	
	include_once("Classes/groupsclass.php");
	include_once("Classes/sectionsclass.php");
	include_once("Classes/documentsclass.php");
	include_once("Classes/noticesclass.php");
	
	$Scripts[0] = "Script/DocumentsScript.js";
	$Scripts[1] = "js/vendor/jquery.ui.widget.js";
	$Scripts[2] = "js/jquery.iframe-transport.js";
	$Scripts[3] = "js/jquery.fileupload.js";
	$Scripts[4] = "js/bootstrap-tagsinput-angular.js";
	$Scripts[5] = "js/bootstrap-tagsinput.js";



	Templates::PageHeader("Documents",$Scripts,"documents",1);
    		 	
?>
    			    		
	<div class='col-md-12' id="content">
	
		<? 
		
			$GID = $_GET["gid"];
			$SGID = $_GET["sgid"];
			$SID = $_GET["sid"];
			$DSID = $_GET["dsid"];
			$DID = $_GET["did"];
			
			$AID = $_GET["aid"];

			$Search = $_GET["search"];
			
			//AID
			//EDIT = 5
			//DELETE = 10
		
			if(Users::login(1) || Users::logincheck(1)){
				//DocumentAdmin	
				$UID = Users::logincheck(1);
			
				$User = new Users($UID);
			
				if($User->getuserlevel() >= 2){
				
					Print("<h2 class='page-header'>Document Admin</h2>");
				
					if($Search!=''){
						Documents::searchadmin($Search);
					} else {
					if($GID){
						//Group Related Activity
						if($AID)
						{
							//Edit or Delete
							if($AID == 5){
								Groups::addedit($GID);
							} else if($AID == 10){
								Groups::deletegroup($GID);
								Groups::listadmin();
							}
						} else {
							//Add or Show
							if($GID < 0 ){
								//Add New Group
								Groups::addedit(-1);
							} else {
								//Show Group
								Sections::listadmin($GID);
							}
						} 
					} elseif($SID) {
						//Section Related Activity
						if($AID){
							//Edit or Delete
							if($AID == 5){
								Sections::addedit($SID,$SGID);
							} else if($AID == 10) {
								Sections::deletesection($SID);
								Sections::listadmin($SGID);
							}
						} else {
							//Add or Show
							if($SID < 0 ){
								Sections::addedit(-1,$SGID);
							} else {
								Documents::listadmin($SID);
							}
						
						}
					} elseif($DID) {
						//Document Related Activity
						if($AID){
							//Edit or Delete
							if($AID == 5){
								Documents::addedit($DID,$DSID);
							} else if($AID == 10) {
								Documents::deletedocument($DID);
								Documents::listadmin($DSID);
							}
						} else {
							//Add or Show
							if($DID < 0){
								Documents::addedit(-1,$DSID);
							} else {
								//Download
								//Documents::
							}
						}
					} else {
						Groups::listadmin();
					}

					}
					
				} else {


					
					Print("<h2 class='page-header'>Documents</h2>");

					if($Search!=''){
						Documents::searchadmin($Search);
					} else {
					
					if($GID){
						Sections::listall($GID);
					} else if($SID) {
						Documents::listall($SID);
					} else {
						Groups::listall();
					}

				}
				
				}
			
			} 
			    			
		?>

		
		
	</div>

	<script>

$('[data-toggle="tooltip"]').tooltip({
    'placement': 'top'
});
$('[data-toggle="popover"]').popover({
    trigger: 'hover',
        'placement': 'top'
});


/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'http://localhost:8888/WJPS_Portal/Ajax-php/upload.php';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<p/>').text(file.name).appendTo('#files');
                console.log($('#filename').value);
                $('#filename').val(file.name); // = 'here'; // = file.name;
                $('#fileurl').val(file.url);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
    	
<?

	Templates::PageFooter();

?>