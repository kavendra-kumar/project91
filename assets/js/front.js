//var base_url = 'http://91.demoserver.co.in/';
var base_url = 'http://localhost/project91/';
$(document).ready(function(){

  // FOR LOGIN FORM -------------------------------------------------------
  $('#login_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
    $('#login_submit').hide();
    $('#login_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/check_login',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#login_submit').show();
          $('#login_loader').css('visibility', 'hidden');
          if (data.status == false) {
          //show errors
          $('#recaptchaErr').html(data.errors);
        x`x`
          }else if(data.status == true){
              window.location = base_url+'complete-process';
          }
          console.log(data);
       }// success msg ends here
     });
  });

//       // FOR COURSE FORM ----------------------------------------
  $('#update_course_form').on('submit',function(event){
    
    event.preventDefault(); // Stop page from refreshing
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/update_course',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            if(data.page == 'settings'){
              window.location.reload();
            }else{
              window.location.reload();
            }
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // SHOW EVENT HIDE TIME FIELD FOR CREATE ----------------------------------------

  $("#event_allDay").click(function () {
      if ($(this).is(":checked")) {
          $("#date-time-section").hide();
          $(".create_event_start_time").prop('required',false);
      } else {
          $("#date-time-section").show();
          $(".create_event_start_time").prop('required',true);
      }
  });

    // SHOW TASK HIDE TIME FIELD FOR CREATE ----------------------------------------

  $("#task_allDay").click(function () {
      if ($(this).is(":checked")) {
          $("#task-time-section").hide();
          $(".task_create_event_start_time").prop('required',false);
      } else {
          $("#task-time-section").show();
          $(".task_create_event_start_time").prop('required',true);
      }
  });

      // SHOW TASK HIDE TIME FIELD FOR CREATE ----------------------------------------

  $("#task_allDay2").click(function () {
      if ($(this).is(":checked")) {
          $("#task-time-section2").hide();
          $(".task_create_event_start_time2").prop('required',false);
      } else {
          $("#task-time-section2").show();
          $(".task_create_event_start_time2").prop('required',true);
      }
  });

    // SHOW EVENT HIDE TIME FIELD FOR UPDATE ----------------------------------------

  $("#event_allDay1").click(function () {
      if ($(this).is(":checked")) {
          $("#date-time-section1").hide();
          $(".update_event_start_time").prop('required',false);
      } else {
          $("#date-time-section1").show();
          $(".update_event_start_time").prop('required',true);
      }
  });

    // SHOW TASK HIDE TIME FIELD FOR UPDATE----------------------------------------

  $("#task_allDay1").click(function () {
      if ($(this).is(":checked")) {
          $("#task-time-section1").hide();
          $(".task_update_event_start_time").prop('required',false);
      } else {
          $("#task-time-section1").show();
          $(".task_update_event_start_time").prop('required',true);
      }
  });

      // SHOW TASK HIDE TIME FIELD FOR UPDATE----------------------------------------

  $("#task_allDay3").click(function () {
      if ($(this).is(":checked")) {
          $("#task-time-section3").hide();
          $(".task_create_event_start_time").prop('required',false);
      } else {
          $("#task-time-section3").show();
          $(".task_create_event_start_time").prop('required',true);
      }
  });

    // SHOW DRAG EVENT HIDE TIME FIELD FOR UPDATE ----------------------------------------

  $("#drag_event_allDay").click(function () {
      if ($(this).is(":checked")) {
          $("#drag-date-time-section").hide();
          $(".drag_update_event_start_time").prop('required',false);
      } else {
          $("#drag-date-time-section").show();
          $(".drag_update_event_start_time").prop('required',true);
      }
  });

// HIDE ERROR MSG OF END TIME ----------------------------------------------

    $("select[name=event_end_time]").change(function () {
      $(this).parent().next('#event_end_timeErr').html('');      
    });

    // FOR ADD TASK FORM ----------------------------------------
  $('#add-task-form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_task',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            var event_id = data.hidden_event_id;
            $(".add-task-form").trigger("reset");
            $(".add-task-form").find("#event_id").select2().trigger('change');
            $(".add-task-form").find("input[name=priority]").val(data.priority);
            $("#add-task").modal('hide');
            if(event_id != 0){
              $('.task-section0').load(document.URL + ' .task-section0>*');
              $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
            }else{
              $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
            }
            
            // $('.total-task-count').load(document.URL + ' .total-task-count>*');
            // $('.all-tasks').load(document.URL + ' .all-tasks>*');
          }
          console.log(data);
       }// success msg ends here

     });
  });

