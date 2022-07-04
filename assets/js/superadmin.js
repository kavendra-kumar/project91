// var base_url = 'http://91.demoserver.co.in/';
var base_url = 'http://localhost/project91/';
// var base_url = 'https://project91.isynbus.com/';
$(document).ready(function(){

	  // FOR LOGIN FORM -------------------------------------------------------
  $('#login_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/check_login',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false) {
          //show errors
          $('#recaptchaErr').html(data.errors);
        
          }else if(data.status == true){
              window.location = base_url+'super-admin/dashboard';
          }
          console.log(data);
       }// success msg ends here
     });
  });

    // FOR ADD MOTIVATOR FORM ----------------------------------------
  $('#add_motivator_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#add_motivator_submit').hide();
    $('#add_motivator_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/insert_motivator',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#add_motivator_submit').show();
          $('#add_motivator_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR EDIT MOTIVATOR FORM ----------------------------------------
  $('#edit_motivator_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#edit_motivator_submit').hide();
    $('#edit_motivator_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/update_motivator',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#edit_motivator_submit').show();
          $('#edit_motivator_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR ADD PROGRAM FORM ----------------------------------------
  $('#add_program_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#add_program_submit').hide();
    $('#add_program_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/insert_program',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#add_program_submit').show();
          $('#add_program_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR EDIT PROGRAM FORM ----------------------------------------
  $('#edit_planner_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#edit_planner_submit').hide();
    $('#edit_planner_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/update_planner',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#edit_planner_submit').show();
          $('#edit_planner_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

      // FOR ADD planner FORM
  $('#add_planner_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#add_planner_submit').hide();
    $('#add_planner_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/insert_planner',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#add_planner_submit').show();
          $('#add_planner_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });
  // FOR ADD Program Cycle FORM ----------------------------------------
  $('#add_program_cycle_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#add_program_cycle_submit').hide();
    $('#add_program_cycle_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/insert_program_cycle',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#add_program_cycle_submit').show();
          $('#add_program_cycle_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR EDIT Program Cycle FORM ----------------------------------------
  $('#edit_program_cycle_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#edit_program_cycle_submit').hide();
    $('#edit_program_cycle_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/update_program_cycle',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#edit_program_cycle_submit').show();
          $('#edit_program_cycle_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

      // FOR ADD Holiday FORM ----------------------------------------
  $('#add_holiday_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#add_holiday_submit').hide();
    $('#add_holiday_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/insert_holiday',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#add_holiday_submit').show();
          $('#add_holiday_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR EDIT Holiday FORM ----------------------------------------
  $('#edit_holiday_form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    $('#edit_holiday_submit').hide();
    $('#edit_holiday_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/update_holiday',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#edit_holiday_submit').show();
          $('#edit_holiday_loader').css('visibility', 'hidden');
          if (data.status == false)
          {
            //show errors
            $('[id*=Err]').html('');
            $.each(data.errors, function(key, val) {
                var key =key.replace(/\[]/g, '');
                key=key+'Err';
                //console.log(key);    
                $('#'+ key).html(val);
            })
          }
          else if(data.status == true){
            window.location.reload();
          }
          console.log(data);
       }// success msg ends here

     });
  });

});

////////////////////////////////////////////////////////

function AssignRole(student_id,role_id){
  $.ajax({
    url: base_url+'superadmin/assign_role',
    type: 'POST', 
    data: {
          student_id:student_id, role_id:role_id 
      }, 
    success: function(data){
      $.toast({
            heading: 'MedSmarter',
            text: 'Updated Successfully',
            position: 'top-right',
            loaderBg: '#9fcd53',
            icon: 'success',
            hideAfter: 4500,
            stack: 6
        });
    }
  });
}

////////////////////////////////////////////////////////

function deleteStudent(student_id)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete User Details !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_student',
      type: 'POST',
      data: {
          student_id:student_id 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-student"+student_id).remove();
      }
    });      
  });
}

////////////////////////////////////////////////////////

function editMotivator(mid)
{
  $.ajax({
    url: base_url+'superadmin/get_motivator_details',
    type: 'POST', 
    data: {mid: mid},
    success: function(data){
      var motivator_modal = $('#edit-motivator');
      var motivator_form = motivator_modal.find('#edit_motivator_form');
      motivator_modal.modal('show');
      motivator_form.find("textarea[name=quote]").val(data.quote); 
      motivator_form.find("input[name=writer]").val(data.writer); 
      motivator_form.find("input[name=mid]").val(mid); 
    }
  });
}

////////////////////////////////////////////////////////

function deleteMotivator(mid)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete this Motivational Quote !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_motivator',
      type: 'POST',
      data: {
          mid:mid 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-motivator"+mid).remove();
      }
    });      
  });
}

////////////////////////////////////////////////////////

function editProgram(pid)
{
  $.ajax({
    url: base_url+'superadmin/get_program_details',
    type: 'POST', 
    data: {pid: pid},
    success: function(data){
      var program_modal = $('#edit-program');
      var program_form = program_modal.find('#edit_program_form');
      program_modal.modal('show');
      program_form.find("input[name=name]").val(data.name); 
      program_form.find("input[name=pid]").val(pid); 
    }
  });
}

function editPlanner(pid)
{
  $.ajax({
    url: base_url+'superadmin/get_planner_details',
    type: 'POST', 
    data: {pid: pid},
    success: function(data){
      var program_modal = $('#edit-planner');
      var program_form = program_modal.find('#edit_planner_form');
      program_modal.modal('show');
      program_form.find("input[name=name]").val(data.name); 
      program_form.find("input[name=pid]").val(pid); 
    }
  });
}
////////////////////////////////////////////////////////

function deleteProgram(pid)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete this Program !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_program',
      type: 'POST',
      data: {
          pid:pid 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-program"+pid).remove();
      }
    });      
  });
}


