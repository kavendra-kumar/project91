//[calendar Javascript]

// var base_url = 'http://91.demoserver.co.in/';
// var base_url = 'http://localhost/project91/';
var base_url = 'https://project91.isynbus.com/';

!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#external-events div.external-event'),
        this.$categoryForm = $('#add-new-events form'),
        this.$dragEventForm = $('#edit-drag-event form'),
        this.$updatecategoryForm = $('#update-event form'),
        this.$extEvents = $('#external-events'),
        this.$categoryModal = $('#add-new-events'),
        this.$dragEventModal = $('#edit-drag-event'),
        this.$viewEventModal = $('#view-event'),
        this.$myModal = $('#myModal'),
        this.$myModalUpdate = $('#myModalUpdate'),
        this.$updateEventModal = $('#update-event'),
        this.$calendarObj = null
    };

    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date, jsEvent, ui, resourceId) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            var drag_id = eventObj.attr('id');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];            
            var drag_date = $.fullCalendar.formatDate(copiedEventObject.start, "Y-MM-DD HH:mm:ss");
            var dd = drag_date.split(' ');
            var day_type = resourceId.name;
            if(day_type == 'agendaDay' || day_type == 'agendaWeek'){
                if(dd[1] == '00:00:00'){
                    var allDay = 'true';
                }else{
                    var allDay = 'false';
                } 
            }else{
               var allDay = 'true_false';
            }
            
            $.ajax({
                type: "POST",
                async: false,
                url: base_url+'front/insert_drop_event',
                data: {
                   drag_id:drag_id, drag_date:drag_date, allDay:allDay,
                },
                success: function(data) {
                    if(data.allDay == 'true'){
                        var allDay = true;
                    }else{
                        var allDay = false;
                    }
                    // render the event on the calendar
                    $this.$calendar.fullCalendar('renderEvent', {
                                        student_id: data.student_id,
                                        event_id: data.event_id,
                                        title: data.event_name,
                                        className: data.event_color,
                                        allDay: allDay,
                                        type: data.type,
                                        event_start_date: data.event_start_date,
                                        event_end_date: data.event_end_date,
                                        event_note: data.event_note,
                                        event_start_time: data.event_start_time,
                                        event_end_time: data.event_end_time,
                                        event_repeat_option: data.event_repeat_option,
                                        event_reminder: data.event_reminder,
                                        draggable_event: data.draggable_event,
                                        draggable_id: data.draggable_id,
                                        drag_id: data.drag_id,
                                        start: data.start_date,
                                        end: data.end_date,
                                    }, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        $.ajax({
                            type: "POST",
                            async: false,
                            url: base_url+'front/delete_draggable_event',
                            data: {
                               drag_id:drag_id,
                            },
                            success: function(data) {
                                // if so, remove the element from the "Draggable Events" list
                                eventObj.remove();               
                            }
                        });                 
                    }

                                // setTimeout(function(){ 
                                //    $.CalendarApp.init()
                                // }, 1000);                
                }
            });
    },
     /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
        var event_new_id = calEvent.event_id;
        $.ajax({
                    type: "POST",
                    url: base_url+'front/task_data_new',
                    type: 'POST',
                    data: {
                        event_id:event_new_id 
                    }, 
                    success: function(data){
                       var task_start_date_new = data.task_start_date;
                       var task_end_date_new = data.task_end_date;
                       var date12 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                       var date14 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                       console.log("date12");
                       console.log(date12);
                       
                      // return false;
                       var start_date = $.fullCalendar.formatDate(calEvent.start, "Y-MM-DD HH:mm:ss");
                        var allDay = calEvent.allDay;
                        if(allDay == false){
                            //var end_date = $.fullCalendar.formatDate(calEvent.end, "Y-MM-DD HH:mm:ss");
                            if(task_start_date_new == task_end_date_new){
                                var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var time1 = moment(calEvent.event_start_time, 'HH:mm').format('hh:mm A');
                                var time2 = moment(calEvent.event_end_time, 'HH:mm').format('hh:mm A');
                                var eventdate = date1 + ', ' + time1+ ' - ' + time2;
                            }else{
                                var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var date2 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var time1 = moment(calEvent.event_start_time, 'HH:mm').format('hh:mm A');
                                var time2 = moment(calEvent.event_end_time, 'HH:mm').format('hh:mm A');
                                var eventdate = date1 + ', ' + time1 + ' - ' + date2 + ', ' + time2;
                            }
                            var eventallDay = '';
                        }else{
                            var end_date = calEvent.event_end_date + ' 00:00:00';
                            if(task_start_date_new == task_end_date_new){
                                var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var eventdate = date1;
                            }else{
                                var date1 = moment(task_start_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var date2 = moment(task_end_date_new, 'Y-MM-DD').format('dddd, MMMM DD YYYY');
                                var eventdate = date1 +' - '+ date2;
                            }
                            var eventallDay = 'All Day Event';
                        }  
                        if(calEvent.event_reminder != 'No reminder'){
                            var eventReminder = '<div class="col-md-1"><i class="fa fa-bell-o"></i></div><div class="col-md-11"><p class="event-reminder">' + calEvent.event_reminder + '</p></div>';
                        }else{
                            var eventReminder = '';
                        }  
                        if(calEvent.event_repeat_option != 'Does not repeat'){
                            var eventRepeatOption = '<div class="col-md-1"><i class="fa fa-repeat"></div><div class="col-md-11"></i><p class="event-repeatoption">' + calEvent.event_repeat_option + '</p></div>';
                        }else{
                            var eventRepeatOption = '';
                        } 
                        if(calEvent.title != ''){
                            if(calEvent.title.length > 80){  
                            var typee = "'event_name'";  
                                var eventTitle = calEvent.title.substr(0, 80) +'<a class="readmore read-moreevent_name'+calEvent.event_id+'" onclick="return readMoreContent('+typee+','+calEvent.event_id+');"> Read more</a><span class="show-moreevent_name'+calEvent.event_id+'" style="display: none;">'+calEvent.title.substr(80)+' <a class="readless read-lessevent_name'+calEvent.event_id+'" onclick="return readLess('+typee+','+calEvent.event_id+');">Read less</a></span>';
                            }else{
                                var eventTitle = calEvent.title;
                            }
                            
                        }else{
                            var eventTitle = '';
                        }

                        if(calEvent.event_note != ''){
                            if(calEvent.event_note.length > 120){  
                            var typee = "'event'";  
                                var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.event_note.substr(0, 120) +'<a class="readmore read-moreevent'+calEvent.event_id+'" onclick="return readMoreContent('+typee+','+calEvent.event_id+');"> Read more</a><span class="show-moreevent'+calEvent.event_id+'" style="display: none;">'+calEvent.event_note.substr(120)+' <a class="readless read-lessevent'+calEvent.event_id+'" onclick="return readLess('+typee+','+calEvent.event_id+');">Read less</a></span></p></div>';
                            }else{
                                var eventNote = '<div class="col-md-1"><i class="fa fa-align-left"></i></div><div class="col-md-11"><p class="event-note">'+ calEvent.event_note +'</p></div>';
                            }
                            
                        }else{
                            var eventNote = '';
                        } 

                        var event_color = calEvent.className[0];
                        var event_div = $('<div class="event-modal"></div>');
                            event_div.append('<div class="row first-row"></div>');
                            event_div.find('.first-row')
                                    .append('<div class="col-md-12"><h3 class="event-title">' + eventTitle + '</h3><small class="event-datetime">' + eventdate + '</small><br><br><small class="event-allday">' + eventallDay + '</small></div>');
                            event_div.append('<br><br><div class="row second-row"></div>');   
                            event_div.find('.second-row')    
                                    .append(eventNote)
                                    .append(eventReminder)
                                    .append(eventRepeatOption)
                                    .append('<div class="col-md-1"><i class="fa fa-list"></i></div><div class="col-md-11"><p class="event-task"> My ' + calEvent.type + '</p></div><input type="hidden" name="event_id" value="' + calEvent.event_id + '" >');
                            
                            $this.$viewEventModal.modal({
                                backdrop: 'static'
                            });
                            $this.$viewEventModal.find('.modal-body').empty().prepend(event_div).end();
                            $('#add-task').find("select[name=event_id]").val(calEvent.event_id); 
                            $('#add-task').find("#event_id").select2().trigger('change');
                       // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                    }
        });

        $this.$viewEventModal.find('.modal-header').find('.delete-event').unbind('click').click(function () {
            //var event_id = event_div.find("input[name=event_id]").val(); 
            $('#delete_event_two').show();
            $('#delete_event_three').show();
            $('#delete_type_edit').html("Delete recurring "+calEvent.created_type);
            var event_id = calEvent.event_id;
            console.log("calEvent.dataaaaaa");
            console.log(calEvent);
            console.log("calEvent.array_count");
            console.log(calEvent.array_count);
                if(calEvent.array_count == 1){
                    $('#delete_event_two').hide();
                    $("#myModal").modal();
                    // swal("Are you sure to delete?", {
                    //     icon: 'warning',
                    //     buttons: {
                    //       cancel: "Cancel",
                    //       confirm: true,
                    //     },
                    //   })
                    //   .then((value) => {
                    //     switch (value) {
                    //       case true:
                    //         $.ajax({
                    //             type: "POST",
                    //             url: base_url+'front/delete_event',
                    //             type: 'POST',
                    //             data: {
                    //                 event_id:event_id,
                    //                 delete_check : 1
                    //             }, 
                    //             success: function(html){
                    //                 swal("Deleted!", "Successfully.", "success"); 
                    //                 $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    //                     return (ev.unique_key === calEvent.unique_key);   
                    //                 });
                    //                 $this.$viewEventModal.modal('hide');
                    //                 //location.reload();
                    //             }
                    //         });
                    //         break;
                       
                          
                    //     }
                    //   });
                }else{
                 
                if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                    $('#delete_event_two').hide();
                    $("#myModal").modal();
                    // swal("Are you sure to delete?", {
                    //     icon: 'warning',
                    //     buttons: {
                    //       cancel: "Cancel",
                    //       confirm: true,
                    //     },
                    //   })
                    //   .then((value) => {
                    //     switch (value) {
                    //       case true:
                    //         $.ajax({
                    //             type: "POST",
                    //             url: base_url+'front/delete_event',
                    //             type: 'POST',
                    //             data: {
                    //                 event_id:event_id,
                    //                 delete_check : 1
                    //             }, 
                    //             success: function(html){
                    //                 swal("Deleted!", "Successfully.", "success"); 
                    //                 $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    //                     return (ev.unique_key === calEvent.unique_key);   
                    //                 });
                    //                 $this.$viewEventModal.modal('hide');
                    //                 //location.reload();
                    //             }
                    //         });
                    //         break;
                       
                          
                    //     }
                    //   });
                }else{
                        console.log("calEvent.isLastCount");
                        console.log(calEvent.isLastCount);
                        if(calEvent.isLastCount == 1){
                            $('#delete_event_three').hide();
                            $("#myModal").modal();
                        }else{
                            $("#myModal").modal();
                        }
                    // swal("Are you sure to delete?", {
                    //     icon: 'warning',
                    //     buttons: {
                    //       cancel: "Cancel",
                    //       catch: {
                    //         text: "Delete only this",
                    //         value: "catch",
                    //       },
                    //       following: {
                    //         text: "Delete this and following",
                    //         value: "following",
                    //       },
                    //       delete: {
                    //         text: "Delete all",
                    //         value: "delete_all",

                    //       },
                    //       //delete: true,
                          
                    //     },
                    //   })
                    //   .then((value) => {
                    //     switch (value) {
                       
                    //       case "delete_all":
                    //         $.ajax({
                    //             type: "POST",
                    //             url: base_url+'front/delete_event',
                    //             type: 'POST',
                    //             data: {
                    //                 event_id:event_id,
                    //                 delete_check : 1
                    //             }, 
                    //             success: function(html){
                    //                 swal("Deleted!", "Successfully.", "success"); 
                    //                 $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    //                     return (ev.unique_key === calEvent.unique_key);   
                    //                 });
                    //                 $this.$viewEventModal.modal('hide');
                    //                 //location.reload();
                    //             }
                    //         });
                    //         break;
                       
                    //       case "catch":
                    //             $.ajax({
                    //                 type: "POST",
                    //                 url: base_url+'front/delete_event',
                    //                 type: 'POST',
                    //                 data: {
                    //                     event_id:event_id,
                    //                     delete_check : 0
                    //                 }, 
                    //                 success: function(html){
                    //                     swal("Deleted!", "Successfully.", "success"); 
                    //                     $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    //                         return (ev.event_id === calEvent.event_id);   
                    //                     });
                    //                     $this.$viewEventModal.modal('hide');
                    //                     //location.reload();
                    //                 }
                    //             });
                    //         break;
                    //         case "following":
                    //             $.ajax({
                    //                 type: "POST",
                    //                 url: base_url+'front/delete_event',
                    //                 type: 'POST',
                    //                 data: {
                    //                     event_id:event_id,
                    //                     delete_check : 2
                    //                 }, 
                    //                 success: function(html){
                    //                         //console.log(html.data[0]);
                    //                         $.each(html.data, function(index) {
                    //                             console.log(html.data[index].id);
                    //                             swal("Deleted!", "Successfully.", "success"); 
                    //                             $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    //                             return (ev.event_id === html.data[index].id);   
                    //                         });
                    //                         $this.$viewEventModal.modal('hide');
                    //                     });
                    //                 }
                    //             });
                    //         break;
                    //     }
                    //   });
                }  
            }
            });

            this.$myModal.find('.modal-body').find('.delete-next-event').unbind('click').click(function () {
                console.log("hello js", $("input[name=delete_check_value]:checked").val());
                var event_id = calEvent.event_id;
                
                var delete_event_id = $("input[name=delete_check_value]:checked").val();
                    $.ajax({
                            type: "POST",
                            url: base_url+'front/delete_event',
                            type: 'POST',
                            data: {
                                event_id:event_id,
                                delete_check : delete_event_id
                            }, 
                            success: function(html){
                                swal("Deleted!", "Successfully.", "success");
                                if(delete_event_id == "0"){
                                    $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                        return (ev.event_id === calEvent.event_id);   
                                    });
                                }else if(delete_event_id == "1"){
                                    $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                        return (ev.unique_key === calEvent.unique_key);   
                                    });
                                }else if(delete_event_id == "2"){
                                        $.each(html.data, function(index) {
                                            console.log(html.data[index].id);
                                            $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                            return (ev.event_id === html.data[index].id);   
                                        });
                                            $this.$myModal.modal('hide');
                                        });
                                }

                                $this.$myModal.modal('hide');
                                $this.$viewEventModal.modal('hide');
                                //////// reload data
                                var view = $('#calendar').fullCalendar('getView');
                                var date = new Date();
                                var d = date.getDate();
                                var m = date.getMonth();
                                var y = date.getFullYear();
                                var form = '';
                                var today = new Date($.now());
                                var month_year = view.title;
                                var event_data = function () {
                                    var evt = null;
                                    $.ajax({
                                        method: "POST",
                                        async: false,
                                        data: {
                                            month_year:month_year, button:'today',
                                        },
                                        url: base_url+'front/get_allcalendar_events',            
                                        success: function(data){
                                            console.log("testt");
                                            var db_events = data; 
                                            function renameKey(obj, old_key, new_key) {   
                                                // check if old key = new key  
                                                if (old_key !== new_key) {                  
                                                    Object.defineProperty(obj, new_key, // modify old key
                                                    // fetch description from object
                                                    Object.getOwnPropertyDescriptor(obj, old_key));
                                                    delete obj[old_key]; // delete old key
                                                }
                                            }
                                            db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                            db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                                            db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                                            var lim = db_events.length;
                                            for (var i = 0; i < lim; i++)
                                            {                        
                                                if(db_events[i].type == 'event'){
                                                    if(db_events[i].event_allDay == 'true')
                                                    {
                                                        db_events[i].allDay = true;
                                                    }else{
                                                        db_events[i].allDay = false;
                                                    }
                                                    db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                                    db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                                    var icon_val = db_events[i].created_type;
                                                    if(icon_val == "reminder"){
                                                        db_events[i].icon = 'bell';
                                                    }else if(icon_val == "task"){
                                                        db_events[i].icon = 'edit';
                                                    }else{
                                                        db_events[i].icon = 'diamond';
                                                    }
                                                    var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                    var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                    db_events[i].new_time = time11+'-'+time22;
                                                    if(db_events[i].draggable_event == "on"){
                                                        db_events[i].editable = true;
                                                    }else{
                                                        db_events[i].editable = false;
                                                    }
                                                }else{
                                                    if(db_events[i].task_allDay == 'true')
                                                    {
                                                        db_events[i].allDay = true;
                                                    }else{
                                                        db_events[i].allDay = false;
                                                    }
                                                    db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                                    var icon_val = db_events[i].created_type;
                                                    if(icon_val == "reminder"){
                                                        db_events[i].icon = 'bell';
                                                    }else if(icon_val == "task"){
                                                        db_events[i].icon = 'edit';
                                                    }else{
                                                        db_events[i].icon = 'diamond';
                                                    }
                                                    var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                                    var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                                    db_events[i].new_time = time11+'-'+time22;
                                                    if(db_events[i].draggable_event == "on"){
                                                        db_events[i].editable = true;
                                                    }else{
                                                        db_events[i].editable = false;
                                                    }
                                                    // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                                                }
                                            }
                                            evt = db_events; 

                                        }
                                    });
                                    return evt;
                                }();
                                if(event_data){
                                    $('#calendar').fullCalendar('removeEvents',event_data._id);
                                    $('#calendar').fullCalendar('renderEvents', event_data, true);
                                } 
                                // setTimeout(function(){ 
                                //                    $.CalendarApp.init()
                                //                 }, 1000);
                                //location.reload();
                            }
                    });

            });
            this.$myModalUpdate.find('.modal-body').find('.update-next-event').unbind('click').click(function () {
                console.log("hello js", $("input[name=update_check_value]:checked").val());
                
                if(calEvent.event_repeat_option_type == "Daily" || calEvent.event_repeat_option_type == "Does not repeat"){
                    $('#draggable_field').show();
                }else{
                    $('#draggable_field').hide();
                }
                var event_id = calEvent.event_id;
                var update_event_id = $("input[name=update_check_value]:checked").val();
                $('#task_priority_div_update').hide();
                if(calEvent.created_type == "task"){
                    $('#task_priority_div_update').show();
                    $this.$updateEventModal.find("select[name='task_priority']").val(calEvent.task_priority);
                    $("#created_type_task_update").prop('checked', true);

                }
                if(calEvent.created_type == "reminder"){
                    $("#created_type_reminder_update").prop('checked', true);
                    $("#add_note_div_update").hide();
                }
                if(calEvent.created_type == "event"){
                    $("#created_type_event_update").prop('checked', true);
                }
                /////// start if 
                    if(update_event_id == 1){
                        var event_new_id = calEvent.event_id;
                        $.ajax({
                            type: "POST",
                            url: base_url+'front/task_data_new',
                            type: 'POST',
                            data: {
                                event_id:event_new_id 
                            }, 
                            success: function(data){
                            var task_start_date = data.task_start_date;
                            var task_end_date = data.task_end_date;
                            ///////   code for hide custom field
                            var i = 1;
                            for(i =1;i<=7;i++){
                                $('#radioupdate'+i).hide();
                            }
                            var datenew1 = new Date(task_start_date);
                            var datenew2 = new Date(task_end_date);
                            var dateArray = new Array();
                            var currentDate = datenew1;
                            while (currentDate <= datenew2) {
                                dateArray.push(new Date (currentDate)); 
                                currentDate = currentDate.addDays(1);
                            }
                            var arrayLength = dateArray.length;
                            for (var i = 0; i < arrayLength; i++) {
                                let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
                                $('#radioupdate'+day_new_value).show();
                            }

                            /////////// end 
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                            // $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                            $("#event_start_date_nnn").datepicker({
                                minDate: task_start_date
                            }).datepicker("setDate", task_start_date);
                            $("#event_end_date_nnn").datepicker({
                                minDate: task_end_date
                            }).datepicker("setDate", task_end_date);
                            $("#event_start_end_date_neww").datepicker({
                                minDate: task_start_date
                            }).datepicker("setDate", task_start_date);

                            let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date).getDay()];
                                let monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ][new Date(task_start_date).getMonth()];
                                var start_day_value = new Date(task_start_date).getDate();
                                $this.$updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                                $this.$updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                                $this.$updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                                var start_update = new Date(task_start_date),
                                end_update   = new Date(task_end_date),
                                diff_update  = new Date(end_update - start_update),
                                days_diff  = diff_update/1000/60/60/24;
                                console.log("days_diff");
                                console.log(days_diff);
                                if(days_diff < 2){
                                    $(".custom_value_update").html("Custom (For enable please select correct date range)");
                                    $('.custom_value_update').prop('disabled', true);
                                }else{
                                    $(".custom_value_update").html("Custom");
                                    $('.custom_value_update').prop('disabled', false);
                                }
                                if(days_diff < 7){
                                    $(".weekday_value_update").html("Weekly on "+weekday+" (For enable please select correct date range)");
                                    $('.weekday_value_update').prop('disabled', true);
                                }else{
                                    $('.weekday_value_update').prop('disabled', false);
                                }
                                if(days_diff < 31){
                                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (For enable please select correct date range)");
                                    $('.monthly_value_update').prop('disabled', true);
                                }else{
                                    $('.monthly_value_update').prop('disabled', false);
                                }
                                if(days_diff < 365){
                                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (For enable please select correct date range)");
                                    $('.yearly_value_update').prop('disabled', true);
                                }else{
                                    $('.yearly_value_update').prop('disabled', false);
                                }
                            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            $('#event_start_end_date_div_update').show();
                            $('#event_start_end_date_select_update').hide();
                                              
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
                            split_string.forEach(myFunction);
                            function myFunction(value, index, array) {
                                $("#radioupdate_"+value).prop('checked', true);
                            }
                            $('.custom-class-update').show();
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }else{
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }
                        // if(calEvent.event_repeat_option_type == 'Custom'){
                        //     $('.custom-class-update').css('display','block');
                        //     var day_cal = new Date(calEvent.event_start_date);
                            
                        // }
                        
                        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
                        $this.$viewEventModal.modal('hide');
                        $this.$updateEventModal.modal('show');
                        
                        $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                        $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEvent.allDay == false){
                                $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                $("#date-time-section1").show();
                                $("#old_reminder_update").show();
                                $("#new_reminder_update").hide();
                            }else{
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                $("#date-time-section1").hide();
                                $("#new_reminder_update").show();
                                $("#old_reminder_update").hide();
                            }
                            $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                            }else{
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                            }
                            $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                        }
                        else
                        {
                            $("#task").addClass("active");
                            $("#task-2").addClass("active");
                        }
                        $('#event_field_hide').show(); 
                        $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                            e.preventDefault(); // Stop page from refreshing
                        var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                       // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                        var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                        var input_dd = ip_sedate.split(' - ');

                        var input_sdate=input_dd[0];
                        var input_edate=input_dd[1];
                        var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                        var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                        var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();
                        var start_update = new Date(input_sdate),
                        end_update   = new Date(input_edate),
                        diff_update  = new Date(end_update - start_update),
                        days_update  = diff_update/1000/60/60/24;
                        if(days_update<= -1){
                            $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                            return false;
                        }

                        if(event_repeat_option_value == "Custom"){
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            // if(days_update<= 7){
                            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                            //     return false;
                            // }
                        }
                        
                        var op_sdate = new Date(input_sdate+' '+input_stime);
                        var op_edate = new Date(input_edate+' '+input_etime);
                        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                            {
                                var formData = new FormData(this);
                                formData.append('delete_check', '1');              
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
                                            var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                            var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                            var dragId = data.drag_id;
                                            var event_id = data.event_id;
                                            var categoryStart = data.start_date;
                                            var categoryEnd = data.end_date;
                                            var type = data.type;
                                            var draggable_id = data.draggable_id;
                                            var allDay = data.allDay;
                                            if(allDay == 'true'){
                                                var allDay = true;
                                            }else{
                                                var allDay = false;
                                            }
                                            if (categoryName !== null && categoryName.length != 0) {
                                                $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                    return (calEvent._id == evnt._id);   
                                                });
                                                $this.$calendarObj.fullCalendar('renderEvent', {
                                                    title: categoryName,
                                                    start: categoryStart,
                                                    event_id: event_id,
                                                    end: categoryEnd,
                                                    allDay: allDay,
                                                    className: categoryColor,
                                                    event_note: data.event_note,
                                                    event_start_date: data.event_start_date,
                                                    event_end_date: data.event_end_date,
                                                    event_start_time: data.event_start_time,
                                                    event_end_time: data.event_end_time,
                                                    event_repeat_option: data.event_repeat_option,
                                                    event_allDay: data.event_allDay,
                                                    event_reminder: data.event_reminder,
                                                    draggable_event: data.draggable_event,
                                                    draggable_id: data.draggable_id,
                                                    drag_id: data.drag_id,
                                                    type: data.type,
                                                }, true);
                                                $this.$calendarObj.fullCalendar('refetchEvents');
                                                if(dragId != 'no_drag_id'){
                                                    if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                        $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                        $this.enableDrag();
                                                    }
                                                }else if(dragId == 'no_drag_id'){       
                                                    if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                        $(".drag-event"+draggable_id).remove();
                                                    }  
                                                }
                                                $this.$updateEventModal.modal('hide');
                                                // setTimeout(function(){ 
                                                //    $.CalendarApp.init()
                                                // }, 1000);
                                                location.reload();
                                                return false;
                                            } 
                                        }                   
                                    },
                                    error: function() {
                                        alert("Something went Wrong...");
                                    }
                                });
                            }else{
                                $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                            }                                 
                        });
                        
                    }else if(update_event_id =="0"){
                        var event_new_id = calEvent.event_id;
                            $.ajax({
                                type: "POST",
                                url: base_url+'front/task_data_single_event',
                                type: 'POST',
                                data: {
                                    event_id:event_new_id 
                                }, 
                                success: function(data){
                                console.log("testtttt");
                                var task_start_date = data.task_start_date;
                                var task_end_date = data.task_end_date;
                                
                                
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                                
                                //$this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                                // $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                                // $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                                $("#event_start_date_nnn").datepicker({
                                    minDate: task_start_date
                                }).datepicker("setDate", task_start_date);
                                $("#event_end_date_nnn").datepicker({
                                    minDate: task_end_date
                                }).datepicker("setDate", task_end_date);
                                $("#event_start_end_date_neww").datepicker({
                                    minDate: task_start_date
                                }).datepicker("setDate", task_start_date);

                                let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date).getDay()];
                                let monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ][new Date(task_start_date).getMonth()];
                                var start_day_value = new Date(task_start_date).getDate();
                                $this.$updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                                $this.$updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                                $this.$updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

                                var start_update = new Date(task_start_date),
                                end_update   = new Date(task_end_date),
                                diff_update  = new Date(end_update - start_update),
                                days_diff  = diff_update/1000/60/60/24;
                                console.log("days_diff");
                                console.log(days_diff);
                                if(days_diff < 2){
                                    $(".custom_value_update").html("Custom (For enable please select correct date range)");
                                    $('.custom_value_update').prop('disabled', true);
                                }else{
                                    $(".custom_value_update").html("Custom");
                                    $('.custom_value_update').prop('disabled', false);
                                }
                                if(days_diff < 7){
                                    $(".weekday_value_update").html("Weekly on "+weekday+" (For enable please select correct date range)");
                                    $('.weekday_value_update').prop('disabled', true);
                                }else{
                                    $('.weekday_value_update').prop('disabled', false);
                                }
                                if(days_diff < 31){
                                    $(".monthly_value_update").html("Monthly on "+start_day_value+" (For enable please select correct date range)");
                                    $('.monthly_value_update').prop('disabled', true);
                                }else{
                                    $('.monthly_value_update').prop('disabled', false);
                                }
                                if(days_diff < 365){
                                    $(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (For enable please select correct date range)");
                                    $('.yearly_value_update').prop('disabled', true);
                                }else{
                                    $('.yearly_value_update').prop('disabled', false);
                                }
                                // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                                }
                            });
                            if(calEvent.event_repeat_option_type == 'Does not repeat'){
                                $('#event_start_end_date_div_update').show();
                                $('#event_start_end_date_select_update').hide();
                            }else if(calEvent.event_repeat_option_type == 'Custom'){
                                const split_string = calEvent.custom_all_day.split(",");
                                split_string.forEach(myFunction);
                                function myFunction(value, index, array) {
                                    $("#radioupdate_"+value).prop('checked', true);
                                }
                                $('.custom-class-update').show();
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }else{
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }
                            $this.$viewEventModal.modal('hide');
                            $this.$updateEventModal.modal('show');
                            $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                            $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                            if(calEvent.type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                                // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                                if(calEvent.allDay == false){
                                    $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                    $("#date-time-section1").show();
                                    $("#old_reminder_update").show();
                                    $("#new_reminder_update").hide();
                                }else{
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                    $("#date-time-section1").hide();
                                    $("#new_reminder_update").show();
                                    $("#old_reminder_update").hide();
                                }
                                $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                                $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                                $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                                if(calEvent.draggable_event == 'on'){
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                }else{
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                }
                                $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                                $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                            }
                            else
                            {
                                $("#task").addClass("active");
                                $("#task-2").addClass("active");
                            }
                            if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                                $('#event_field_hide').show();
                            }else{
                                $('#event_field_hide').hide();
                            }
                            
                            $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                                e.preventDefault(); // Stop page from refreshing
                            var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                            // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                            var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                            var input_dd = ip_sedate.split(' - ');

                            var input_sdate=input_dd[0];
                            var input_edate=input_dd[1];
                            var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                            var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                            var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            if(days_update<= -1){
                                $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                                return false;
                            }

                            if(event_repeat_option_value == "Custom"){
                                var start_update = new Date(input_sdate),
                                end_update   = new Date(input_edate),
                                diff_update  = new Date(end_update - start_update),
                                days_update  = diff_update/1000/60/60/24;
                                // if(days_update<= 7){
                                //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                                //     return false;
                                // }
                            }
                            
                            var op_sdate = new Date(input_sdate+' '+input_stime);
                            var op_edate = new Date(input_edate+' '+input_etime);
                            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                                {
                                    var formData = new FormData(this); 
                                    formData.append('delete_check', '0');             
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
                                                var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                                var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                                var dragId = data.drag_id;
                                                var event_id = data.event_id;
                                                var categoryStart = data.start_date;
                                                var categoryEnd = data.end_date;
                                                var type = data.type;
                                                var draggable_id = data.draggable_id;
                                                var allDay = data.allDay;
                                                if(allDay == 'true'){
                                                    var allDay = true;
                                                }else{
                                                    var allDay = false;
                                                }
                                                if (categoryName !== null && categoryName.length != 0) {
                                                    $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                    $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                        return (calEvent._id == evnt._id);   
                                                    });
                                                    $this.$calendarObj.fullCalendar('renderEvent', {
                                                        title: categoryName,
                                                        start: categoryStart,
                                                        event_id: event_id,
                                                        end: categoryEnd,
                                                        allDay: allDay,
                                                        className: categoryColor,
                                                        event_note: data.event_note,
                                                        event_start_date: data.event_start_date,
                                                        event_end_date: data.event_end_date,
                                                        event_start_time: data.event_start_time,
                                                        event_end_time: data.event_end_time,
                                                        event_repeat_option: data.event_repeat_option,
                                                        event_allDay: data.event_allDay,
                                                        event_reminder: data.event_reminder,
                                                        draggable_event: data.draggable_event,
                                                        draggable_id: data.draggable_id,
                                                        drag_id: data.drag_id,
                                                        type: data.type,
                                                    }, true);
                                                    $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            $this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    $this.$updateEventModal.modal('hide');
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
                                                    location.reload();
                                                    return false;
                                                } 
                                            }                   
                                        },
                                        error: function() {
                                            alert("Something went Wrong...");
                                        }
                                    });
                                }else{
                                    $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                                }                                 
                            });
                    }else if(update_event_id =="2"){
                        var event_new_id = calEvent.event_id;
                        $.ajax({
                            type: "POST",
                            url: base_url+'front/task_data_following_event',
                            type: 'POST',
                            data: {
                                event_id:event_new_id 
                            }, 
                            success: function(data){
                            var task_start_date = data.task_start_date;
                            var task_end_date = data.task_end_date;
                            
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                            // $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                            $("#event_start_date_nnn").datepicker({
                                minDate: task_start_date
                            }).datepicker("setDate", task_start_date);
                            $("#event_end_date_nnn").datepicker({
                                minDate: task_end_date
                            }).datepicker("setDate", task_end_date);
                            $("#event_start_end_date_neww").datepicker({
                                minDate: task_start_date
                            }).datepicker("setDate", task_start_date);
                            
                            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            $('#event_start_end_date_div_update').show();
                            $('#event_start_end_date_select_update').hide();                    
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
                            split_string.forEach(myFunction);
                            function myFunction(value, index, array) {
                                $("#radioupdate_"+value).prop('checked', true);
                            }
                            $('.custom-class-update').show();
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }else{
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }
                        $this.$viewEventModal.modal('hide');
                        $this.$updateEventModal.modal('show');
                        $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                        $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEvent.allDay == false){
                                $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                $("#date-time-section1").show();
                                $("#old_reminder_update").show();
                                $("#new_reminder_update").hide();
                            }else{
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                $("#date-time-section1").hide();
                                $("#new_reminder_update").show();
                                $("#old_reminder_update").hide();
                            }
                            $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                            }else{
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                            }
                            $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                        }
                        else
                        {
                            $("#task").addClass("active");
                            $("#task-2").addClass("active");
                        } 
                        if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                            $('#event_field_hide').show();
                        }else{
                            $('#event_field_hide').hide();
                        }
                        $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                            e.preventDefault(); // Stop page from refreshing
                        var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                        // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                        var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                        var input_dd = ip_sedate.split(' - ');

                        var input_sdate=input_dd[0];
                        var input_edate=input_dd[1];
                        var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                        var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                        var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();
                        var start_update = new Date(input_sdate),
                        end_update   = new Date(input_edate),
                        diff_update  = new Date(end_update - start_update),
                        days_update  = diff_update/1000/60/60/24;
                        if(days_update<= -1){
                            $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select correct date range');
                            return false;
                        }

                        if(event_repeat_option_value == "Custom"){
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            // if(days_update<= 7){
                            //     $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                            //     return false;
                            // }
                        }
                        
                        var op_sdate = new Date(input_sdate+' '+input_stime);
                        var op_edate = new Date(input_edate+' '+input_etime);
                        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                            {
                                var formData = new FormData(this);
                                formData.append('delete_check', '2');             
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
                                            var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                            var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                            var dragId = data.drag_id;
                                            var event_id = data.event_id;
                                            var categoryStart = data.start_date;
                                            var categoryEnd = data.end_date;
                                            var type = data.type;
                                            var draggable_id = data.draggable_id;
                                            var allDay = data.allDay;
                                            if(allDay == 'true'){
                                                var allDay = true;
                                            }else{
                                                var allDay = false;
                                            }
                                            if (categoryName !== null && categoryName.length != 0) {
                                                $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                    return (calEvent._id == evnt._id);   
                                                });
                                                $this.$calendarObj.fullCalendar('renderEvent', {
                                                    title: categoryName,
                                                    start: categoryStart,
                                                    event_id: event_id,
                                                    end: categoryEnd,
                                                    allDay: allDay,
                                                    className: categoryColor,
                                                    event_note: data.event_note,
                                                    event_start_date: data.event_start_date,
                                                    event_end_date: data.event_end_date,
                                                    event_start_time: data.event_start_time,
                                                    event_end_time: data.event_end_time,
                                                    event_repeat_option: data.event_repeat_option,
                                                    event_allDay: data.event_allDay,
                                                    event_reminder: data.event_reminder,
                                                    draggable_event: data.draggable_event,
                                                    draggable_id: data.draggable_id,
                                                    drag_id: data.drag_id,
                                                    type: data.type,
                                                }, true);
                                                $this.$calendarObj.fullCalendar('refetchEvents');
                                                if(dragId != 'no_drag_id'){
                                                    if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                        $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                        $this.enableDrag();
                                                    }
                                                }else if(dragId == 'no_drag_id'){       
                                                    if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                        $(".drag-event"+draggable_id).remove();
                                                    }  
                                                }
                                                $this.$updateEventModal.modal('hide');
                                                // setTimeout(function(){ 
                                                //    $.CalendarApp.init()
                                                // }, 1000);
                                                location.reload();
                                                return false;
                                            } 
                                        }                   
                                    },
                                    error: function() {
                                        alert("Something went Wrong...");
                                    }
                                });
                            }else{
                                $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                            }                                 
                        });
                    }
                /////////   end if

            });
            $this.$viewEventModal.find('.modal-header').find('.edit-event').unbind('click').click(function () {
                $('#update_event_two').show();
                $('#update_event_three').show();
                $('#update_type_edit').html("Update recurring "+calEvent.created_type);
                if(calEvent.array_count == 1){
                    $('#update_event_two').hide();
                    $("#myModalUpdate").modal();
                    
                }else{
                 
                    if(calEvent.event_repeat_option_type == 'Does not repeat' || calEvent.event_repeat_option_type == 'Daily'){
                        $('#update_event_two').hide();
                        $("#myModalUpdate").modal();
                        
                    }else{
                        console.log("calEvent.isLastCount");
                        console.log(calEvent.isLastCount);
                        if(calEvent.isLastCount == 1){
                            $('#update_event_three').hide();
                            $("#myModalUpdate").modal();
                        }else{
                            $("#myModalUpdate").modal();
                        }
                    }  
                }
                return false;
                swal("Are you sure to update event?", {
                    icon: 'warning',
                    buttons: {
                      cancel: "Cancel",
                      catch: {
                        text: "Update only this",
                        value: "catch",
                      },
                      following: {
                        text: "Update this and following",
                        value: "following",

                      },
                      delete: {
                        text: "Update all",
                        value: "update_all",

                      },
                      //delete: true,
                      
                    },
                  })
                  .then((value) => {
                    switch (value) {
                   
                      case "update_all":
                        var event_new_id = calEvent.event_id;
                        $.ajax({
                            type: "POST",
                            url: base_url+'front/task_data_new',
                            type: 'POST',
                            data: {
                                event_id:event_new_id 
                            }, 
                            success: function(data){
                            var task_start_date = data.task_start_date;
                            var task_end_date = data.task_end_date;
                            $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                            $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                            $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);
                            // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                            }
                        });
                        if(calEvent.event_repeat_option_type == 'Does not repeat'){
                            $('#event_start_end_date_div_update').show();
                            $('#event_start_end_date_select_update').hide();                    
                        }else if(calEvent.event_repeat_option_type == 'Custom'){
                            const split_string = calEvent.custom_all_day.split(",");
                            split_string.forEach(myFunction);
                            function myFunction(value, index, array) {
                                $("#radioupdate_"+value).prop('checked', true);
                            }
                            $('.custom-class-update').show();
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }else{
                            $('#event_start_end_date_div_update').hide();
                            $('#event_start_end_date_select_update').show();
                        }
                        // if(calEvent.event_repeat_option_type == 'Custom'){
                        //     $('.custom-class-update').css('display','block');
                        //     var day_cal = new Date(calEvent.event_start_date);
                            
                        // }
                        
                        // $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date);                
                        $this.$viewEventModal.modal('hide');
                        $this.$updateEventModal.modal('show');
                        
                        $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                        $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                        if(calEvent.type == 'event')
                        {
                            $("#event").addClass("active");
                            $("#event-1").addClass("active");
                            $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                            // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                            // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                            if(calEvent.allDay == false){
                                $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                $("#date-time-section1").show();
                                $("#old_reminder_update").show();
                                $("#new_reminder_update").hide();
                            }else{
                                $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                $("#date-time-section1").hide();
                                $("#new_reminder_update").show();
                                $("#old_reminder_update").hide();
                            }
                            $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                            $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                            $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                            if(calEvent.draggable_event == 'on'){
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                            }else{
                                $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                            }
                            $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                            $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                        }
                        else
                        {
                            $("#task").addClass("active");
                            $("#task-2").addClass("active");
                        } 
                        $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                            e.preventDefault(); // Stop page from refreshing
                        var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                       // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                        var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                        var input_dd = ip_sedate.split(' - ');

                        var input_sdate=input_dd[0];
                        var input_edate=input_dd[1];
                        var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                        var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                        var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();

                        if(event_repeat_option_value == "Custom"){
                            var start_update = new Date(input_sdate),
                            end_update   = new Date(input_edate),
                            diff_update  = new Date(end_update - start_update),
                            days_update  = diff_update/1000/60/60/24;
                            if(days_update<= 7){
                                $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                                return false;
                            }
                        }
                        
                        var op_sdate = new Date(input_sdate+' '+input_stime);
                        var op_edate = new Date(input_edate+' '+input_etime);
                        if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                            {
                                var formData = new FormData(this);
                                formData.append('delete_check', '1');              
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
                                            var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                            var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                            var dragId = data.drag_id;
                                            var event_id = data.event_id;
                                            var categoryStart = data.start_date;
                                            var categoryEnd = data.end_date;
                                            var type = data.type;
                                            var draggable_id = data.draggable_id;
                                            var allDay = data.allDay;
                                            if(allDay == 'true'){
                                                var allDay = true;
                                            }else{
                                                var allDay = false;
                                            }
                                            if (categoryName !== null && categoryName.length != 0) {
                                                $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                    return (calEvent._id == evnt._id);   
                                                });
                                                $this.$calendarObj.fullCalendar('renderEvent', {
                                                    title: categoryName,
                                                    start: categoryStart,
                                                    event_id: event_id,
                                                    end: categoryEnd,
                                                    allDay: allDay,
                                                    className: categoryColor,
                                                    event_note: data.event_note,
                                                    event_start_date: data.event_start_date,
                                                    event_end_date: data.event_end_date,
                                                    event_start_time: data.event_start_time,
                                                    event_end_time: data.event_end_time,
                                                    event_repeat_option: data.event_repeat_option,
                                                    event_allDay: data.event_allDay,
                                                    event_reminder: data.event_reminder,
                                                    draggable_event: data.draggable_event,
                                                    draggable_id: data.draggable_id,
                                                    drag_id: data.drag_id,
                                                    type: data.type,
                                                }, true);
                                                $this.$calendarObj.fullCalendar('refetchEvents');
                                                if(dragId != 'no_drag_id'){
                                                    if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                        $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                        $this.enableDrag();
                                                    }
                                                }else if(dragId == 'no_drag_id'){       
                                                    if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                        $(".drag-event"+draggable_id).remove();
                                                    }  
                                                }
                                                $this.$updateEventModal.modal('hide');
                                                // setTimeout(function(){ 
                                                //    $.CalendarApp.init()
                                                // }, 1000);
                                                location.reload();
                                                return false;
                                            } 
                                        }                   
                                    },
                                    error: function() {
                                        alert("Something went Wrong...");
                                    }
                                });
                            }else{
                                $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                            }                                 
                        });
                        
                        break;
                   
                      case "catch":
                        
                            var event_new_id = calEvent.event_id;
                            $.ajax({
                                type: "POST",
                                url: base_url+'front/task_data_single_event',
                                type: 'POST',
                                data: {
                                    event_id:event_new_id 
                                }, 
                                success: function(data){
                                var task_start_date = data.task_start_date;
                                var task_end_date = data.task_end_date;
                                $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                                
                                $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                                $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);

                                let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(task_start_date).getDay()];
                                let monthNames = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                                ][new Date(task_start_date).getMonth()];
                                var start_day_value = new Date(task_start_date).getDate();
                                $this.$updateEventModal.find("#weekday_value").html("Weekly on "+weekday);
                                $this.$updateEventModal.find("#monthly_value").html("Monthly on "+start_day_value);
                                $this.$updateEventModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);
                                // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                                }
                            });
                            if(calEvent.event_repeat_option_type == 'Does not repeat'){
                                $('#event_start_end_date_div_update').show();
                                $('#event_start_end_date_select_update').hide();                    
                            }else if(calEvent.event_repeat_option_type == 'Custom'){
                                const split_string = calEvent.custom_all_day.split(",");
                                split_string.forEach(myFunction);
                                function myFunction(value, index, array) {
                                    $("#radioupdate_"+value).prop('checked', true);
                                }
                                $('.custom-class-update').show();
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }else{
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }
                            $this.$viewEventModal.modal('hide');
                            $this.$updateEventModal.modal('show');
                            $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                            $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                            if(calEvent.type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                                // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                                if(calEvent.allDay == false){
                                    $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                    $("#date-time-section1").show();
                                    $("#old_reminder_update").show();
                                    $("#new_reminder_update").hide();
                                }else{
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                    $("#date-time-section1").hide();
                                    $("#new_reminder_update").show();
                                    $("#old_reminder_update").hide();
                                }
                                $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                                $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                                $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                                if(calEvent.draggable_event == 'on'){
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                }else{
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                }
                                $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                                $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                            }
                            else
                            {
                                $("#task").addClass("active");
                                $("#task-2").addClass("active");
                            } 
                            $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                                e.preventDefault(); // Stop page from refreshing
                            var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                            // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                            var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                            var input_dd = ip_sedate.split(' - ');

                            var input_sdate=input_dd[0];
                            var input_edate=input_dd[1];
                            var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                            var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                            var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();

                            if(event_repeat_option_value == "Custom"){
                                var start_update = new Date(input_sdate),
                                end_update   = new Date(input_edate),
                                diff_update  = new Date(end_update - start_update),
                                days_update  = diff_update/1000/60/60/24;
                                if(days_update<= 7){
                                    $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                                    return false;
                                }
                            }
                            
                            var op_sdate = new Date(input_sdate+' '+input_stime);
                            var op_edate = new Date(input_edate+' '+input_etime);
                            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                                {
                                    var formData = new FormData(this); 
                                    formData.append('delete_check', '0');             
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
                                                var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                                var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                                var dragId = data.drag_id;
                                                var event_id = data.event_id;
                                                var categoryStart = data.start_date;
                                                var categoryEnd = data.end_date;
                                                var type = data.type;
                                                var draggable_id = data.draggable_id;
                                                var allDay = data.allDay;
                                                if(allDay == 'true'){
                                                    var allDay = true;
                                                }else{
                                                    var allDay = false;
                                                }
                                                if (categoryName !== null && categoryName.length != 0) {
                                                    $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                    $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                        return (calEvent._id == evnt._id);   
                                                    });
                                                    $this.$calendarObj.fullCalendar('renderEvent', {
                                                        title: categoryName,
                                                        start: categoryStart,
                                                        event_id: event_id,
                                                        end: categoryEnd,
                                                        allDay: allDay,
                                                        className: categoryColor,
                                                        event_note: data.event_note,
                                                        event_start_date: data.event_start_date,
                                                        event_end_date: data.event_end_date,
                                                        event_start_time: data.event_start_time,
                                                        event_end_time: data.event_end_time,
                                                        event_repeat_option: data.event_repeat_option,
                                                        event_allDay: data.event_allDay,
                                                        event_reminder: data.event_reminder,
                                                        draggable_event: data.draggable_event,
                                                        draggable_id: data.draggable_id,
                                                        drag_id: data.drag_id,
                                                        type: data.type,
                                                    }, true);
                                                    $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            $this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    $this.$updateEventModal.modal('hide');
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
                                                    location.reload();
                                                    return false;
                                                } 
                                            }                   
                                        },
                                        error: function() {
                                            alert("Something went Wrong...");
                                        }
                                    });
                                }else{
                                    $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                                }                                 
                            });
                            
                        break;
                        case "following":
                        
                            var event_new_id = calEvent.event_id;
                            $.ajax({
                                type: "POST",
                                url: base_url+'front/task_data_following_event',
                                type: 'POST',
                                data: {
                                    event_id:event_new_id 
                                }, 
                                success: function(data){
                                var task_start_date = data.task_start_date;
                                var task_end_date = data.task_end_date;
                                $this.$updateEventModal.find("input[name=event_start_end_date_new]").val(task_start_date); 
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(task_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(task_end_date);
                                $this.$updateEventModal.find("input[name=event_start_date_nn]").val(task_start_date);
                                $this.$updateEventModal.find("input[name=event_end_date_nn]").val(task_end_date);
                                
                                // $this.$viewEventModal.find('.modal-body1').empty().prepend(data).end();
                                }
                            });
                            if(calEvent.event_repeat_option_type == 'Does not repeat'){
                                $('#event_start_end_date_div_update').show();
                                $('#event_start_end_date_select_update').hide();                    
                            }else if(calEvent.event_repeat_option_type == 'Custom'){
                                const split_string = calEvent.custom_all_day.split(",");
                                split_string.forEach(myFunction);
                                function myFunction(value, index, array) {
                                    $("#radioupdate_"+value).prop('checked', true);
                                }
                                $('.custom-class-update').show();
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }else{
                                $('#event_start_end_date_div_update').hide();
                                $('#event_start_end_date_select_update').show();
                            }
                            $this.$viewEventModal.modal('hide');
                            $this.$updateEventModal.modal('show');
                            $this.$updateEventModal.find("input[name=event_name]").val(calEvent.title); 
                            $this.$updateEventModal.find("select[name='event_color']").val(calEvent.className[0]);                 
                            if(calEvent.type == 'event')
                            {
                                $("#event").addClass("active");
                                $("#event-1").addClass("active");
                                $this.$updateEventModal.find("textarea[name=event_note]").val(calEvent.event_note);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setStartDate(calEvent.event_start_date);
                                // $this.$updateEventModal.find("input[name=event_start_end_date]").data('daterangepicker').setEndDate(calEvent.event_end_date);

                                // $this.$updateEventModal.find("input[name=event_start_end_date]").val(calEvent.event_start_date+ ' - ' +calEvent.event_end_date);
                                if(calEvent.allDay == false){
                                    $this.$updateEventModal.find("select[name=event_start_time]").val(moment(calEvent.event_start_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_start_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("select[name=event_end_time]").val(moment(calEvent.event_end_time, "HH:mm").format('hh:mm A'));
                                    $this.$updateEventModal.find("select[name=event_end_time]").select2().trigger('change');
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', false);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('true');
                                    $("#date-time-section1").show();
                                    $("#old_reminder_update").show();
                                    $("#new_reminder_update").hide();
                                }else{
                                    $this.$updateEventModal.find("input[name=event_allDay]").prop('checked', true);
                                    $this.$updateEventModal.find("input[name='checkbox_value_get_update']").val('false');
                                    $("#date-time-section1").hide();
                                    $("#new_reminder_update").show();
                                    $("#old_reminder_update").hide();
                                }
                                $this.$updateEventModal.find("select[name='event_repeat_option']").val(calEvent.event_repeat_option_type); 
                                $this.$updateEventModal.find("select[name='event_reminder']").val(calEvent.event_reminder);
                                $this.$updateEventModal.find("select[name='event_reminder_new']").val(calEvent.event_reminder); 
                                if(calEvent.draggable_event == 'on'){
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', true);
                                }else{
                                    $this.$updateEventModal.find("input[name=draggable_event]").prop('checked', false);
                                }
                                $this.$updateEventModal.find("input[name=event_id]").val(calEvent.event_id);
                                $this.$updateEventModal.find("input[name=draggable_id]").val(calEvent.draggable_id);
                            }
                            else
                            {
                                $("#task").addClass("active");
                                $("#task-2").addClass("active");
                            } 
                            $this.$updateEventModal.find('.update-category').unbind('submit').on('submit', function (e) {    
                                e.preventDefault(); // Stop page from refreshing
                            var input_allday = $this.$updateEventModal.find("input[name=event_allDay]");
                            // var ip_sedate=$this.$updateEventModal.find("input[name=event_start_end_date]").val();
                            var ip_sedate=$this.$updateEventModal.find("input[name=event_start_date_nn]").val()+' - '+$this.$updateEventModal.find("input[name=event_end_date_nn]").val();
                            var input_dd = ip_sedate.split(' - ');

                            var input_sdate=input_dd[0];
                            var input_edate=input_dd[1];
                            var input_stime=$this.$updateEventModal.find("select[name=event_start_time]").val();
                            var input_etime=$this.$updateEventModal.find("select[name=event_end_time]").val();
                            var event_repeat_option_value=$this.$updateEventModal.find("#event_repeat_option").val();

                            if(event_repeat_option_value == "Custom"){
                                var start_update = new Date(input_sdate),
                                end_update   = new Date(input_edate),
                                diff_update  = new Date(end_update - start_update),
                                days_update  = diff_update/1000/60/60/24;
                                if(days_update<= 7){
                                    $this.$updateEventModal.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                                    return false;
                                }
                            }
                            
                            var op_sdate = new Date(input_sdate+' '+input_stime);
                            var op_edate = new Date(input_edate+' '+input_etime);
                            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
                                {
                                    var formData = new FormData(this);
                                    formData.append('delete_check', '2');             
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
                                                var categoryName = $this.$updatecategoryForm.find("input[name='event_name']").val(); 
                                                var categoryColor = $this.$updatecategoryForm.find("select[name='event_color']").val();
                                                var dragId = data.drag_id;
                                                var event_id = data.event_id;
                                                var categoryStart = data.start_date;
                                                var categoryEnd = data.end_date;
                                                var type = data.type;
                                                var draggable_id = data.draggable_id;
                                                var allDay = data.allDay;
                                                if(allDay == 'true'){
                                                    var allDay = true;
                                                }else{
                                                    var allDay = false;
                                                }
                                                if (categoryName !== null && categoryName.length != 0) {
                                                    $this.$updateEventModal.find('#event_end_timeErr').html('');
                                                    $this.$calendarObj.fullCalendar('removeEvents', function (evnt) {
                                                        return (calEvent._id == evnt._id);   
                                                    });
                                                    $this.$calendarObj.fullCalendar('renderEvent', {
                                                        title: categoryName,
                                                        start: categoryStart,
                                                        event_id: event_id,
                                                        end: categoryEnd,
                                                        allDay: allDay,
                                                        className: categoryColor,
                                                        event_note: data.event_note,
                                                        event_start_date: data.event_start_date,
                                                        event_end_date: data.event_end_date,
                                                        event_start_time: data.event_start_time,
                                                        event_end_time: data.event_end_time,
                                                        event_repeat_option: data.event_repeat_option,
                                                        event_allDay: data.event_allDay,
                                                        event_reminder: data.event_reminder,
                                                        draggable_event: data.draggable_event,
                                                        draggable_id: data.draggable_id,
                                                        drag_id: data.drag_id,
                                                        type: data.type,
                                                    }, true);
                                                    $this.$calendarObj.fullCalendar('refetchEvents');
                                                    if(dragId != 'no_drag_id'){
                                                        if(!$('.external-event').hasClass('drag-event'+dragId)){
                                                            $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event'+dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                                            $this.enableDrag();
                                                        }
                                                    }else if(dragId == 'no_drag_id'){       
                                                        if($('.external-event').hasClass('drag-event'+draggable_id)){
                                                            $(".drag-event"+draggable_id).remove();
                                                        }  
                                                    }
                                                    $this.$updateEventModal.modal('hide');
                                                    // setTimeout(function(){ 
                                                    //    $.CalendarApp.init()
                                                    // }, 1000);
                                                    location.reload();
                                                    return false;
                                                } 
                                            }                   
                                        },
                                        error: function() {
                                            alert("Something went Wrong...");
                                        }
                                    });
                                }else{
                                    $this.$updateEventModal.find('#event_end_timeErr').html('End Time should be greater than Start time');
                                }                                 
                            });
                            
                        break;
                    }
                  });
                  return false;
            });

    },
    
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        $('#cus_radioBTN').hide();
        $('#custom_value').prop('disabled', false);
        $('#weekday_value').prop('disabled', false);
        $('#monthly_value').prop('disabled', false);
        $('#yearly_value').prop('disabled', false);

        var $this = this;
        $this.$categoryModal.modal({
            backdrop: 'static'
        }); 

        var startd = $.fullCalendar.formatDate(start, "Y-MM-DD");
        var ended = $.fullCalendar.formatDate(end.subtract(1, 'days'), "Y-MM-DD");
        let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd).getDay()];
        let monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ][new Date(startd).getMonth()];
        var start_day_value = $.fullCalendar.formatDate(start, "DD");
        $this.$categoryModal.find("#weekday_value").html("Weekly on "+weekday);
        $this.$categoryModal.find("#monthly_value").html("Monthly on "+start_day_value);
        $this.$categoryModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);
        ///////////  Validation
        var start_update = new Date(start),
        end_update   = new Date(end),
        diff_update  = new Date(end_update - start_update),
        days_diff  = diff_update/1000/60/60/24;
        console.log("days_updateww");
        console.log(days_diff);
        if(days_diff < 2){
            $this.$categoryModal.find("#custom_value").html("Custom (For enable please select correct date range)");
            $('#custom_value').prop('disabled', true);
        }
        if(days_diff < 7){
            $this.$categoryModal.find("#weekday_value").html("Weekly on "+weekday+" (For enable please select correct date range)");
            $('#weekday_value').prop('disabled', true);
        }
        if(days_diff < 31){
            $this.$categoryModal.find("#monthly_value").html("Monthly on "+start_day_value+" (For enable please select correct date range)");
            $('#monthly_value').prop('disabled', true);
        }
        if(days_diff < 365){
            $this.$categoryModal.find("#yearly_value").html("Annually on "+start_day_value+" "+monthNames+" (For enable please select correct date range)");
            $('#yearly_value').prop('disabled', true);
        }
        /////////// end validation

        //$this.$categoryModal.find("input[name=event_start_date_nn]").val(startd);
        //$this.$categoryModal.find("input[name=event_end_date_nn]").val(ended);
        //$this.$categoryModal.find("input[name=event_start_end_date_new]").val(startd);
        $("#event_start_date_nn").datepicker({
            minDate: startd
          }).datepicker("setDate", startd);
        $("#event_end_date_nn").datepicker({
            minDate: ended
        }).datepicker("setDate", ended);
        $("#event_start_end_date_new").datepicker({
            minDate: startd
        }).datepicker("setDate", startd);

        
        if(startd === ended){
            $('#event_start_end_date_div').show();
            $('#event_start_end_date_select').hide();
            $this.$categoryModal.find("select[name='event_repeat_option']").val('Does not repeat');
        }else{
            $('#event_start_end_date_select').show();
            $('#event_start_end_date_div').hide();
            $this.$categoryModal.find("select[name='event_repeat_option']").val('Daily');
        }
        

        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm");
        //var minutesToAdd=15;
        var currentDate = new Date(start);
       // var end = new Date(currentDate.getTime() + minutesToAdd*60000);
        var start = moment(currentDate).format("hh:mm A"); 
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm");; 
        var end = moment(end).format("hh:mm A"); 
        if(start == '12:00 AM'){
            var start = '11:00 AM';
            var end = '12:00 PM';
        }

        $this.$categoryModal.find("select[name=event_start_time]").val(start);
        $this.$categoryModal.find("select[name=event_start_time]").select2().trigger('change');
        $this.$categoryModal.find("select[name=event_end_time]").val(end);
        $this.$categoryModal.find("select[name=event_end_time]").select2().trigger('change');

        $this.$categoryModal.find('.close-category').unbind('click').click(function () {
            $(".create-category").trigger("reset");
        });
        $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {     
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
    /* Initializing */
    CalendarApp.prototype.init = function() {   
        this.enableDrag();         /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());
        var month_year = today;
        var abc = 1;
        var event_data = function () {
            var evt = null;
            $.ajax({
                method: "POST",
                async: false,
                data: {
                    month_year:month_year,
                },
                url: base_url+'front/get_calendar_events',            
                success: function(data){
                    console.log(data);                 

                    var db_events = data;
                    function renameKey(obj, old_key, new_key) {   
                        // check if old key = new key  
                        if (old_key !== new_key) {                  
                            Object.defineProperty(obj, new_key, // modify old key
                            // fetch description from object
                            Object.getOwnPropertyDescriptor(obj, old_key));
                            delete obj[old_key]; // delete old key
                        }
                    }
                    //$(".fc-title").html("yuvam");
                    db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                    db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                    db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                    var lim = db_events.length;
                    for (var i = 0; i < lim; i++)
                    {                        
                        if(db_events[i].type == 'event'){
                            if(db_events[i].event_allDay == 'true')
                            {
                                db_events[i].allDay = true;
                            }else{
                                db_events[i].allDay = false;
                            }                           

                            db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                            db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                            var icon_val = db_events[i].created_type;
                            if(icon_val == "reminder"){
                                db_events[i].icon = 'bell';
                            }else if(icon_val == "task"){
                                db_events[i].icon = 'edit';
                            }else{
                                db_events[i].icon = 'diamond';
                            }

                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                            db_events[i].new_time = time11+'-'+time22;
                            if(db_events[i].draggable_event == "on"){
                                db_events[i].editable = true;
                            }else{
                                db_events[i].editable = false;
                            }
                            
                        }else{
                            if(db_events[i].task_allDay == 'true')
                            {
                                db_events[i].allDay = true;
                            }else{
                                db_events[i].allDay = false;
                            }
                            db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                            var icon_val = db_events[i].created_type;
                            if(icon_val == "reminder"){
                                db_events[i].icon = 'bell';
                            }else if(icon_val == "task"){
                                db_events[i].icon = 'edit';
                            }else{
                                db_events[i].icon = 'diamond';
                            }
                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                            db_events[i].new_time = time11+'-'+time22;
                            if(db_events[i].draggable_event == "on"){
                                db_events[i].editable = true;
                            }else{
                                db_events[i].editable = false;
                            }
                        }
                    }
                    evt = db_events; 
                }
            });
            return evt;
        }();
        
        

        var defaultEvents =  event_data;

        // var getDaysBetweenDates = function(startDate, endDate, holiday) {
        //     var now = startDate.clone(), dates = [];
        //     while (now.isSameOrBefore(endDate)) {

        //         var now_hol = now.format('Y/MM/DD');
        //             console.log(now_hol);
        //             // console.log(holiday);
        //         if(holiday){
        //             dates.push(now.format('Y/MM/DD'));
        //         now.add(1, 'days');
        //         }
        //     }
        //     if(holiday == now_hol[18]){
        //         dates.push(now.format('Y/MM/DD'));
        //         now.add(1, 'days');
        //     }
        //     return dates;
        // };
        // var startDate = moment(defaultEvents[0].event_start_date);
        // var endDate = moment(defaultEvents[0].event_end_date);
        // var holiday = '2022/04/19';
        // var dateList = getDaysBetweenDates(startDate, endDate, holiday);
        // console.log(dateList);

            
            //         var d1 = new Date("2022-04-01");
            //         var d2 = new Date("2022-04-30");

            // function calcBusinessDays(dDate1, dDate2) {
            //     if (dDate1 > dDate2) return false;
            //     var date  = dDate1;
            //     var dates = [];

            //     while (date < dDate2) {
            //         if (date.getDay() === 0 || date.getDay() === 6) dates.push(new Date(date));
            //         date.setDate( date.getDate() + 1 );
            //     }
                
            //     return dates;
            // }
            // console.log(calcBusinessDays(d1, d2));
            


        // function getNextWorkDays(count, format) {
        //     if (!count) { count = 8; }
        //     if (!format) { format = 'Y/MM/DD'; }
        
        //     var days = [];
        //     var d = moment().startOf(defaultEvents[0].event_start_date);

        //     var d = moment().holiday('christmas')
        //     var i =0;
        //     for (i = 0; i < count; i++) {
        //       d.add(1, 'day');
          
        //       if (d.day() === 0 || d.day() === 6|| d ===holiday ) {
        //         count++;
        //         continue;
        //       }
            
        //       days.push(moment(d).format(format));
        //     }
          
        //   return days;
        // }
        
        // var days = getNextWorkDays();
        
        // alert("The following days are available for pickup:\n\n" + days.join("\n"));

        var $this = this;
        // console.log(this);

        // Any value representing daily repeat flag
        var REPEAT_DAILY = 'Daily';
        // Any value representing weekly repeat flag
        var REPEAT_WEEKLY = 'Weekly';
        // Any value represanting monthly repeat flag
        var REPEAT_MONTHLY = 'Monthly';
        // Any value represanting yearly repeat flag
        var REPEAT_YEARLY = 'Annually';

        var calendar_url = $(location).attr('href'),
        url_parts = calendar_url.split("/"),
        agenda_view = url_parts[url_parts.length-1];



        if(agenda_view == 'myday'){
            var agenda_view = 'agendaDay';
        }else if(agenda_view == 'myweek'){
            var agenda_view = 'agendaWeek';
        }else if(agenda_view == 'mylist'){
            var agenda_view = 'list';
        }else{
            var agenda_view = 'month';
        }

       
        

        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '01:00:00',
            maxTime: '24:30:00',
            defaultView: agenda_view,  
            handleWindowResize: true,   
            allDayText: 'All day',
            default: true,
            // weekends:false,
            // hiddenDays: [ 2,4],

            // dayRender: function(date,jsEvent, view) {

            //             var day = date.day(); // number 0-6 with Sunday as 0 and Saturday as 6
            //             if (day == 0){
            //             // $(cell).addClass('disabled');
            //             $('.fc-sun').addClass('disabled');
            //                     }
            //             //  console.log(day)
            //             },
             header: {
             left: 'Prev,Next,today',
             center: 'title',
             right: 'month,agendaWeek,agendaDay,list'
             },
             
             customButtons: {
                Prev: {
                    text: '<',
                    click: function () {
                        var view = $('#calendar').fullCalendar('getView');
                        var tglCurrent = $('#calendar').fullCalendar('getDate');
                        var date = new Date(tglCurrent);
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = date.getFullYear();
                        var form = '';
                        var today = y+'-'+m;
                        var month_year = view.title;
                        var event_data = function () {
                            var evt = null;
                            $.ajax({
                                method: "POST",
                                async: false,
                                data: {
                                    month_year:month_year, button:'prev',
                                },
                                url: base_url+'front/get_allcalendar_events',            
                                success: function(data){
                                    console.log("gfgg");
                                    console.log(data);
                                    var db_events = data; 
                                    function renameKey(obj, old_key, new_key) {   
                                        // check if old key = new key  
                                        if (old_key !== new_key) {                  
                                            Object.defineProperty(obj, new_key, // modify old key
                                            // fetch description from object
                                            Object.getOwnPropertyDescriptor(obj, old_key));
                                            delete obj[old_key]; // delete old key
                                        }
                                    }
                                    db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                    db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                                    db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                                    var lim = db_events.length;
                                    for (var i = 0; i < lim; i++)
                                    {                        
                                        if(db_events[i].type == 'event'){
                                            if(db_events[i].event_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                            db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'edit';
                                            }else{
                                                db_events[i].icon = 'diamond';
                                            }
                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                        }else{
                                            if(db_events[i].task_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'edit';
                                            }else{
                                                db_events[i].icon = 'diamond';
                                            }
                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                                        }
                                    }
                                    evt = db_events; 

                                }
                            });
                            return evt;
                        }();
                        if(event_data){
                            $('#calendar').fullCalendar('removeEvents',event_data._id);
                            $('#calendar').fullCalendar('renderEvents', event_data, true);
                        }
                        $('#calendar').fullCalendar('prev');
                    }
                },
                Next: {
                    text: '>',
                    click: function () {
                        var view = $('#calendar').fullCalendar('getView');
                        var tglCurrent = $('#calendar').fullCalendar('getDate');
                        var date = new Date(tglCurrent);
                        var d = date.getDate();
                        var m = date.getMonth()+2;
                        var y = date.getFullYear();
                        var form = '';
                        // console.log(d);
                        // console.log(m);
                        // console.log(y);


                        if(m=='13')
                        {          
                        var year = y+1;                              
                        var today = year+'-'+'1';
                        }
                        else
                        {
                        var today =y+'-'+m;
                        }
                        var month_year = view.title;
                        var event_data = function () {
                            var evt = null;
                            $.ajax({
                                method: "POST",
                                async: false,
                                data: {
                                    month_year:month_year, button:'next',
                                },
                                url: base_url+'front/get_allcalendar_events',            
                                success: function(data){
                                    console.log("qwqwqw");
                                    var db_events = data; 
                                    function renameKey(obj, old_key, new_key) {   
                                        // check if old key = new key  
                                        if (old_key !== new_key) {                  
                                            Object.defineProperty(obj, new_key, // modify old key
                                            // fetch description from object
                                            Object.getOwnPropertyDescriptor(obj, old_key));
                                            delete obj[old_key]; // delete old key
                                        }
                                    }
                                    db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                                    db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                                    db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                                    var lim = db_events.length;
                                    for (var i = 0; i < lim; i++)
                                    {                        
                                        if(db_events[i].type == 'event'){
                                            if(db_events[i].event_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                            db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'edit';
                                            }else{
                                                db_events[i].icon = 'diamond';
                                            }
                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                        }else{
                                            if(db_events[i].task_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                            var icon_val = db_events[i].created_type;
                                            if(icon_val == "reminder"){
                                                db_events[i].icon = 'bell';
                                            }else if(icon_val == "task"){
                                                db_events[i].icon = 'edit';
                                            }else{
                                                db_events[i].icon = 'diamond';
                                            }
                                            var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                            var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                            db_events[i].new_time = time11+'-'+time22;
                                            if(db_events[i].draggable_event == "on"){
                                                db_events[i].editable = true;
                                            }else{
                                                db_events[i].editable = false;
                                            }
                                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                                        }
                                    }
                                    evt = db_events; 

                                }
                            });
                            return evt;
                        }();
                        if(event_data){
                            $('#calendar').fullCalendar('removeEvents',event_data._id);
                            $('#calendar').fullCalendar('renderEvents', event_data, true);
                        }
                        $('#calendar').fullCalendar('next');
                    }
                },
            },
            events: defaultEvents,
            eventRender: function(event, element) {
                if(event.icon){          
                  // element.find(".fc-time").prepend("<i class='fa fa-"+event.icon+"'></i>");
                    element.find(".fc-time").html("<i class='fa fa-"+event.icon+"'></i> "+event.new_time);
                }
            },
            // timeFormat: 'hh:mm A', // uppercase H for 24-hour clock
            editable: false,
            // editable: (draggable_event == "on") ? true:false,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: 3, // allow "more" link when too many events
            selectable: true,
            eventDrop: function (event, delta) {    
                console.log("fd");      
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                if(event.end == null && event.allDay == false){
                   var minutesToAdd=15;
                    var currentDate = new Date($.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss"));
                    var end = new Date(currentDate.getTime() + minutesToAdd*60000);
                    var end = moment(end).format("Y-MM-DD HH:mm:ss"); 
                }else if(event.end == null && event.allDay == true){
                   var end = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                }else{
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                }
                
                var allDay = event.allDay;
                var title = event.title;
                var event_id = event.event_id;
                $.ajax({                        
                    type: "POST",
                    url: base_url+'front/update_event',
                    data: {
                       event_name:title, event_color:event.className[0], start_date:start, end_date:end, event_id:event_id, allDay:allDay
                    },
                    success: function (response) {                        
                        event.event_start_date = response.event_start_date;
                        event.event_end_date = response.event_end_date;
                        event.event_start_time = response.event_start_time;
                        event.event_end_time = response.event_end_time;
                        event.event_allDay = response.event_allDay;
                        event.end = end;
                        $this.$calendarObj.fullCalendar('updateEvent', event);
                        $this.$calendarObj.fullCalendar('refetchEvents');
                        // setTimeout(function(){ 
                        //    $.CalendarApp.init()
                        // }, 1000);
                    }
                });
            },
            eventResize:function(event)
            {
             var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
             var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
             var title = event.title;
             var event_id = event.event_id;
             var allDay = event.allDay;
             $.ajax({
              type:"POST",
              url: base_url+'front/update_event',
                    data: {
                       event_name:title, event_color:event.className[0], start_date:start, end_date:end, event_id:event_id, allDay:allDay 
                    },
              success:function(response){
                event.event_start_date = response.event_start_date;
                event.event_end_date = response.event_end_date;
                event.event_start_time = response.event_start_time;
                event.event_end_time = response.event_end_time;
                event.event_allDay = response.event_allDay;
                event.end = end;
                $this.$calendarObj.fullCalendar('updateEvent', event);
                $this.$calendarObj.fullCalendar('refetchEvents');
                // setTimeout(function(){ 
                //    $.CalendarApp.init()
                // }, 1000);
              }
             })
            },
            drop: function(date, jsEvent, ui, resourceId) { $this.onDrop($(this), date, jsEvent, ui, resourceId); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });

        

        $(".fc-today-button").click(function(e) {//load event on today button.
            e.preventDefault();
            console.log("select today");
            var view = $('#calendar').fullCalendar('getView');
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());
            var month_year = view.title;
            var event_data = function () {
                var evt = null;
                $.ajax({
                    method: "POST",
                    async: false,
                    data: {
                        month_year:month_year, button:'today',
                    },
                    url: base_url+'front/get_allcalendar_events',            
                    success: function(data){
                        console.log("testt");
                        var db_events = data; 
                        function renameKey(obj, old_key, new_key) {   
                            // check if old key = new key  
                            if (old_key !== new_key) {                  
                                Object.defineProperty(obj, new_key, // modify old key
                                // fetch description from object
                                Object.getOwnPropertyDescriptor(obj, old_key));
                                delete obj[old_key]; // delete old key
                            }
                        }
                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                        db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                        var lim = db_events.length;
                        for (var i = 0; i < lim; i++)
                        {                        
                            if(db_events[i].type == 'event'){
                                if(db_events[i].event_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#calendar').fullCalendar('removeEvents',event_data._id);
                $('#calendar').fullCalendar('renderEvents', event_data, true);
            }             
        });

        $(".fc-month-button").click(function(e) {//load event on today button.
            e.preventDefault();
            var view = $('#calendar').fullCalendar('getView');
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());
            var month_year = view.title;
            var event_data = function () {
                var evt = null;
                $.ajax({
                    method: "POST",
                    async: false,
                    data: {
                        month_year:month_year, button:'month',
                    },
                    url: base_url+'front/get_allcalendar_events',            
                    success: function(data){
                        console.log("ssss");
                        var db_events = data; 
                        function renameKey(obj, old_key, new_key) {   
                            // check if old key = new key  
                            if (old_key !== new_key) {                  
                                Object.defineProperty(obj, new_key, // modify old key
                                // fetch description from object
                                Object.getOwnPropertyDescriptor(obj, old_key));
                                delete obj[old_key]; // delete old key
                            }
                        }
                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                        db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));

                        var lim = db_events.length;
                        for (var i = 0; i < lim; i++)
                        {                        
                            if(db_events[i].type == 'event'){
                                if(db_events[i].event_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#calendar').fullCalendar('removeEvents',event_data._id);
                $('#calendar').fullCalendar('renderEvents', event_data, true);
            }            
        });

        $(".fc-agendaWeek-button").click(function(e) {//load event on today button.
            e.preventDefault();
            console.log("lllllllllllllllllllllllllll");
            var view = $('#calendar').fullCalendar('getView');
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());
            var month_year = view.title;
            var event_data = function () {
                var evt = null;
                $.ajax({
                    method: "POST",
                    async: false,
                    data: {
                        month_year:month_year, button:'week',
                    },
                    url: base_url+'front/get_allcalendar_events',            
                    success: function(data){
                        console.log("wwwwwwwwww");
                        var db_events = data; 
                        function renameKey(obj, old_key, new_key) {   
                            // check if old key = new key  
                            if (old_key !== new_key) {                  
                                Object.defineProperty(obj, new_key, // modify old key
                                // fetch description from object
                                Object.getOwnPropertyDescriptor(obj, old_key));
                                delete obj[old_key]; // delete old key
                            }
                        }
                        db_events.forEach(obj => renameKey(obj, 'event_name', 'title'));
                        db_events.forEach(obj => renameKey(obj, 'event_color', 'className'));
                        db_events.forEach(obj => renameKey(obj, 'id', 'event_id'));
                        var lim = db_events.length;
                        for (var i = 0; i < lim; i++)
                        {                        
                            if(db_events[i].type == 'event'){
                                if(db_events[i].event_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;
                                db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                var icon_val = db_events[i].created_type;
                                if(icon_val == "reminder"){
                                    db_events[i].icon = 'bell';
                                }else if(icon_val == "task"){
                                    db_events[i].icon = 'edit';
                                }else{
                                    db_events[i].icon = 'diamond';
                                }
                                var time11 = moment(db_events[i].event_start_time, 'HH:mm').format('hh:mm A');
                                var time22 = moment(db_events[i].event_end_time, 'HH:mm').format('hh:mm A');
                                db_events[i].new_time = time11+'-'+time22;
                                if(db_events[i].draggable_event == "on"){
                                    db_events[i].editable = true;
                                }else{
                                    db_events[i].editable = false;
                                }
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#calendar').fullCalendar('removeEvents',event_data._id);
                $('#calendar').fullCalendar('renderEvents', event_data, true);
            }            
        });


        $this.$categoryModal.find('.create-category').unbind('submit').on('submit', function (e){         
            e.preventDefault(); // Stop page from refreshing
            var input_allday = $this.$categoryForm.find("input[name=event_allDay]");
            // var ip_sedate=$this.$categoryForm.find("input[name=event_start_end_date]").val();
            var ip_sedate=$this.$categoryForm.find("input[name=event_start_date_nn]").val()+' - '+$this.$categoryForm.find("input[name=event_end_date_nn]").val();
           // var event_repeat_option_value=$this.$categoryForm.find("input[name=event_repeat_option]").val();
           console.log("ip_sedate");
           console.log(ip_sedate);
            var event_repeat_option_value=$this.$categoryForm.find("#event_repeat_option").val();
            var input_dd = ip_sedate.split(' - ');

            var input_sdate=input_dd[0];
            var input_edate=input_dd[1];
            console.log("input_sdate");
            console.log(input_sdate);
            console.log("input_edate");
            console.log(input_edate);
            var start = new Date(input_sdate),
            end   = new Date(input_edate),
            diff  = new Date(end - start),
            days  = diff/1000/60/60/24;
            if(days<= -1){
                $this.$categoryForm.find('#event_start_end_dateErr').html('Please select correct date range');
                return false;
            }
            if(event_repeat_option_value == "Custom"){
                var start = new Date(input_sdate),
                end   = new Date(input_edate),
                diff  = new Date(end - start),
                days  = diff/1000/60/60/24;
                // if(days<= 7){
                //     $this.$categoryForm.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                //     return false;
                // }
            }
            var input_stime=$this.$categoryForm.find("select[name=event_start_time]").val();
            var input_etime=$this.$categoryForm.find("select[name=event_end_time]").val();

            var op_sdate = new Date(input_sdate+' '+input_stime);
            var op_edate = new Date(input_edate+' '+input_etime);
            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
            {
                var formData = new FormData(this);             
                $.ajax({
                    url: base_url+'front/insert_draggable_event',
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
                            window.location.href = base_url+"calendar";exit;
                            var categoryName = $this.$categoryForm.find("input[name='event_name']").val(); 
                            var categoryColor = $this.$categoryForm.find("select[name='event_color']").val();
                            var type = data.type;
                            if(type == 'event'){
                                var dragId = data.drag_id;
                                var event_id = data.event_id;
                                var categoryStart = data.start_date;
                                var categoryEnd = data.end_date;
                                var allDay = data.allDay;
                                if(allDay == 'true'){
                                    var allDay = true;
                                }else{
                                    var allDay = false;
                                }                                
                                if (categoryName !== null && categoryName.length != 0) {
                                    $this.$categoryForm.find('#event_end_timeErr').html('');
                                        $this.$calendarObj.fullCalendar('renderEvent', {
                                            title: categoryName,
                                            start: categoryStart,
                                            event_id: event_id,
                                            end: categoryEnd,
                                            allDay: allDay,
                                            className: categoryColor,
                                            event_note: data.event_note,
                                            event_start_date: data.event_start_date,
                                            event_end_date: data.event_end_date,
                                            event_start_time: data.event_start_time,
                                            event_end_time: data.event_end_time,
                                            event_repeat_option: data.event_repeat_option,
                                            event_allDay: data.event_allDay,
                                            event_reminder: data.event_reminder,
                                            draggable_event: data.draggable_event,
                                            draggable_id: data.draggable_id,
                                            drag_id: data.drag_id,
                                            type: data.type,
                                        }, true); 
                                        $(".create-category").trigger("reset");
                                    if(dragId != 'no_drag_id'){
                                        $this.$extEvents.append('<div id="' + dragId + '" class="m-10 external-event drag-event' + dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>')
                                    $this.enableDrag();
                                    }
                                    $this.$categoryModal.modal('hide');
                                    // setTimeout(function(){ 
                                    //    $.CalendarApp.init()
                                    // }, 1000);
                                    return false;
                                }
                            }else{
                                var event_id = data.event_id;
                                var categoryStart = data.start_date;
                                var allDay = data.allDay;
                                if(allDay == 'true'){
                                    var allDay = true;
                                }else{
                                    var allDay = false;
                                } 
                                if (categoryName !== null && categoryName.length != 0) {
                                    $this.$categoryForm.find('#event_end_timeErr').html('');
                                        $this.$calendarObj.fullCalendar('renderEvent', {
                                            title: categoryName,
                                            start: categoryStart,
                                            event_id: event_id,
                                            allDay: allDay,
                                            className: categoryColor,
                                            task_note: data.task_note,
                                            task_start_date: data.task_start_date,
                                            task_start_time: data.task_start_time,
                                            task_repeat_option: data.task_repeat_option,
                                            task_allDay: data.task_allDay,
                                            task_reminder: data.task_reminder,
                                            type: data.type,
                                        }, true); 
                                        $(".create-category").trigger("reset");
                                    $this.$categoryModal.modal('hide');
                                    // setTimeout(function(){ 
                                    //    $.CalendarApp.init()
                                    // }, 1000);
                                    return false;
                                }
                            }
                        }                   
                    }
                }); 
            }else{
                $this.$categoryForm.find('#event_end_timeErr').html('End Time should be greater than Start time');
            }          

        });

        //on update drag event
        $this.$dragEventModal.find('.edit-dragevent').unbind('submit').on('submit', function (e){
            e.preventDefault(); // Stop page from refreshing
            var input_allday = $this.$dragEventForm.find("input[name=event_allDay]");
            var input_stime=$this.$dragEventForm.find("select[name=event_start_time]").val();
            var input_etime=$this.$dragEventForm.find("select[name=event_end_time]").val();
            var op_sdate = new Date('2021-05-05 '+input_stime);
            var op_edate = new Date('2021-05-05 '+input_etime);

            var ip_sedate_update=$this.$categoryForm.find("input[name=event_start_end_date]").val();
           // var event_repeat_option_value=$this.$categoryForm.find("input[name=event_repeat_option]").val();
            var event_repeat_option_value=$this.$categoryForm.find("#event_repeat_option").val();
            var input_dd_update = ip_sedate_update.split(' - ');

            var input_sdate_update=input_dd_update[0];
            var input_edate_update=input_dd_update[1];
            console.log("input_edate_update");
            console.log(input_edate_update);
            // var start_update = new Date(input_sdate_update),
            // end_update   = new Date(input_edate_update),
            // diff_update  = new Date(end_update - start_update),
            // days_update  = diff_update/1000/60/60/24;
            // console.log("days_update");
            // console.log(days_update);
            // if(days_update<= -1){
            //     $this.$dragEventForm.find('#event_start_end_dateErr').html('Please select correct date range');
            //     return false;
            // }
            if(event_repeat_option_value == "Custom"){
                var start_update = new Date(input_sdate_update),
                end_update   = new Date(input_edate_update),
                diff_update  = new Date(end_update - start_update),
                days_update  = diff_update/1000/60/60/24;
                console.log("days_update");
                console.log(days_update);
                // if(days_update<= 7){
                //     $this.$dragEventForm.find('#event_start_end_dateErr').html('Please select at least 7 days ');
                //     return false;
                // }
            }
            // console.log("event_repeat_option_value");
            // console.log(event_repeat_option_value);
            // return false;
            
            if((!input_allday.is(":checked") && op_sdate < op_edate) || (input_allday.is(":checked")))
            {
                var formData = new FormData(this);             
                $.ajax({
                    url: base_url+'front/update_drag_event',
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
                            $this.$dragEventForm.find('#event_end_timeErr').html('');
                            var categoryName = $this.$dragEventForm.find("input[name='event_name']").val(); 
                            var categoryColor = $this.$dragEventForm.find("select[name='event_color']").val();
                            var dragId = data.drag_id;
                            $(".edit-dragevent").trigger("reset");
                            $("div.drag-event"+dragId).replaceWith('<div id="' + dragId + '" class="m-10 external-event drag-event' + dragId + ' ' + categoryColor + '" data-class="' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '<i onclick="return removeDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-times"></i><i onclick="return editModalDragEvent(' + dragId + ');" style="cursor: pointer;" class="pull-right fa fa-pencil"></i></div>');
                            $this.enableDrag();
                            $this.$dragEventModal.modal('hide');
                            // setTimeout(function(){ 
                            //    $.CalendarApp.init()
                            // }, 1000);
                        }                   
                    }
                }); 
            }else{
                $this.$dragEventForm.find('#event_end_timeErr').html('End Time should be greater than Start time');
            }          

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),// End of use strict

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
    

    
}(window.jQuery);// End of use strict


