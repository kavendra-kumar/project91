//[Javascript]
$(function () {
    "use strict";   
		$('#slimtest1').slimScroll({
            height: '300px'
        });
        $('#slimtest2').slimScroll({
            height: '300px'
        });
        $('#slimtest3').slimScroll({
            position: 'left'
            , height: '300px'
            , railVisible: true
            , alwaysVisible: true
        });
        $('#slimtest4').slimScroll({
            color: '#0bb2d4'
            , size: '10px'
            , height: '300px'
            , alwaysVisible: true
        });
        $('#task_comment_scroll').slimScroll({
            height: '200px',
            start: 'bottom'
        });
        if($('#external-events').height() > 200)
        {
            $('#external-events').slimScroll({
                height: '200px'
            });
        }
        if($(window).width() > 2200)
        {
           $('#slimtest5').slimScroll({
                height: '720px'
            });
        }
        else 
        {
           $('#slimtest5').slimScroll({
                height: '550px'
            });
        }
        $('.slimtest5').slimScroll({
            height: '300px'
        });
	
  }); // End of use strict