<style>
  /* Style the form */
  #regForm {
    background-color: #ffffff;
    margin: auto;
    padding: 10px;
  }

  /* Style the input fields */
  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  /* Mark the active step: */
  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }
</style>

<div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg w-100" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="add_slots" id="regForm">
        <div class="modal-body">
          <!-- Multiple slots -->

          <!-- One "tab" for each step in the form: -->
          <div class="tab">Category:
            <select class="form-control  required" id="main_category"  name="category" required>
              <option value="" selected disabled>Select category</option>
              <?php if (!empty($categories)) {
                foreach ($categories as $category) {
              ?>
                  <option value="<?= $category->categoryId ?>"><?= $category->categoryName ?></option>
              <?php }
              } ?>
            </select>
            <p><input type="hidden" class="uname" placeholder="First name..." oninput="this.className = ''" value=""></p>
            <p><input type="hidden" class="uname" placeholder="Last name..." oninput="this.className = ''" value=""></p>

          </div>

          <div class="tab">Sub Category:
            <select class="form-control subcategorySelect required" id="subcategorySelect" name="category" required>
              <option value="" selected disabled>no records found...</option>      
            </select>

            <p><input type="hidden" placeholder="E-mail..." oninput="this.className = ''"></p>
            <p><input type="hidden" placeholder="Phone..." oninput="this.className = ''"></p>
          </div>

          <div class="tab">Service:
             <select class="form-control serviceSelect required" id="serviceSelect" name="category" required>
              <option value="" selected disabled>no records found...</option>      
            </select>
           
              <p><input type="hidden" placeholder="dd" oninput="this.className = ''"></p>
            <p><input type="hidden" placeholder="mm" oninput="this.className = ''"></p>
            <p><input type="hidden" placeholder="yyyy" oninput="this.className = ''"></p>
          </div>

          <div class="tab" id="service_container">
            
            <p><input type="hidden" placeholder="Username..." oninput="this.className = ''"></p>
            <p><input type="hidden" placeholder="Password..." oninput="this.className = ''"></p>
          </div>

          

          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>

          <!-- End Multiple slots -->
        </div>
        <div class="modal-footer">
        <div style="overflow:auto;">
            <div class="text-center">
              <button type="button" class="btn btn-danger" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
              <button type="button" class="btn btn-warning" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
          </div>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" id="submit" class="btn btn-success">Save changes</button> -->
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 

  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
      document.getElementById("nextBtn").style.display = "none";;     
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
      document.getElementById("nextBtn").style.display = "inline";
      
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("select");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
  }
</script>


<script>
$(document).ready(function(){
    $('#main_category').change(function(){
        var categoryID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?=base_url()?>SubCategory/allSubCat',
            data: {id: categoryID},
            dataType: 'json',
            beforeSend: function(){
              $('#nextBtn').html('loading..');
            },
            success: function(response){
              $('#nextBtn').html('Next');
                $('#subcategorySelect').empty();
                $('#subcategorySelect').append('<option value=""><------ Select Sub Category -----></option>');
                // var subcategoriesArray = JSON.parse(response); // Convert JSON to JavaScript array
                $.each(response, function(index, subcategory){
                    $('#subcategorySelect').append('<option value="'+subcategory.subcatId+'">'+subcategory.subcatName+'</option>');
                });
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });

    $('#subcategorySelect').change(function(){
        var categoryID = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?=base_url()?>AllService/getServiceByScid',
            data: {id: categoryID},
            dataType: 'json',
            beforeSend: function(){
              $('#nextBtn').html('loading..');
            },
            success: function(response){
              $('#nextBtn').html('Next');
                $('#serviceSelect').empty();
                $('#serviceSelect').append('<option value=""><------ Select Service -----></option>');
                // var subcategoriesArray = JSON.parse(response); // Convert JSON to JavaScript array
                $.each(response, function(index, service){
                    $('#serviceSelect').append('<option value="'+service.serviceId+'">'+service.serviceTitle+'</option>');
                });
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });

    $('#serviceSelect').change(function(){
        const serviceID = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: '<?=base_url()?>Booking/bookingNewForm',
            data: {id: serviceID},
            dataType: 'json',
            beforeSend: function(){
              $('#nextBtn').html('loading..');
            },
            success: function(response){
              $('#nextBtn').html('Next');
              $('#service_container').html(response); 
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });

    
});
</script>