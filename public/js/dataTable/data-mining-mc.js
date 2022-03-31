/**
 *
 * @param route
 * @param tableName
 * @param searchKey
 * @param viewLocation
 * @param columns
 * @param position
 */
function dataFilter(route,tableName, searchKey, viewLocation, columns,constraintKeyValue, position) {

        var url = route+'?searchKey='+ searchKey+'&position='+position+'%20&viewLocation='+ viewLocation+'%20&constraintKeyValue='+constraintKeyValue+'%20&columns='+columns+'%20&tableName='+tableName;

        // position = typeof content !== 'undefined' ? content : 'content';
        $('.loading').show();
        $.ajax({
            type: "GET",
            url: url,
            contentType: false,
            success: function (data) {
                $('.loading').hide();
                $("#position").html(data);
            },
            error: function (xhr, status, error) {
                $('.loading').hide();
                //alert('Error occurred during search! please check with admin!');
            }
        });
    }
