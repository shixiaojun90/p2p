$(function(){

     var width = $(document).width()-12;
     $(".main").css('width',width+'px');
    
    $("#minus").click(function(){
	    var mine=parseInt($("#minjine").val());
        var cnum = parseInt($("#tnum").val());
        cnum=(cnum-mine)>0?(cnum-mine):mine;
        $("#tnum").val(cnum);
    })
    
    $("#plus").click(function(){
	  var mine=parseInt($("#minjine").val());
        var cnum = parseInt($("#tnum").val());
        cnum+=mine;
        $("#tnum").val(cnum);
    })
    $("#tnum").blur(function(){
        var num = $(this).val().replace(/[^0-9]/ig, "");
        var cnum = parseInt(num); 
        if(cnum < 1 || !cnum){
           cnum = 1;
        }
        $("#tnum").val(cnum);
    })
})



