<script>
    function commonDelete(url, name) {
        swal({
            title: "Are you sure to delete '" + name + "'?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            swal({
                                title: name + " Deleted Successfully!",
                                text: " ",
                                icon: "success",
                                buttons: false,
                            });
                            swal.close();
                            location.reload();
                        },
                        error: function (response) {
                            var msg = response.responseJSON.message;
                            swal({
                                title: "Warning!",
                                text: msg,
                                icon: "warning",
                            });
                        },
                    });
                }
            });
    }
</script>