// FOR EDIT TASK FORM ----------------------------------------
  $('#edit-task-form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/edit_task',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            $(".edit-task-form").trigger("reset");
            $("#edit-task").modal('hide');
            $('.show-task'+data.task_id).load(document.URL + ' .show-task'+data.task_id+'>*');
            $('.show-tasks'+data.task_id).load(document.URL + ' .show-tasks'+data.task_id+'>*');
            $('.task-section'+data.event_id).load(document.URL + ' .task-section'+data.event_id+'>*');
          }
          console.log(data);
       }// success msg ends here

     });
  });

  //////////////////////////////////////////////////////////////////

    $('.update-category').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var $updateEventModal = $('#update-event')
    var input_allday = $updateEventModal.find("input[name=event_allDay]");
    var ip_sedate=$updateEventModal.find("input[name=event_start_end_date]").val();
    var input_dd = ip_sedate.split(' - ');

    var input_sdate=input_dd[0];
    var input_edate=input_dd[1];
    var input_stime=$updateEventModal.find("select[name=event_start_time]").val();
    var input_etime=$updateEventModal.find("select[name=event_end_time]").val();

    var op_sdate = new Date(input_sdate+' '+input_stime);
    var op_edate = new Date(input_edate+' '+input_etime);
    if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
    {
        var formData = new FormData(this);             
        $.ajax({
            url: base_url+'front/update_event_form',
            type:"POST",
            data:formData,
            contentType:false,
            processData:false,
            cache:false,
            success: function(data) {
                if (data.status == false)
                {
                    //show errors
                    $('[id*=Err]').html('');
                    $.each(data.errors, function(key, val) {
                        var key =key.replace(/\[]/g, '');
                        key=key+'Err';    
                        $('#'+ key).html(val);
                    })
                }
                else if(data.status == true){
                  $('.modal').modal('hide');
                  $('.all-tasks').load(document.URL + ' .all-tasks>*');
                  $('.all-events').load(document.URL + ' .all-events>*');
                }                   
            }
        });
    }else{
        $updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
    }                                 
    });
  
    // FOR MODULE FORM ----------------------------------------
  $('#task-comment').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_comment',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            var viewtask = $('#view-task');
            $(viewtask).find('form').trigger('reset');
            viewtask.find('.task-comment-div').empty();
            if(data.task_comments.length != 0){
              $.each(data.task_comments, function(key,tc) {
                var comment = tc.comment;
                var regex = /(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/ig
                var comment = comment.replace(regex, "<a href='$1' target='_blank'>$1</a>");
                var comment_date = moment(tc.date,'YYYY-MM-DD HH:mm').format('Do MMMM YYYY, h:mm A');
                var comment_div = $('<div class="card d-inline-block float-left mr-2 no-shadow bg-white min-w-p100 show-comment'+tc.id+'"></div>');
              comment_div.append('<div class="position-absolute pt-1 pr-2 r-0"></div>');
              comment_div.find('.position-absolute')
                         .append('<span class="text-extra-small text-muted font-size-10 comment-date mr-20">'+comment_date+'</span><span class="delete-comment" onclick="deleteComment('+tc.id+');"><i class="fa fa-trash"></i></span>');
              comment_div.append('<div class="card-body mt-5"></div>');     
              comment_div.find('.card-body')
                         .append('<div class="d-flex flex-row"></div>');   
              comment_div.find('.card-body').find('.flex-row')
                         .append('<a class="d-flex" href="#">'+data.photo+'<p class="mb-0 mt-5 font-size-14 text-dark">'+data.student_name+'</p></a>');  
              comment_div.find('.card-body')     
                          .append('<div class="chat-text-left pl-50"></div>'); 
              if(tc.comment.length > 120){     
                comment_div.find('.card-body').find('.chat-text-left') 
                         .append('<p class="mb-0 text-semi-muted comment-note">'+comment.substr(0, 120)+'<a class="readmore read-more'+tc.id+'" onclick="return readMoreComment('+tc.id+');"> Read more</a><span class="show-more'+tc.id+'" style="display: none;">'+comment.substr(120)+' <a class="readless read-less'+tc.id+'" onclick="return readLess('+tc.id+');">Read less</a></span></p>');
              }else{
                comment_div.find('.card-body').find('.chat-text-left') 
                         .append('<p class="mb-0 text-semi-muted comment-note">'+comment+'</p>');
              }  
              viewtask.find('.task-comment-div').append(comment_div);
              var clearfix = $('<div class="clearfix"></div>');
              viewtask.find('.task-comment-div').append(comment_div);
              viewtask.find('.task-comment-div').append(clearfix);
              });
            }else{
              viewtask.find('.task-comment-div').html('<p class="text-light float-center">Add relevant notes, links or anything else here.</p>');
            } 
          }
          console.log(data);
       }// success msg ends here

     });
  });
   /////////////////////////////////////////////////////////////

  $('.event-add-task').on('click',function(){
    if($(this).next('.panel').css('display') == 'none')
    {
      $(this).next('.panel').css('display','block');
      $(this).next('.panel').find('input[name=task_name]').prop('required',true);
      $(this).next('.panel').find('select[name=priority]').prop('required',true);
      $(this).next('.panel').find('input[name=task_start_date]').prop('required',true);
    }
    else
    {
      $(this).next('.panel').css('display','none');
      $(this).next('.panel').find("input[name=task_name]").val('');
      $(this).next('.panel').find("input[name=task_name]").prop('required',false);
      $(this).next('.panel').find("select[name=priority]").prop('required',false);
      $(this).next('.panel').find("input[name=task_start_date]").prop('required',false);
      $(this).next('.panel').trigger("reset");
    }
  });

