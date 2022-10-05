jQuery(document).ready(function ($) {
    $("#pay_type").on("change",function () {
       var type=$(this).val();
       if (type === "third"){
           $("#online_pay").prop("disabled",true);
       }else
       {
           $("#online_pay").prop("disabled",false);
       }
    });
});