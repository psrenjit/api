$(document).ready(function() {
    var pName="";
    $('.bttapr').hide();
    $(document).on('click', '.searchBtn', function() {
        pN = $('#cfcnumber').val();
        if(pN==''){
            return;
        }
        selectNumbers(pN);
        $('.bttapr').show();
    });
    
    $(document).on('click', '.bttapr', function (event) {
        event.preventDefault();
        pName=$('#pname').val();
        var favorite = [];
        $.each($("input[name='signcheck']:checked"), function() {
            favorite.push($(this).val());
        });
        alert("My favourite sports are: " + favorite.join(", "));        
        updateNumbers(favorite.join(","), pN);              
    });
});
function selectNumbers(abc) {
    $.ajax({
        type: "POST",
        url: 'cfc-collected.php',
        data: {
            number: abc,
        },
        success: function(response) {
            $("#row1").html(response);
        }
    });
}

function updateNumbers(slNo,pN) {
    $.ajax({
        type: "POST",
        url: 'cfc-collected-update.php',
        data: {
            sno: slNo,
        },
        success: function(response) {
            $("#row1").html(response);
            selectNumbers(pN);
            mailToStation(slNo);
        }
    });
}
function mailToStation(slNo){
   
    var crimeNo="";
    var mobNo="";
    var station="";
    var email="";
    $.ajax({
        type: "POST",
        url: '../formaildata.php',
        data: {
            slno:slNo,
        },
        success: function(response) {
            $.each(response, function(index, value) {
                crimeNo=value.crimeNo;
                mobNo+=value.mobNo+", ";
                station=value.station;
                email=value.email;
            });
            mailed(crimeNo,mobNo,station,email);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('Error sending data.');
        }
    });
    
}

function mailed(crimeNo,mobNo,station,email){
    $.ajax({
        type: "POST",
        url: '../mail-to-station/mail-to-station.php',
        data: {
            sub:"Certifieied copy ",
            crNo: crimeNo,
            mNo: mobNo,
            st: station,
            emailId: email,
        },
        success: function(response) {
            $("#row1").html(response);
           
        }
    });
}