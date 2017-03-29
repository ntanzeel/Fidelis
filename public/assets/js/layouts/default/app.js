$(document).ready(function () {
    $('.btn-search').on('click', function () {
        $('.btn-search').hide();
        $('.txt-search').show().focus();
    });

    $('.txt-search').on('blur', function () {
        if ($(this).val().length == 0) {
            $('.txt-search').hide();
            $('.btn-search').show()
        }
    }).on('keyup', function () {
        var query = encodeURIComponent($(this).val());

        if (query.length >= 3) {
            $.ajax({
                url: 'api/search/' + query,
                method: 'GET',
                dataType: "json",
                success: function (data) {
                    console.log(data);
                }
            });
        }
    });
});

function showResult(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }

    $.ajax({
        url: 'display',
        method: 'get',
        data: {'str': str},
        processData: false,
        contentType: false,
        beforeSend: function (xhr) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (response) {
            //For now just want to list out the names of Users/Tsgs returned from the SearchController
            //Not sure exactly how to do so...
            // document.getElementById("livesearch").innerHTML = response[];
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
        },
        error: function (response) {
            console.log(this.responseText);
        }
    });
};