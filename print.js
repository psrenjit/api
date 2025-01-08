function prints(newNumber, newProvider) {
    $.ajax({
        type: "POST",
        url: 'test.php',
        data: {
            number: newNumber,
            provider: newProvider,
        },
        success: function(response) {
            $("#page-content").html(response);
            $("#page-content").wordExport();
        }
    });
}

function updatenumbers(re,slN, pN, pR, fD, tD, cF, cD, aD) {
    $.ajax({
        type: "POST",
        url: 'update-no.php',
        data: {
            rN: slN,
            number: pN,
            provider: pR,
            fromD: fD,
            toD: tD,
            cR: cD,
            cA: cF,
            aR: aD
        },
        success: function(response) {
            selectNumbers(re);
            $('#pNumber').val('');
            $('#provider').val('');
            $('#fDate').val('');
            $('#tDate').val('');
            $('#cdr').prop('checked', false);
            $('#caf').prop('checked', false);
            $('#address').prop('checked', false);
            $('#ubtn').hide();
            $('#loginform').show();
        }
    });
}

function selectNumbers(abc) {
    $.ajax({
        type: "POST",
        url: 'select-no.php',
        data: {
            number: abc,
        },
        success: function(response) {
            $("#row1").html(response);
        }
    });
}

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
        else
        {
            return 0;
        }
    }
}

function insertNumbers(re, pN, pR, fD, tD, cD, cF, aD) {
    if(fD==''||tD==''){
        fD='0000-00-00';
        tD='0000-00-00';
    }
    $.ajax({
        type: "POST",
        url: 'insert-no.php',
        data: {
            rN: re,
            number: pN,
            provider: pR,
            fromD: fD,
            toD: tD,
            cR: cD,
            cA: cF,
            aR: aD
        },
        success: function(response) {
            selectNumbers(re);
            $('#pNumber').val('');
            $('#provider').val('');
        }
    });
}
function dateConvert(dateInput)
{
    var parts = dateInput.split('/'); 
    var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0]; 
    return formattedDate;
}
function chekboxCheck(dateInput){
    if(dateInput=="1")
        return 1;
    else
    return 0;
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