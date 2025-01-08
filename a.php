<html>

    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
        <div class="col-md-6">
            <h1>Enter Details</h1>
            <form method="post" action="c.php">
                <div class="form-group fieldGroup">
                    <div class="input-group">
                        <input type="text" name="phno[]" class="form-control" placeholder="Enter No" pattern=".{10,12}" required="required" />
                         <input type="date" name="fdate[]" class="form-control" />
                        <input type="date" name="tdate[]" class="form-control" />
                        <input type="text" name="cd[]" class="form-control cdrtxt" value="0" />
                        <input type="hidden" name="ca[]" class="form-control invisible caftxt" value="0" />
                        <input type="hidden" name="sd[]" class="form-control invisible sdrtxt" value="0" />
                        <label class="checkbox-inline"><input type="checkbox" name="cdr[]" class="checkbox-inline cdr" />CDR</label>
                    <label class="checkbox-inline"><input type="checkbox" name="caf[]" class="checkbox-inline caf" />CAF</label>
                    <label class="checkbox-inline"><input type="checkbox" name="sdr[]" class="checkbox-inline sdr" />SDR</label>

                        <div class="input-group-addon">
                            <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT" />
            </form>
            <!-- copy of input fields group -->
            <div class="form-group fieldGroupCopy" style="display: none;">
                <div class="input-group">
                    <input type="text" name="phno[]" class="form-control" placeholder="Enter No" pattern=".{10,12}" required="required" />
                    <input type="date" name="fdate[]" class="form-control" />
                        <input type="date" name="tdate[]" class="form-control" />
                    <input type="text" name="cd[]" class="form-control invisible cdrtxt" value="0" />
                    <input type="hidden" name="ca[]" class="form-control invisible caftxt" value="0" />
                    <input type="hidden" name="sd[]" class="form-control invisible sdrtxt" value="0" />
                    <label class="checkbox-inline"><input type="checkbox" name="cdr[]" class="checkbox-inline cdr" />CDR</label>
                    <label class="checkbox-inline"><input type="checkbox" name="caf[]" class="checkbox-inline caf" />CAF</label>
                    <label class="checkbox-inline"><input type="checkbox" name="sdr[]" class="checkbox-inline sdr" />SDR</label>



                    <div class="input-group-addon">
                        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
                    </div>
                </div>
            </div>
            <div class="row">
        </div>
    </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            //group add limit
            var maxGroup = 10;

            //add more fields group
            $(".addMore").click(function() {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                } else {
                    alert('Maximum ' + maxGroup + ' groups are allowed.');
                }
            });

            //remove fields group
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });

            // for cdr

            $(document).on('click', '.cdr', function() {
                         alert(1);
                if ($(this).is(":checked")) {
                    var cdf=$(this).parent().find('.cdrtxt').val();
                    alert(cdf);

                    $(this).parent().find('.cdrtxt').val("1");
                } else {
                    $(this).parent().find('.cdrtxt').val("0");
                }
            });
            //end of cdr
            //for caf

            $(document).on('click', '.caf', function() {

                if ($(this).is(":checked")) {

                    $(this).parent().find('.caftxt').val("1");
                } else {
                    $(this).parent().find('.caftxt').val("0");
                }
            });

            // end of caf
            //for sdr
            $(document).on('click', '.sdr', function() {

                if ($(this).is(":checked")) {

                    $(this).parent().find('.sdrtxt').val("1");
                } else {
                    $(this).parent().find('.sdrtxt').val("0");
                }
            });

            //end of sdr

        });
        </script>
    </body>

    </html>