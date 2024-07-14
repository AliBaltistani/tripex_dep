/**
 * @author M.Ali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	

	// Delete Services

	jQuery(document).on("click", ".deletecommon", function(){
		var userId = $(this).data("taskid"),
		    taskname = $(this).data("taskname"),
		    colName = $(this).data("col"),
			hitURL = baseURL + "common_delete",
			currentRow = $(this);
			
		var confirmation = confirm("Are you sure to delete this ? " );
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : userId, tbname : taskname, colName : colName } 
			}).done(function(data){
				console.log(data.status);
				if(data.status == true) { 
					currentRow.parents('tr').remove();
					alert(taskname + " successfully deleted"); }
				else if(data.status == false) { alert(taskname+ " deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	}
	);
	
	
});