////////////////////////////////////////////////////////////////////

  $("#update-event").on("hidden.bs.modal", function () {
    $(this).find('.add-task-panel').css('display','none');
    $(this).find("input[name=task_name]").val('');
    $(this).find("input[name=task_name]").prop('required',false);
    $(this).find("select[name=priority]").prop('required',false);
    $(this).find("input[name=task_start_date]").prop('required',false);
    $(this).find('.add-task-panel').trigger("reset");
  });

  $("#add-new-events").on("hidden.bs.modal", function () {
    $(this).find('.add-task-panel').css('display','none');
    $(this).find("input[name=task_name]").val('');
    $(this).find("input[name=task_name]").prop('required',false);
    $(this).find("select[name=priority]").prop('required',false);
    $(this).find("input[name=task_start_date]").prop('required',false);
    $(this).find('.add-task-panel').trigger("reset");
  });
  
      // FOR ADD EVENT FORM ----------------------------------------
  $('#add-event-form').on('submit',function(event){
    event.preventDefault(); // Stop page from refreshing
    var input_allday = $('#add-event-form').find("input[name=event_allDay]");
    var ip_sedate=$('#add-event-form').find("input[name=event_start_end_date]").val();
    var input_dd = ip_sedate.split(' - ');

    var input_sdate=input_dd[0];
    var input_edate=input_dd[1];
    var input_stime=$('#add-event-form').find("select[name=event_start_time]").val();
    var input_etime=$('#add-event-form').find("select[name=event_end_time]").val();

    var op_sdate = new Date(input_sdate+' '+input_stime);
    var op_edate = new Date(input_edate+' '+input_etime);
    if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
    {
      var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_draggable_event',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            $('#add-event-form').trigger("reset");
            $("#add-new-events").modal('hide');
            $('.all-tasks').load(document.URL + ' .all-tasks>*');
          }
          console.log(data);
       }// success msg ends here

     });
    }else{
        $('#add-event-form').find('#event_end_timeErr').html('End Time should be greater than Start time');
    } 
  });

////////////////////////////////////////////////////////////////////

  $("input[name='view_days']").click(function () {
      var view_days = $(this).val();
      if(view_days == 'day')
      {
        var today = moment().format('Y-MM-DD');
        $(".filter-data .all-data").filter(function() {
          $(this).toggle($(this).attr('id').indexOf(today) == 0);
        });
      }
      else if(view_days == 'week')
      {
        var sunday = moment().day("sunday").subtract(1, 'days').format('Y-MM-DD');
        var saturday = moment().day("saturday").add(1, 'days').format('Y-MM-DD'); 
             
        $(".filter-data .all-data").filter(function() {
          var dates = $(this).attr('id');
          $(this).toggle(moment(dates).isBetween(sunday, saturday));
        });
      }
      else if(view_days == 'month')
      {
        var month = moment().format('Y-MM');
        $(".filter-data .all-data").filter(function() {
          $(this).toggle($(this).attr('id').indexOf(month) == 0);
        });
      }
      else if(view_days == 'all')
      {
        $(".filter-data .all-data").filter(function() {
          $(this).toggle($(this).attr('id').indexOf($(this).attr('id')) == 0);
        });
      }
  });

});
////////////////////////////////////////////////////////

function removeDragEvent(drag_id)
{
  $.ajax({
    url: base_url+'front/delete_draggable_event',
    type: 'POST', 
    data: {drag_id: drag_id},
    success: function(html){
      $(".drag-event"+drag_id).remove();
    }
  });
}

 // SHOW EDIT MODAL FOR DRAG EVENT----------------------------------------

function editModalDragEvent(drag_id)
{
  $.ajax({
    url: base_url+'front/get_drag_event_data',
    type: 'POST', 
    data: {drag_id: drag_id},
    success: function(data){
      $("#edit-drag-event").modal('show');
      $("#edit-drag-event").find("input[name=event_name]").val(data.event_name); 
      $("#edit-drag-event").find("select[name='event_color']").val(data.event_color); 
      $("#edit-drag-event").find("textarea[name=event_note]").val(data.event_note);
      $("#edit-drag-event").find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(data.event_start_date);
      $("#edit-drag-event").find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(data.event_end_date);
      // $("#edit-drag-event").find("input[name=event_start_end_date]").val(data.event_start_date+ ' - ' +data.event_end_date);
      if(data.allDay == 'false'){
          $("#edit-drag-event").find("select[name=event_start_time]").val(moment(data.event_start_time, "HH:mm").format('hh:mm A'));
          $("#edit-drag-event").find("select[name=event_start_time]").select2().trigger('change');
          $("#edit-drag-event").find("select[name=event_end_time]").val(moment(data.event_end_time, "HH:mm").format('hh:mm A'));
          $("#edit-drag-event").find("select[name=event_end_time]").select2().trigger('change');
          $("#edit-drag-event").find("input[name=event_allDay]").prop('checked', false);
          $("#drag-date-time-section").show();
      }else{
          $("#edit-drag-event").find("input[name=event_allDay]").prop('checked', true);
          $("#drag-date-time-section").hide();
      }
      // $("#edit-drag-event").find("select[name='event_repeat_option']").val(data.event_repeat_option); 
      $("#edit-drag-event").find("select[name='event_reminder']").val(data.event_reminder); 
      $("#edit-drag-event").find("input[name=drag_id]").val(data.drag_id);
    }
  });
}

// VIEW TASK ON MODAL----------------------------------------

