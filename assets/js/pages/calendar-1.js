//[calendar Javascript]
var base_url = 'http://91.demoserver.co.in/';
!function($) {
    "use strict";

    var CalendarApp1 = function() {
        this.$body = $("body")
        this.$calendar1 = $('#calendar1'),
        this.$calendarObj1 = null
    };
    /* Initializing */
    CalendarApp1.prototype.init = function() {   
        // debugger;          /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());

        var $this = this;
        $this.$calendarObj1 = $this.$calendar1.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '01:00:00',
            maxTime: '24:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            // events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: 1, // allow "more" link when too many events
            selectable: true,            
            select: function (start, end, allDay) {
                debugger;
                var url_path = (window.location.pathname).split("/");
                var last_path = (url_path[url_path.length-1]);
                if(last_path != 'calendar'){
                    window.location = base_url+'calendar';
                }                
            },
        });
    },

   //init CalendarApp1
    $.CalendarApp1 = new CalendarApp1, $.CalendarApp1.Constructor = CalendarApp1
    
}(window.jQuery),// End of use strict

//initializing CalendarApp1
function($) {
    "use strict";
    $.CalendarApp1.init()
    
}(window.jQuery);// End of use strict