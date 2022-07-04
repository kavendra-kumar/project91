//[calendar Javascript]

// var base_url = 'http://91.demoserver.co.in/';
var base_url = 'http://localhost/project91/';
// var base_url = 'https://project91.isynbus.com/';



!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#admin-calendar'),
        // this.$event = ('#external-events div.external-event'),
        // this.$categoryForm = $('#add-new-events form'),
        // this.$dragEventForm = $('#edit-drag-event form'),
        // this.$updatecategoryForm = $('#update-event form'),
        // this.$extEvents = $('#external-events'),
        // this.$categoryModal = $('#add-new-events'),
        // this.$dragEventModal = $('#edit-drag-event'),
        // this.$viewEventModal = $('#view-event'),
        // this.$updateEventModal = $('#update-event'),
        this.$calendarObj = null
    };

   
     
   
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
        var event_data = function () {
            var evt = null;
            $.ajax({
                method: "POST",
                async: false,
                data: {
                    month_year:month_year,
                },
                url: base_url+'superadmin/get_calendar_subjects',            
                success: function(data){
                    console.log(data);                 

                    var db_events = data;
                    // console.log(db_events);
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
                    
                    console.log(lim);
                    for (var i = 0; i < lim; i++)
                    {                        
                        if(db_events[i].type == 'event'){
                            if(db_events[i].event_allDay == 'true')
                            {
                                db_events[i].allDay = true;
                            }else{
                                db_events[i].allDay = false;
                            }                           

                            // db_events[i].start = db_events[i].event_start_date+' '+db_events[i].event_start_time;

                            db_events[i].start = db_events[i].event_start_date;

                            db_events[i].end = db_events[i].event_end_date;

                            // console.log(db_events[i].start);
                            // console.log(db_events[i].end);
                        }else{
                            if(db_events[i].task_allDay == 'true')
                            {
                                db_events[i].allDay = true;
                            }else{
                                db_events[i].allDay = false;
                            }
                            // db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                            db_events[i].start = db_events[i].task_start_date;
                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                        }
                    }
                    evt = db_events; 

                }
            });
            return evt;
        }();
        
        

        var defaultEvents =  event_data;

        var $this = this;
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
             header: {
             left: 'Prev,Next,today',
             center: 'title',
             right: 'month,agendaWeek,agendaDay,list'
             },
             
             customButtons: {
                Prev: {
                    text: '<',
                    click: function () {
                        var view = $('#admin-calendar').fullCalendar('getView');
                        var tglCurrent = $('#admin-calendar').fullCalendar('getDate');
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
                                        }else{
                                            if(db_events[i].task_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                                        }
                                    }
                                    evt = db_events; 

                                }
                            });
                            return evt;
                        }();
                        if(event_data){
                            $('#admin-calendar').fullCalendar('removeEvents',event_data._id);
                            $('#admin-calendar').fullCalendar('renderEvents', event_data, true);
                        }
                        $('#admin-calendar').fullCalendar('prev');
                    }
                },
                Next: {
                    text: '>',
                    click: function () {
                        var view = $('#admin-calendar').fullCalendar('getView');
                        var tglCurrent = $('#admin-calendar').fullCalendar('getDate');
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
                                        }else{
                                            if(db_events[i].task_allDay == 'true')
                                            {
                                                db_events[i].allDay = true;
                                            }else{
                                                db_events[i].allDay = false;
                                            }
                                            db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                            // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                                        }
                                    }
                                    evt = db_events; 

                                }
                            });
                            return evt;
                        }();
                        if(event_data){
                            $('#admin-calendar').fullCalendar('removeEvents',event_data._id);
                            $('#admin-calendar').fullCalendar('renderEvents', event_data, true);
                        }
                        $('#admin-calendar').fullCalendar('next');
                    }
                },
            },
            events: defaultEvents,
            
            // timeFormat: 'hh:mm A', // uppercase H for 24-hour clock
            editable: false,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: 3, // allow "more" link when too many events
            selectable: true,
            eventDrop: function (event, delta) {          
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
            var view = $('#admin-calendar').fullCalendar('getView');
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
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#admin-calendar').fullCalendar('removeEvents',event_data._id);
                $('#admin-calendar').fullCalendar('renderEvents', event_data, true);
            }             
        });

        $(".fc-month-button").click(function(e) {//load event on today button.
            e.preventDefault();
            var view = $('#admin-calendar').fullCalendar('getView');
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
                                // db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#admin-calendar').fullCalendar('removeEvents',event_data._id);
                $('#admin-calendar').fullCalendar('renderEvents', event_data, true);
            }            
        });

        $(".fc-agendaWeek-button").click(function(e) {//load event on today button.
            e.preventDefault();
            var view = $('#admin-calendar').fullCalendar('getView');
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
                                // db_events[i].end = db_events[i].event_end_date+' '+db_events[i].event_end_time;
                            }else{
                                if(db_events[i].task_allDay == 'true')
                                {
                                    db_events[i].allDay = true;
                                }else{
                                    db_events[i].allDay = false;
                                }
                                db_events[i].start = db_events[i].task_start_date+' '+db_events[i].task_start_time;
                                // db_events[i].end = db_events[i].task_start_date+' '+db_events[i].event_end_time;
                            }
                        }
                        evt = db_events; 

                    }
                });
                return evt;
            }();
            if(event_data){
                $('#admin-calendar').fullCalendar('removeEvents',event_data._id);
                $('#admin-calendar').fullCalendar('renderEvents', event_data, true);
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


