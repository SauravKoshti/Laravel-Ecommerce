<script>
    $(function() {
        var cardTitle = $('#card_title');
        var usersTable = $('#property_table');
        var resultsContainer = $('#search_results');
        var usersCount = $('#property_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_property');
        var searchformInput = $('#property_search_box');
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
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-properties') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        $.each(jsonData, function(index, val) {
                            let rolesHtml = '';
                            let roleClass = '';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="properties/' + val.property_id + '/edit" data-toggle="tooltip" title="{{ trans("usersmanagement.tooltips.edit") }}">{!! trans("usersmanagement.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="/project/properties/'+ val.property_id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Size" data-message="{!! trans("usersmanagement.modals.delete_user_message", ["user" => "'+val.property_name+'"]) !!}">' +
                                        '{!! trans("usersmanagement.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';
                                
                            resultsContainer.append('<tr>' +
                                '<td>' + val.property_id + '</td>' +
                                '<td>' + val.property_name + '</td>' +
                                '<td>' + val.property_parent_id + '</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + val.created_at + '</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + val.updated_at + '</td>' +
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
            if ($('#property_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                usersTable.show();
                cardTitle.html("{!! trans('usersmanagement.showing-all-users') !!}");
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
            cardTitle.html("{!! trans('usersmanagement.showing-all-users') !!}");
            userPagination.show();
            usersCount.html(" ");
        });
    });
</script>
