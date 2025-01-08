$(document).ready(function() {
    selectNumbers(1);
    let be = null;
    be = selectNumbers1();
    if(be!=null){
    displayselect(be);
    }
    function displayselect(be) {        
        $.each(be.user, function (index, users) {
    /* var re = be.user.length;
    for (i = 0; i <= re; i++) {*/
        var a=users.stationId;
        var b=users.stationName;
        $('#reqoffice').append('<option value=' + a + '>' + b+ '</option>');
        $('#ps').append('<option value=' + a + '>' + b + '</option>');
        
    });
}

    function stationValue(bcd){
        var re = be.user.length;
        for (i = 0; i <= re; i++) {
        var b=be.user[i].stationName;
        if(bcd==b){
            return be.user[i].stationId
        }
        }
    }
    
    
    //selectStation();
    $(document).on('click', '.bttapr', function() {
        var currentRow = $(this).closest("tr");
        var reqNo = currentRow.find("td:eq(0)").text();
        var cfcNo = currentRow.find("td:eq(1)").text();
        var reqOffice = currentRow.find("td:eq(4)").text();
        var pS = currentRow.find("td:eq(5)").text();
        var cNo = currentRow.find("td:eq(2)").text();
        var Sections = currentRow.find("td:eq(3)").text();
        $("#reqno").val(reqNo);
        $("#cfcno").val(cfcNo);
        $('#reqoffice').val(stationValue(reqOffice));
        $("#ps").val(stationValue(pS));
        $('#cno').val(cNo);
        $('#sections').val(Sections);
        $('#btnSubmit').attr("disabled", false);
    });
/* 
    $(document).on('click', '.bttadd', function() {
        var currentRow = $(this).closest("tr");
        var col2 = currentRow.find("td:eq(0)").text();
        console.log(col2);
        var uri = 'http://192.168.1.14:8080/newcirtificate/insert-mobile.html?reqNo=' + col2;
        location = uri;
    });
*/

$(document).on('click', '#btnSubmit', function() {
        var reqNo=$("#reqno").val();
        var cfcNo=$("#cfcno").val();
        var reqOffice=$('#reqoffice').val();
        var pS=$("#ps").val();
        var cNo=$('#cno').val();
        var Sections=$('#sections').val();   
        $.ajax({
            type: "POST",
            url: 'update-request.php',
            data: {
                reqNo: reqNo,
                cfcNo: cfcNo,
                reqOffice: reqOffice,
                pS: pS,
                cNo: cNo,
                Sections: Sections,

            },
            success: function(response) {
                $("#my").html(response);
            }
        });

});
    function selectNumbers(abc) {
        alert(abc);
        $.ajax({
            type: "POST",
            url: 'select-request.php',
            data: {
                number: abc,
            },
            success: function(response) {
                $("#my").html(response);
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

    /* function selectStation() {
        $.ajax({
            type: "POST",
            url: 'select-station.php',
            data: {},
            success: function(response) {
                $("#reqoffice").html(response);
                $("#ps").html(response);
            }
        });
    }

    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    } */
});