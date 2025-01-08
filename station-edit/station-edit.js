$(document).ready(function() {
    selectNumbers();

    let be=selectNumbers1();
    console.log(be);
    var pName="";
    $('.bttapr').hide();
    $(document).on('click', '.searchBtn', function() {
        pN = $('#cfcnumber').val();
        if(pN==''){
            return;
        }
        
        $('.bttapr').show();
    });

    $(document).on('change', '.selectchange', function(event) {
        var value = $(this).find(":selected").val();
        var re = be.user.length;
        for (i=0;i<=re;i++) {
            var t = be.user[i].stationId;
            if (t == value) {
                $('#stName').val(be.user[i].stationId);
                $('#stEmail').val(be.user[i].emailId);
                break;
            }
            
            //$userList.append('<option value=' + t + '>' + te + '</option>');
        }
    });
    
    $(document).on('click', '#btnUpdate', function (event) {
        event.preventDefault();
        var stId=$('#stName').val();       
        var stEmail=$('#stEmail').val();    
        updateNumbers(stId, stEmail);              
    });
});
function selectNumbers() {
    $.ajax({
        type: "POST",
        url: 'station-edit.php',
        dataType: 'json',
        success: function(response) {
            const $userList = $('#st');
            var re = response.user.length;
            while (re--) {
                var t = response.user[re].stationId;
                var te = response.user[re].stationName;
                $userList.append('<option value=' + t + '>' + te + '</option>');
            }
        }
    });
}


function selectNumbers1() {
    var beer = $.ajax({
        type: "POST",
        url: 'station-edit.php',
        async: false,
        dataType: 'json'
    }).responseJSON;
    return beer;    
}



function updateNumbers(stId, stEmail) {
    $.ajax({
        type: "POST",
        url: 'station-edit-update.php',
        data: {
            sId: stId,
            sEmail:stEmail,
        },
        success: function(response) {
            location.reload();
            
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