function viewTask(task_id)
{
  event.preventDefault(); // Stop page from refreshing
  $.ajax({
    url: base_url+'front/get_view_task_data',
    type: 'POST', 
    data: {task_id: task_id},
    success: function(data){
      $("#view-task").modal('show');
      var viewtask = $("#view-task");
      viewtask.find(".comment_task_id").val(data.task_id);
      viewtask.find("input[name=task_id]").val(data.task_id);
      if(data.event_name.length > 80){  
      var typee = "'event_name'";  
          var event_name = data.event_name.substr(0, 80) +'<a class="readmore read-moreevent_name'+data.task_id+'" onclick="return readMoreContent('+typee+','+data.task_id+');"> Read more</a><span class="show-moreevent_name'+data.task_id+'" style="display: none;">'+data.event_name.substr(80)+' <a class="readless read-lessevent_name'+data.task_id+'" onclick="return readLess('+typee+','+data.task_id+');">Read less</a></span>';
        }else{
          var event_name = data.event_name;
        }
      viewtask.find('.task-event').html(event_name);
      if(data.task_name.length > 102){  
      var typee = "'event_task_name'";  
          var task_name = data.task_name.substr(0, 102) +'<a class="readmore read-moreevent_task_name'+data.task_id+'" onclick="return readMoreContent('+typee+','+data.task_id+');"> Read more</a><span class="show-moreevent_task_name'+data.task_id+'" style="display: none;">'+data.task_name.substr(102)+' <a class="readless read-lessevent_task_name'+data.task_id+'" onclick="return readLess('+typee+','+data.task_id+');">Read less</a></span>';
        }else{
          var task_name = data.task_name;
        }
      viewtask.find('.task-name').html(task_name);
      if(data.task_note.length > 130){  
      var typee = "'event_task_note'";  
          var task_note = data.task_note.substr(0, 130) +'<a class="readmore read-moreevent_task_note'+data.task_id+'" onclick="return readMoreContent('+typee+','+data.task_id+');"> Read more</a><span class="show-moreevent_task_note'+data.task_id+'" style="display: none;">'+data.task_note.substr(130)+' <a class="readless read-lessevent_task_note'+data.task_id+'" onclick="return readLess('+typee+','+data.task_id+');">Read less</a></span>';
        }else{
          var task_note = data.task_note;
        }
      viewtask.find('.task-note').html(task_note);
      viewtask.find('.task-priority').html(data.priority);
      if(data.priority == 'High Priority'){
        viewtask.find('.task-priority').html('<img title="High Priority" src="'+base_url+'assets/images/icons/2-removebg-preview.png" width="15" height="15">');
      }else if(data.priority == 'Medium Priority'){
        viewtask.find('.task-priority').html('<img title="Medium Priority" src="'+base_url+'assets/images/icons/3-removebg-preview.png" width="15" height="15">');
      }else if(data.priority == 'Low Priority'){
        viewtask.find('.task-priority').html('<img title="Low Priority" src="'+base_url+'assets/images/icons/4-removebg-preview.png" width="15" height="15">');
      }else if(data.priority == 'None'){
        viewtask.find('.task-priority').html('<img title="None" src="'+base_url+'assets/images/icons/6-removebg-preview.png" width="15" height="15">');
      }
      if(data.task_reminder != 'No reminder'){
        viewtask.find('.task-reminder').removeClass('mdi mdi-alarm');
        viewtask.find('.task-reminder').addClass('mdi mdi-alarm');
        viewtask.find('.task-reminder').attr('title', data.task_reminder);
      }else{
        viewtask.find('.task-reminder').removeClass('mdi mdi-alarm');
      }
      // viewtask.find('.modal-body').find('.filled-in').attr('id', 'modal_checkbox'+data.task_id);
      // viewtask.find('.modal-body').find('label:first').attr('for', 'modal_checkbox'+data.task_id);
      if(data.task_allDay == 'true'){
        viewtask.find('.task-start-date').html('<i class="mdi mdi-calendar"></i> '+moment(data.task_start_date, "YYYY-MM-DD").format('DD MMM'));
        viewtask.find('.task-allday').html('All Day');
      }else{
        viewtask.find('.task-start-date').html('<i class="mdi mdi-calendar"></i> '+moment(data.task_start_date, "YYYY-MM-DD").format('DD MMM')+' '+moment(data.task_start_time, "HH:mm").format('hh:mm A'));
        viewtask.find('.task-allday').html('');
      }
      viewtask.find('.task-comment-div').empty();
      if(data.task_comments.length != 0){
        $.each(data.task_comments, function(key,tc) {

          var comment = tc.comment;
          var regex = /(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/ig
          var comment = comment.replace(regex, "<a href='$1' target='_blank'>$1</a>");

          var comment_date = moment(tc.date,'YYYY-MM-DD HH:mm').format('Do MMMM YYYY, h:mm A');
          var comment_div = $('<div class="card d-inline-block float-left mr-2 no-shadow bg-white min-w-p100 show-comment'+tc.id+'"></div>');
              comment_div.append('<div class="position-absolute pt-1 pr-2 r-0"></div>');
              comment_div.find('.position-absolute')
                         .append('<span class="text-extra-small text-muted font-size-10 comment-date mr-20">'+comment_date+'</span><span class="delete-comment" onclick="deleteComment('+tc.id+');"><i class="fa fa-trash"></i></span>');
              comment_div.append('<div class="card-body mt-5"></div>');     
              comment_div.find('.card-body')
                         .append('<div class="d-flex flex-row"></div>');   
              comment_div.find('.card-body').find('.flex-row')
                         .append('<a class="d-flex" href="#">'+data.photo+'<p class="mb-0 mt-5 font-size-14 text-dark">'+data.student_name+'</p></a>');  
              comment_div.find('.card-body')     
                          .append('<div class="chat-text-left pl-50"></div>'); 
              if(tc.comment.length > 120){
                
                comment_div.find('.card-body').find('.chat-text-left') 
                         .append('<p class="mb-0 text-semi-muted comment-note">'+comment.substr(0, 120)+'<a class="readmore read-more'+tc.id+'" onclick="return readMoreComment('+tc.id+');"> Read more</a><span class="show-more'+tc.id+'" style="display: none;">'+comment.substr(120)+' <a class="readless read-less'+tc.id+'" onclick="return readLessComment('+tc.id+');">Read less</a></span></p>');
              }else{
                comment_div.find('.card-body').find('.chat-text-left') 
                         .append('<p class="mb-0 text-semi-muted comment-note">'+comment+'</p>');
              }  
              viewtask.find('.task-comment-div').append(comment_div);
              var clearfix = $('<div class="clearfix"></div>');
              viewtask.find('.task-comment-div').append(comment_div);
              viewtask.find('.task-comment-div').append(clearfix);
        });
      }else{
        viewtask.find('.task-comment-div').html('<div style="text-align:center;"><img src="'+base_url+'assets/images/no_data.webp" class="w-p35"><p class="text-light float-center">Add relevant notes, links or anything else here.</p></div>');
      }  
    }
  });
}

 // SHOW EDIT MODAL FOR DRAG EVENT----------------------------------------

function editModalTask(task_id)
{
  $.ajax({
    url: base_url+'front/get_task_data',
    type: 'POST', 
    data: {task_id: task_id},
    success: function(data){
      $("#edit-task").modal('show');
      var edittask = $("#edit-task");
      edittask.find("input[name=task_name]").val(data.task_name); 
      edittask.find("textarea[name=task_note]").val(data.task_note); 
      edittask.find("input[name=task_category]").val(data.task_category); 
      edittask.find("input[name=task_start_date]").val(data.task_start_date); 
      edittask.find("input[name=priority]").val(data.priority); 
      if(data.priority == 'High Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='High Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/2-removebg-preview.png');
      }else if(data.priority == 'Medium Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find("img[icon-value='Medium Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/3-removebg-preview.png');
      }else if(data.priority == 'Low Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='Low Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/4-removebg-preview.png');
      }else if(data.priority == 'None'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='None']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/6-removebg-preview.png');
      }
      edittask.find("select[name=task_reminder]").val(data.task_reminder); 
      edittask.find("select[name=event_id]").val(data.event_id); 
      edittask.find("select[name=event_id]").select2().trigger('change');
      edittask.find("input[name=task_id]").val(data.task_id); 
      edittask.find("input[name=hidden_event_id]").val(data.event_id); 
      if(data.task_allDay == 'false'){
          edittask.find("select[name=task_start_time]").val(moment(data.task_start_time, "HH:mm").format('hh:mm A'));
          edittask.find("select[name=task_start_time]").select2().trigger('change');
          edittask.find("input[name=task_allDay]").prop('checked', false);
          $("#task-time-section1").show();
      }else{
          edittask.find("input[name=task_allDay]").prop('checked', true);
          $("#task-time-section1").hide();
      }
    }
  });
}

