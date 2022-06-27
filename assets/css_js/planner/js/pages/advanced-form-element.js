//[advanced form element Javascript]
$(function () {
    "use strict";
    //Initialize Select2 Elements
    $('.select2').select2();

    //Date picker
    $('.create_start_date').datepicker({
      startDate: new Date(),
      setDate: '05/05/2021',
      todayHighlight: true,
      format: 'mm/dd/yyyy',
      autoclose: true
    });

    //Date picker
    $('.edit_start_date').datepicker({
      setDate: '05/05/2021',
      todayHighlight: true,
      format: 'mm/dd/yyyy',
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

  });