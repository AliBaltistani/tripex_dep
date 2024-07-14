/**
 * @author M.Ali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteRole", function(){
		var roleId = $(this).data("roleid"),
			hitURL = baseURL + "deleteRole",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this role ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { roleId : roleId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Role successfully deleted"); }
				else if(data.status = false) { alert("Role deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});


// delete Multiple Records
$(document).ready(function(){
  $('#deleteSelectedRole').click(function(){
    alert('delete')
      var selectedItems = [];
      $('input[type=checkbox]:checked').each(function(){
          selectedItems.push($(this).val());
      });

      if(selectedItems.length > 0){
        
		var confirmation = confirm("Are you sure to delete this role ?");
          // $.ajax({
          //     type: 'POST',
          //     url: 'delete_records.php',
          //     data: {items: selectedItems},
          //     success: function(response){
          //         alert(response);
          //         // You can update UI or perform any action after deletion
          //     }
          // });
      } else {
          alert('Please select at least one record to delete.');
      }
  });
});
