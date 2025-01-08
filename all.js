$(document).ready(function() {
    var re = GetURLParameter('reqNo');
    if(re==0){
        window.location = "index.html";
    }
    $('#ubtn').hide();
    selectNumbers(re);
    $(document).on('click', '.bttapr', function() {
        var currentRow = $(this).closest("tr");
        var slNo = currentRow.find("td:eq(0)").text();
        var mobileNo = currentRow.find("td:eq(5)").text();
        var provider = currentRow.find("td:eq(6)").text();
        var fromDate = currentRow.find("td:eq(7)").text();
        var toDate = currentRow.find("td:eq(8)").text();
        var cdr = currentRow.find("td:eq(9)").text();
        var caf = currentRow.find("td:eq(10)").text();
        var adr = currentRow.find("td:eq(11)").text();
        $('#pNumber').val(mobileNo);
        $('#fDate').val(dateConvert(fromDate));
        $('#tDate').val(dateConvert(toDate));
        $('#cdr').prop('checked', chekboxCheck(cdr));
        $('#caf').prop('checked', chekboxCheck(caf));
        $('#address').prop('checked', chekboxCheck(adr));
        $('#provider').val(provider);
        $('#slhiden').val(slNo);
        $('#loginform').hide();
        $('#ubtn').show();
    });
    $(document).on('click', '.addbtn', function() {
        alert("renjith");
    });
    $(document).on('click', '.ubtn', function() {
        var pN = '';
        var pR = '';
        var fD = '';
        var tD = '';
        var cF = '';
        var cD = '';
        var aD = '';
        pN = $('#pNumber').val();
        pR = $('#provider').val();
        fD = $('#fDate').val();
        tD = $('#tDate').val();
        slN = $('#slhiden').val();
        if ($('#cdr').is(':checked')) {
            cD = 1;
        } else {
            cD = 0;
        }
        if ($('#caf').is(':checked')) {
            cF = 1;
        } else {
            cF = 0;
        }
        if ($('#address').is(':checked')) {
            aD = 1;
        } else {
            aD = 0;
        }
        if ((cD == 0) && (cF == 0) && (aD == 0)) {
            return;
        }
        if (fD > tD) {
            alert("date alert")
            return;
        }
        updatenumbers(re,slN, pN, pR, fD, tD, cF, cD, aD);
    });
    
    $(document).on('click', '.cbtn', function() {
        var pN = '';
        var pR = '';
        var fD = '';
        var tD = '';
        var cF = '';
        var cD = '';
        var aD = '';
        pN = $('#pNumber').val();
        pR = $('#provider').val();
        fD = $('#fDate').val();
        tD = $('#tDate').val();
        if ($('#cdr').is(':checked')) {
            cD = 1;
        } else {
            cD = 0;
        }
        if ($('#caf').is(':checked')) {
            cF = 1;
        } else {
            cF = 0;
        }
        if ($('#address').is(':checked')) {
            aD = 1;
        } else {
            aD = 0;
        }
        if ((cD == 0) && (cF == 0) && (aD == 0)) {
            return;
        }
        if (fD > tD) {
            alert("date alert")
            return;
        }
        insertNumbers(re,pN,pR,fD,tD,cD,cF,aD);
    });
    $(document).on('click', '.closebtn', function() {
        setCookie('test', '0', '1');
        location = "http://192.168.1.14:8080/newcirtificate/";
    });

    $(document).on('click', '.bsnl', function() {
        prints(re, 'BSNL');
    });
    $(document).on('click', '.jio', function() {
        prints(re, 'Jio');
    });
    $(document).on('click', '.airtel', function() {
        prints(re, 'Airtel');
    });

    $(document).on('click', '.vi', function() {
        prints(re, 'VI');
    });
});