/////////////////////////////////////////////////////////////////////

function showEditModalTask()
{
  var task_id = $("#view-task").find("input[name=task_id]").val(); 
  $.ajax({
    url: base_url+'front/get_task_data',
    type: 'POST', 
    data: {task_id: task_id},
    success: function(data){
      $("#view-task").modal('hide');
      $("#edit-task").modal('show');
      var edittask = $("#edit-task");
      edittask.find("input[name=task_name]").val(data.task_name); 
      edittask.find("textarea[name=task_note]").val(data.task_note);  
      edittask.find("input[name=task_category]").val(data.task_category); 
      edittask.find("input[name=task_start_date]").val(data.task_start_date); 
      edittask.find("input[name=priority]").val(data.priority); 
      if(data.priority == 'High Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='High Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/2-removebg-preview.png');
      }else if(data.priority == 'Medium Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find("img[icon-value='Medium Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/3-removebg-preview.png');
      }else if(data.priority == 'Low Priority'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='Low Priority']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/4-removebg-preview.png');
      }else if(data.priority == 'None'){
        edittask.find("#my-icon-select4-box-scroll").find(".icon").removeClass('selected');
        edittask.find("#my-icon-select4-box-scroll").find(".icon").find("img[icon-value='None']").parent().addClass('selected');
        edittask.find("#my-icon-select4").find(".selected-box").find(".selected-icon").find("img").attr('src',base_url+'assets/images/icons/6-removebg-preview.png');
      }
      edittask.find("select[name=task_reminder]").val(data.task_reminder); 
      edittask.find("select[name=event_id]").val(data.event_id); 
      edittask.find("select[name=event_id]").select2().trigger('change');
      edittask.find("input[name=task_id]").val(data.task_id); 
      if(data.task_allDay == 'false'){
          edittask.find("select[name=task_start_time]").val(moment(data.task_start_time, "HH:mm").format('hh:mm A'));
          edittask.find("select[name=task_start_time]").select2().trigger('change');
          edittask.find("input[name=task_allDay]").prop('checked', false);
          $("#task-time-section1").show();
      }else{
          edittask.find("input[name=task_allDay]").prop('checked', true);
          $("#task-time-section1").hide();
      }
    }
  });
}
////////////////////////////////////////////////////////

function deleteTask(task_id)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete the task !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      url: base_url+'front/delete_task',
      type: 'POST',
      data: {
          task_id:task_id 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success"); 
        $('.total-task-count').load(document.URL + ' .total-task-count>*');
        $(".show-task"+task_id).remove();
      }
    });      
  });
}

////////////////////////////////////////////////////////

function deleteComment(comment_id)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete the comment !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      url: base_url+'front/delete_comment',
      type: 'POST',
      data: {
          comment_id:comment_id 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success"); 
        $(".show-comment"+comment_id).remove();
      }
    });      
  });
}
////////////////////////////////////////////////////////

