require('./bootstrap');
$(document).ready(function () {

    $('#search').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"search",
            type:"GET",
            data:{'names':query},
            success:function (data) {
                $('#search_list').html(data);
            }
        })
    });

    $(document).on('click', 'input', function(){
        var value = $(this).text();
        $('#search').val(value);
        $('#search_list').html("");
    });
});
