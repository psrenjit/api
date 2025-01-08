$(document).ready(function() {
    $('.bttapr').hide();
    var pN = "";
    $(document).on('click', '.searchBtn', function() {
        pN = $('#cfcnumber').val();
        $('.bttapr').show();
        selectNumbers(pN);
    });
    $(document).on('click', '.bttapr', function() {
        var ch = 0;
        var favorite = [];
        $.each($("input[name='signcheck']:checked"), function() {
            favorite.push($(this).val());
            ch = 1;
        });
        if (ch == 1) {

            if (confirm("You are updating the follwing serial numbers" + favorite.join(", "))) {
                $('.bttapr').hide();
                $('.searchBtn').hide();
                updateNumbers(favorite.join(","), pN);
                $('.searchBtn').show();
            }
        } else {
            alert("nothing selected");
        }
    });
});

function selectNumbers(abc) {
    $.ajax({
        type: "POST",
        url: 'signed-request.php',
        data: {
            number: abc,
        },
        success: function(response) {
            $("#row1").html(response);
        }
    });
}

function updateNumbers(slNo, Pn) {
    $.ajax({
        type: "POST",
        url: 'signed-update-request.php',
        data: {
            sno: slNo,
            pn: Pn,
        },
        success: function(response) {
            $("#row1").html(response);
            selectNumbers(Pn)
            mailToStation(slNo);
        }
    });
}

function mailToStation(slNo) {
    var crimeNo = "";
    var mobNo = "";
    var station = "";
    var email = "";
    $.ajax({
        type: "POST",
        url: '../formaildata.php',
        data: {
            slno: slNo,
        },
        success: function(response) {
            $.each(response, function(index, value) {
                crimeNo = value.crimeNo;
                mobNo += value.mobNo + ", ";
                station = value.station;
                email = value.email;
            });
            mailed(crimeNo, mobNo, station, email);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('Error sending data.');
        }
    });
}

function mailed(crimeNo, mobNo, station, email) {
    $.ajax({
        type: "POST",
        url: '../mail-to-station/mail-to-station.php',
        data: {
            sub: "Request for the certified copy",
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