function completeTask(classname,task_id)
{
  if ($(classname+task_id).is(":checked")) {
        var complete = 'yes';
      } else {
        var complete = '';
      }
  $.ajax({
    url: base_url+'front/complete_task',
    type: 'POST', 
    data: {
      complete: complete, task_id: task_id
    },
    success: function(data){
      $('.status'+task_id+'>span').remove();
      $('.status'+task_id).html(data.status);
      if(complete == 'yes'){
        var d = $('.out-off').html();
        var d = parseInt(d)-1;
        $('.out-off').html(d);
        $.toast({
          heading: 'project91',
          text: '<b>Completed.</b> Uncheck to Undo',
          position: 'top-right',
          loaderBg: '#9fcd53',
          icon: 'success',
          hideAfter: 4500,
          stack: 6
      });
      }else{
        var d = $('.out-off').html();
        var d = parseInt(d)+1;
        $('.out-off').html(d);
      }
      console.log(data);
    }
  });
}

////////////////////////////////////////////////////////

function incompleteTask(classname,task_id)
{
  if ($(classname+task_id).is(":checked")) {
        var complete = 'yes';
      } else {
        var complete = '';
      }
  $.ajax({
    url: base_url+'front/complete_task',
    type: 'POST', 
    data: {
      complete: complete, task_id: task_id
    },
    success: function(data){
      $('.status'+task_id+'>span').remove();
      $('.status'+task_id).html(data.status);
      if(complete == 'yes'){
        var d = $('.out-off').html();
        var d = parseInt(d)-1;
        $('.out-off').html(d);
        $.toast({
          heading: 'project91',
          text: '<b>Incomplete.</b> Uncheck to Undo',
          position: 'top-right',
          loaderBg: '#9fcd53',
          icon: 'success',
          hideAfter: 4500,
          stack: 6
      });
      }else{
        var d = $('.out-off').html();
        var d = parseInt(d)+1;
        $('.out-off').html(d);
      }
      console.log(data);
    }
  });
}

///////////////////////////////////////////////

function completeEventTask(classname,task_id,event_id)
{
  event.preventDefault();
  if ($(classname+task_id).is(":checked")) {
        var complete = 'yes';
      } else {
        var complete = '';
      }
  $.ajax({
    url: base_url+'front/complete_event_task',
    type: 'POST', 
    data: {
      complete: complete, task_id: task_id, event_id:event_id
    },
    success: function(data){
      $('.sr-only'+event_id).html(data.task_percent+'% Complete');
      $('.task-progress-bar'+event_id).width(data.task_percent+'%');
      $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
      if(complete == 'yes'){
        $.toast({
          heading: 'project91',
          text: '<b>Completed.</b> Uncheck to Undo',
          position: 'top-right',
          loaderBg: '#9fcd53',
          icon: 'success',
          hideAfter: 4500,
          stack: 6
      });
      }
    }
  });
}

///////////////////////////////////////////////

function incompleteEventTask(classname,task_id,event_id)
{
  if ($(classname+task_id).is(":checked")) {
        var complete = '';
      } else {
        var complete = 'yes';
      }
  $.ajax({
    url: base_url+'front/complete_event_task',
    type: 'POST', 
    data: {
      complete: complete, task_id: task_id, event_id:event_id
    },
    success: function(data){
      $('.sr-only'+event_id).html(data.task_percent+'% Complete');
      $('.task-progress-bar'+event_id).width(data.task_percent+'%');
      $('.task-section'+event_id).load(document.URL + ' .task-section'+event_id+'>*');
      if(complete == ''){
        $.toast({
          heading: 'project91',
          text: '<b>Incomplete.</b> Uncheck to Undo',
          position: 'top-right',
          loaderBg: '#9fcd53',
          icon: 'success',
          hideAfter: 4500,
          stack: 6
      });
      }
    }
  });
}

/////////////////////////////////////////////////////

function closeModal(modal_name){
  if(($(modal_name).find("input").val().length != '') || ($(modal_name).find("textarea").val().length != '')){
    if(confirm('Changes you made may not be saved.')){
      $(modal_name).find('form').trigger('reset');
      $(modal_name).modal('hide');      
    }else{
      return false;
    }
  }else{
    $(modal_name).find('form').trigger('reset');
    $(modal_name).modal('hide');
  }   
}

///////////////////////////////////////////////////////////////////

