//[advanced form element Javascript]


$(function () {
    "use strict";

    //Date range picker
    $('#reservation').daterangepicker({
     locale: {
        format: 'YYYY-MM-DD'
      },
    });
    $('#reservation1').daterangepicker({
     locale: {
        format: 'YYYY-MM-DD'
      },
    });
    $('#reservation3').daterangepicker({
     locale: {
        format: 'YYYY-MM-DD'
      },
    });

    //Date picker
    $('#datepicker').datepicker({
      setDate: '2021-05-05',
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    //Date picker
    $('#datepicker1').datepicker({
      startDate: new Date(),
      setDate: '2021-05-05',
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    //Date picker
    $('#datepicker2').datepicker({
      startDate: new Date(),
      setDate: '2021-05-05',
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    //Date picker
    $('#datepicker3').datepicker({
      startDate: new Date(),
      setDate: '2021-05-05',
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    //Timepicker
    $('.timepicker').timepicker({
      format: 'HH:mm:ss',
      minTime: '11:45:00',
      showInputs: false
    });

    //Timepicker
    $('.timepicker1').timepicker({
      format: 'HH:mm:ss',
      minTime: '11:45:00',
      showInputs: false
    });

    //Initialize Select2 Elements
    $('.select2').select2();
	
  });