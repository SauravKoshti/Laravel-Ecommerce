<script>
    $(function() {
        var cardTitle = $('#card_title');
        var usersTable = $('#gst_table');
        var resultsContainer = $('#search_results');
        var usersCount = $('#gst_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_gst');
        var searchformInput = $('#gst_search_box');
        var userPagination = $('#user_pagination');
        var searchSubmit = $('#search_trigger');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('');
            usersTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("usersmanagement.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';
         $.ajax({
            type:'POST',
            url: "{{ route('search-gst')}}",
            data: searchform.serialize(),
            success: function (result) {
                let jsonData = JSON.parse(result);
                if (jsonData.length != 0) {
                    $.each(jsonData, function(index, val) {
              
                let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="gst/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("usersmanagement.tooltips.edit") }}">{!! trans("usersmanagement.buttons.edit") !!}</a>';
                let deleteCellHtml = '<form method="POST" action="/gst/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                        '{!! Form::hidden("_method", "DELETE") !!}' +
                        '{!! csrf_field() !!}' +
                        '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{!! trans("usersmanagement.modals.delete_user_message", ["user" => "'+val.name+'"]) !!}">' +
                            '{!! trans("usersmanagement.buttons.delete") !!}' +
                        '</button>' +
                    '</form>';

                resultsContainer.append('<tr>' +
                    '<td>' + val.gst_id + '</td>' +
                    '<td>' + val.gst_name + '</td>' +
                    '<td class="hidden-xs">' + val.gst_percentage + '</td>' +
                    '<td>' + deleteCellHtml + '</td>' +
                    '<td>' + editCellHtml + '</td>' +
                '</tr>');
            });
        } else {
            resultsContainer.append(noResulsHtml);
        };
        usersCount.html(jsonData.length + " {!! trans('usersmanagement.search.found-footer') !!}");
        userPagination.hide();
        cardTitle.html("{!! trans('usersmanagement.search.title') !!}");
    },
    error: function (response, status, error) {
        if (response.status === 422) {
            resultsContainer.append(noResulsHtml);
            usersCount.html(0 + " {!! trans('usersmanagement.search.found-footer') !!}");
            userPagination.hide();
            cardTitle.html("{!! trans('usersmanagement.search.title') !!}");
        };
    },
});
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#gst_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                usersTable.show();
                cardTitle.html("{!! 'Show GSTs' !!}");
                userPagination.show();
                usersCount.html(" ");
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            usersTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! 'Show GSTs' !!}");
            userPagination.show();
            usersCount.html(" ");
        });
    });
</script>
