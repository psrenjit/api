$(document).ready(function() {
    
    var count=0;
    var pName="";
    $('#pdiv').hide();
    var pN = '';
    $(document).on('click', '.searchBtn', function() {
        pN = $('#cfcnumber').val();
       
        selectNumers(pN);
    });
    $(document).on('click', '.pnameBtn', function() {
        var pName=$('#pname').val();
        var slNo=$('#slNumber').val();
        var mobileNo=$('#mNumber').val();
        updateNumbers(slNo,mobileNo,pName,pN);
        $('#pdiv').hide();
        selectNumers(pN);
    });
    $(document).on('click', '.bttapr', function (event) {
        event.preventDefault();
        pName=$('#pname').val();
        var favorite = [];
        $.each($("input[name='signcheck']:checked"), function() {
            favorite.push($(this).val());
        });
        alert("You are selected : " + favorite.join(", "));        
        updateNumbers(favorite.join(","), pName,pN);  
        $('#pdiv').hide();            
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
        url: 'cfc-collected-person.php',
        data: {
            number: abc,
        },
        success: function(response) {
            $("#row1").html(response);
            
        }
    });
}

function updateNumbers(slNo,pName,pN) {
    $.ajax({
        type: "POST",
        url: 'cfc-collected-person-update.php',
        data: {
            sno: slNo,
            Pname:pName,
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