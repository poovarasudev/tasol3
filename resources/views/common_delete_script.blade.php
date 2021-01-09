<script>
    function commonDelete(element) {
        swal({
            title: "Are you sure to Delete?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    element.parentElement.submit();
                    swal({
                        title: "Deleted!",
                        text: "",
                        icon: "success",
                        button: false,
                    });
                }
            });
    }
</script>