function viewEvent(event_id)
{
  event.preventDefault(); // Stop page from refreshing
  $.ajax({
    url: base_url+'front/get_event_data',
    type: 'POST', 
    data: {event_id: event_id},
    success: function(data){
      $("#view-event").modal('show');
      var viewevent = $("#view-event");
      viewevent.find("input[name=event_id]").val(data.event_id);
      if(data.event_name.length > 80){  
      var typee = "'event_name'";  
          var event_name = data.event_name.substr(0, 80) +'<a class="readmore read-moreevent_name'+data.event_id+'" onclick="return readMoreContent('+typee+','+data.event_id+');"> Read more</a><span class="show-moreevent_name'+data.event_id+'" style="display: none;">'+data.event_name.substr(80)+' <a class="readless read-lessevent_name'+data.event_id+'" onclick="return readLess('+typee+','+data.event_id+');">Read less</a></span>';
        }else{
          var event_name = data.event_name;
        }
      viewevent.find('.event-name').html(event_name);
      if(data.event_note.length > 120){  
      var typee = "'event'";  
          var event_note = data.event_note.substr(0, 120) +'<a class="readmore read-moreevent'+data.event_id+'" onclick="return readMoreContent('+typee+','+data.event_id+');"> Read more</a><span class="show-moreevent'+data.event_id+'" style="display: none;">'+data.event_note.substr(120)+' <a class="readless read-lessevent'+data.event_id+'" onclick="return readLess('+typee+','+data.event_id+');">Read less</a></span>';
        }else{
          var event_note = data.event_note;
        }
      viewevent.find('.event-note').html(event_note);
      if(data.event_color == 'bg-success'){
        viewevent.find('.event-color').removeClass('bg-danger');
        viewevent.find('.event-color').removeClass('bg-warning');
        viewevent.find('.event-color').removeClass('bg-info');
        viewevent.find('.event-color').removeClass('bg-primary');
        viewevent.find('.event-color').removeClass('bg-dark');
        viewevent.find('.event-color').addClass('bg-success');
      }else if(data.event_color == 'bg-danger'){
        viewevent.find('.event-color').removeClass('bg-success');
        viewevent.find('.event-color').removeClass('bg-warning');
        viewevent.find('.event-color').removeClass('bg-info');
        viewevent.find('.event-color').removeClass('bg-primary');
        viewevent.find('.event-color').removeClass('bg-dark');
        viewevent.find('.event-color').addClass('bg-danger');
      }else if(data.event_color == 'bg-warning'){
        viewevent.find('.event-color').removeClass('bg-success');
        viewevent.find('.event-color').removeClass('bg-danger');
        viewevent.find('.event-color').removeClass('bg-info');
        viewevent.find('.event-color').removeClass('bg-primary');
        viewevent.find('.event-color').removeClass('bg-dark');
        viewevent.find('.event-color').addClass('bg-warning');
      }else if(data.event_color == 'bg-info'){
        viewevent.find('.event-color').removeClass('bg-success');
        viewevent.find('.event-color').removeClass('bg-danger');
        viewevent.find('.event-color').removeClass('bg-warning');
        viewevent.find('.event-color').removeClass('bg-primary');
        viewevent.find('.event-color').removeClass('bg-dark');
        viewevent.find('.event-color').addClass('badge-info');
      }else if(data.event_color == 'bg-primary'){
         viewevent.find('.event-color').removeClass('bg-success');
        viewevent.find('.event-color').removeClass('bg-danger');
        viewevent.find('.event-color').removeClass('bg-warning');
        viewevent.find('.event-color').removeClass('bg-info');
        viewevent.find('.event-color').removeClass('bg-dark');
        viewevent.find('.event-color').addClass('bg-primary');
      }else if(data.event_color == 'bg-dark'){
         viewevent.find('.event-color').removeClass('bg-success');
        viewevent.find('.event-color').removeClass('bg-danger');
        viewevent.find('.event-color').removeClass('bg-warning');
        viewevent.find('.event-color').removeClass('bg-info');
        viewevent.find('.event-color').removeClass('bg-primary');
        viewevent.find('.event-color').addClass('bg-dark');
      }
      if(data.event_reminder != 'No reminder'){
        viewevent.find('.event-reminder').removeClass('mdi mdi-alarm');
        viewevent.find('.event-reminder').addClass('mdi mdi-alarm');
        viewevent.find('.event-reminder').attr('title', data.event_reminder);
      }else{
        viewevent.find('.event-reminder').removeClass('mdi mdi-alarm');
      }
      if(data.event_allDay == 'true'){
        viewevent.find('.event-start-date').html('<i class="mdi mdi-calendar"></i> All Day');
      }else{
        if(data.event_start_date == data.event_end_date){
          viewevent.find('.event-start-date').html('<i class="mdi mdi-calendar"></i> '+moment(data.event_start_date, "YYYY-MM-DD").format('DD MMM'));
        }else{
          viewevent.find('.event-start-date').html('<i class="mdi mdi-calendar"></i> '+moment(data.event_start_date, "YYYY-MM-DD").format('DD MMM') + ' - ' + moment(data.event_end_date, "YYYY-MM-DD").format('DD MMM'));
        }
      }
    }
  });
}

//////////////////////////////////////////////////////////////////

function showeditEventModal(event_id)
{
  event.preventDefault(); // Stop page from refreshing
  $.ajax({
    url: base_url+'front/get_event_data',
    type: 'POST', 
    data: {event_id: event_id},
    success: function(data){
      $("#update-event").modal('show');
      var $updateEventModal = $("#update-event");
      $updateEventModal.find("input[name=event_name]").val(data.event_name); 
      $updateEventModal.find("select[name='event_color']").val(data.event_color);
      $updateEventModal.find("textarea[name=event_note]").val(data.event_note);
      $updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(data.event_start_date);
      $updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(data.event_end_date);
      // $updateEventModal.find("input[name=event_start_end_date]").val(data.event_start_date+ ' - ' +data.event_end_date);
      if(data.event_allDay == 'false'){
          $updateEventModal.find("select[name=event_start_time]").val(moment(data.event_start_time, "HH:mm").format('hh:mm A'));
          $updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
          $updateEventModal.find("select[name=event_end_time]").val(moment(data.event_end_time, "HH:mm").format('hh:mm A'));
          $updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
          $updateEventModal.find("input[name=event_allDay]").prop('checked', false);
          $("#date-time-section1").show();
      }else{
          $updateEventModal.find("input[name=event_allDay]").prop('checked', true);
          $("#date-time-section1").hide();
      }
      // $updateEventModal.find("select[name='event_repeat_option']").val(data.event_repeat_option); 
      $updateEventModal.find("select[name='event_reminder']").val(data.event_reminder); 
      if(data.draggable_event == 'on'){
          $updateEventModal.find("input[name=draggable_event]").prop('checked', true);
      }else{
          $updateEventModal.find("input[name=draggable_event]").prop('checked', false);
      }
      $updateEventModal.find("input[name=event_id]").val(data.event_id);
      $updateEventModal.find("input[name=draggable_id]").val(data.draggable_id);
    }
  });
}

