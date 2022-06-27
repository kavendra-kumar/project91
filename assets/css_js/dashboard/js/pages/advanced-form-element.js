//[advanced form element Javascript]
$(function () {
    "use strict";
    $('#reservation1').daterangepicker({
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
    $('.exam_date_class').datepicker({
      startDate: new Date(),
      setDate: '05/05/2021',
      todayHighlight: true,
      format: 'mm/dd/yyyy',
      autoclose: true
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    $('.timepicker').timepicker({
      showInputs: false
    });
    
  });