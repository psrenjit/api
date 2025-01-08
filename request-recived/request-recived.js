$(document).ready(function() {
    var count=0;
    $('#pdiv').hide();
    var pN = '';
    $(document).on('click', '.searchBtn', function() {
        pN = $('#cfcnumber').val();
        
        selectNumers(pN);
    });
    $(document).on('click', '.pnameBtn', function() {
        var pName=$('#pname').val();
        var slNo=$('#slNumber').val();        
        updateNumbers(slNo,pName);
        selectNumers(pN);
    });
    $('input[name="signcheck"]').mousedown(function() {
        if (!$(this).is(':checked')) {
            this.checked = confirm("Are you sure?");            
        }
    });   
    $(document).on('click', '.bttapr', function () {
        var pName=$('#pname').val();
        var favorite = [];
        $.each($("input[name='signcheck']:checked"), function() {
            favorite.push($(this).val());
        });
        alert("My favourite sports are: " + favorite.join(", "));        
        updateNumbers(favorite.join(","), pName,pN);              
    });

    $(document).on('change', '.chk', function() {
        if(this.checked) {
            count=count+1;
            $('#pdiv').show();
        }
        else{
            count=count-1;
            if(count==0){
                $('#pdiv').hide();
            }
        }
    });
});
function selectNumers(abc) {
    $.ajax({
        type: "POST",
        url: 'request-recived.php',
        data: {
            number: abc,
        },
        success: function(response) {
            $("#row1").html(response);
        }
    });
}

function updateNumbers(slNos,pNames,pN){
    $.ajax({
        type: "POST",
        url: 'request-recived-update.php',
        data: {
            sno: slNos,
            pn:pNames,
        },
        success: function(response) {
            $("#row1").html(response);
            selectNumers(pN);
            //mailToStation(slNo,mobileNo,pN,reqStation,station,cnNo);
        }
    });
}
function mailToStation(slNo,mobileNo,pN,reqStation,station,cnNo){

}