//////////////////////////////////////////////////////////////////

function deleteEvent(event_id)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete the event !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      url: base_url+'front/delete_event',
      type: 'POST',
      data: {
          event_id:event_id 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success");
        $(".show-event"+event_id).remove(); 
        $("#view-event"+event_id).modal('hide');
      }
    });      
  });
}

///////////////////////////////////////////////////////

function showEvent(event_id){
  $('#add-task').find("select[name=event_id]").val(event_id); 
  $('#add-task').find("#event_id").select2().trigger('change');
}

 // FOR PLANNER FORM ----------------------------------------
 $('#planner_form').on('submit',function(event){  
  event.preventDefault(); // Stop page from refreshing
  $('#planner_submit').hide();
  $('#planner_loader').css('visibility', 'visible');
  var formData = new FormData(this); 
  $.ajax({
       url:base_url+'front/insert_planner',
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       cache:false,
       success: function(data){
        $('#planner_submit').show();
        $('#planner_loader').css('visibility', 'hidden');
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
          window.location = base_url+'planner';
        }
        console.log(data);
     }// success msg ends here

   });
});

  // FOR EDIT PLANNER FORM ----------------------------------------
  $('#edit_planner_form').on('submit',function(event){  
    alert()
    event.preventDefault(); // Stop page from refreshing
    $('#edit_planner_submit').hide();
    $('#edit_planner_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_edit_planner',
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
            window.location = base_url+'planner';
          }
          console.log(data);
       }// success msg ends here

     });
  });

    // FOR Study Block FORM ----------------------------------------
  $('#study_block_form').on('submit',function(event){  
    event.preventDefault(); // Stop page from refreshing
    $('#study_block_submit').hide();
    $('#study_block_loader').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'front/insert_study_block',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#study_block_submit').show();
          $('#study_block_loader').css('visibility', 'hidden');
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
          else if (data.status == 'filesErr')
          {
            $('#filesErr').html(data.filesErr);            
          }
          else if(data.status == true){
            window.location = base_url+'view-study-block/'+data.sid;
          }
          console.log(data);
       }// success msg ends here

     });
  });
////////////////////////////////////////////////////////
  // FOR EDIT Study Block FORM ----------------------------------------
  function editPlanner(planner_id)
  {  
    event.preventDefault(); // Stop page from refreshing
    $('#edit_planner_submit'+planner_id).hide();
    $('#edit_planner_loader'+planner_id).css('visibility', 'visible');
    var formData = new FormData(document.getElementById('edit_planner_form'+planner_id)); 
    $.ajax({
         url:base_url+'front/insert_edit_planner',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          $('#edit_planner_submit'+planner_id).show();
          $('#edit_planner_loader'+planner_id).css('visibility', 'hidden');
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
            window.location = base_url+'planner';
          }
          console.log(data);
       }// success msg ends here
  
     });
  }

  function deletePlanner(planner_id)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete the Planner !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      url: base_url+'front/delete_planner',
      type: 'POST',
      data: {
          planner_id:planner_id 
      }, 
      success: function(data){
        swal("Deleted!", "Successfully.", "success"); 
        $(".show-planner"+planner_id).remove();
      }
    });      
  });
}

 // FOR EDIT Study Block FORM ----------------------------------------
 function editStudyBlock(study_block_id)
 {  
   event.preventDefault(); // Stop page from refreshing
   $('#edit_study_block_submit'+study_block_id).hide();
   $('#edit_study_block_loader'+study_block_id).css('visibility', 'visible');
   var formData = new FormData(document.getElementById('edit_study_block_form'+study_block_id)); 
   $.ajax({
        url:base_url+'front/insert_edit_study_block',
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        cache:false,
        success: function(data){
         $('#edit_study_block_submit'+study_block_id).show();
         $('#edit_study_block_loader'+study_block_id).css('visibility', 'hidden');
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
         else if (data.status == 'filesErr')
         {
           $('#filesErr').html(data.filesErr);            
         }
         else if(data.status == true){
           window.location = base_url+'view-study-block/'+data.sid;
         }
         console.log(data);
      }// success msg ends here
 
    });
 }

 function deleteStudyBlock(study_block_id,planner_id,page)
{
  swal({   
    title: "Are you sure?",   
    text: "You want to delete the Study Block !",   
    type: "info",   
    showCancelButton: true,   
    confirmButtonColor: "#04a08b",   
    confirmButtonText: "Yes",   
    closeOnConfirm: false 
}, function(){ 
    $.ajax({
      url: base_url+'front/delete_study_block',
      type: 'POST',
      data: {
          study_block_id:study_block_id 
      }, 
      success: function(data){
        if(page == 'all'){
          swal("Deleted!", "Successfully.", "success"); 
          $(".show-study_block"+study_block_id).remove();
        }else{
          swal("Deleted!", "Successfully.", "success"); 
          window.location = base_url+'study-blocks/'+planner_id;
        }
      }
    });      
  });
}
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
        url: base_url+'front/logout',
        type: 'POST', 
        success: function(html){
          swal("Logged Out!", "Successfully.", "success"); 
          window.location.reload();
        }
      });      
  });
}