function deletePlanner(pid)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete this Planner !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_planner',
      type: 'POST',
      data: {
          pid:pid 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-planner"+pid).remove();
      }
    });      
  });
}

////////////////////////////////////////////////////////

function editProgramCycle(scid)
{
  $.ajax({
    url: base_url+'superadmin/get_program_cycle_details',
    type: 'POST', 
    data: {scid: scid},
    success: function(data){
      var program_cycle_modal = $('#edit-program_cycle');
      var program_cycle_form = program_cycle_modal.find('#edit_program_cycle_form');
      program_cycle_modal.modal('show');
      program_cycle_form.find("input[name=day]").val(data.day); 
      program_cycle_form.find("input[name=course_code]").val(data.course_code); 
      program_cycle_form.find("input[name=subject]").val(data.subject); 
      program_cycle_form.find("input[name=start_time]").val(data.start_time); 
      program_cycle_form.find("input[name=end_time]").val(data.end_time); 
      program_cycle_form.find("input[name=hours]").val(data.hours); 
      program_cycle_form.find("input[name=alc]").val(data.alc); 
      program_cycle_form.find("input[name=scid]").val(scid); 
    }
  });
}

////////////////////////////////////////////////////////

function deleteProgramCycle(scid)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete this Subject !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_program_cycle',
      type: 'POST',
      data: {
          scid:scid 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-program_cycle"+scid).remove();
        window.location.reload();

      }
    });      
  });
}


////////////////////////////////////////////////////////

function editHoliday(wid)
{
  $.ajax({
    url: base_url+'superadmin/get_holiday_details',
    type: 'POST', 
    data: {wid: wid},
    success: function(data){
      var holiday_modal = $('#edit-holiday');
      var holiday_form = holiday_modal.find('#edit_holiday_form');
      holiday_modal.modal('show');
      holiday_form.find("input[name=on_date]").datepicker('setDate', data.on_date); 
      holiday_form.find("input[name=category]").val(data.category); 
      holiday_form.find("input[name=reason]").val(data.reason); 
      holiday_form.find("input[name=wid]").val(wid); 
    }
  });
}

////////////////////////////////////////////////////////

function deleteHoliday(wid)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete this !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      type: "POST",
      url: base_url+'superadmin/delete_holiday',
      type: 'POST',
      data: {
          wid:wid 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-holiday"+wid).remove();
      }
    });      
  });
}

////////////////////////////////////////////////////////

function startCycle(student_id,start_cycle){
  $.ajax({
    url: base_url+'superadmin/start_cycle',
    type: 'POST', 
    data: {
          student_id:student_id, start_cycle:start_cycle 
      }, 
    success: function(data){
      $('.start-cycle'+student_id).css('background-color','#e5fefb');
      $.toast({
            heading: 'MedSmarter',
            text: 'Updated Successfully',
            position: 'top-right',
            loaderBg: '#9fcd53',
            icon: 'success',
            hideAfter: 4500,
            stack: 6
        });
    }
  });
}

////////////////////////////////////////////////////////

function logout()
{
  swal({   
      title: "Are you sure?",   
      text: "You want to logout !",   
      type: "info",   
      showCancelButton: true,   
      confirmButtonColor: "#04a08b",   
      confirmButtonText: "Yes",   
      closeOnConfirm: false 
  }, function(){ 
      $.ajax({
        url: base_url+'superadmin/logout',
        type: 'POST', 
        success: function(html){
          swal("Logged Out!", "Successfully.", "success"); 
          window.location.reload();
        }
      });      
  });
}