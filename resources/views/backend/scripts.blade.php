<script type="text/javascript">
    $(document).ready(function () {
        $('.delete-button').on('click', function () {
            return confirm('Are you sure you want to delete this item?');

        });
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        if ($('.post-content').length) {
            CKEDITOR.replace('post_content');
        }
        if ($('.product-content').length) {
            CKEDITOR.replace('product_content');
        }
        if ($('.page-content').length) {
            CKEDITOR.replace('page_content');
        }
        /*
         * All published posts list
         */
        oTable = $('#datatable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "post/data",
            "columns": [
                {data: 'post_title', name: 'post_title'},
                {data: 'post_status', name: 'post_status'},
                {data: 'post_date', name: 'post_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });

        /*
         * All trash posts
         */
        TTable = $('#trashtable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "trash-data",
            "columns": [
                {data: 'post_title', name: 'post_title'},
                {data: 'post_date', name: 'post_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });



        /*
         * All published product list
         */
        oTable = $('#producttable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "product/data",
            "columns": [
                {data: 'product_title', name: 'product_title'},
                {data: 'qty', name: 'qty'},
                {data: 'product_status', name: 'product_status'},
                {data: 'product_date', name: 'product_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });

        /*
         * All trash products
         */
        TTable = $('#trashproducttable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "trash-data",
            "columns": [
                {data: 'product_title', name: 'product_title'},
                {data: 'product_date', name: 'product_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });

        /*
         * All published pages list
         */
        oTable = $('#page-datatable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "page/data",
            "columns": [
                {data: 'page_title', name: 'page_title'},
                {data: 'page_status', name: 'page_status'},
                {data: 'page_date', name: 'page_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });

        /*
         * All trash pages
         */
        TTable = $('#page-trashtable-list').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ajax": "trash-data",
            "columns": [
                {data: 'page_title', name: 'page_title'},
                {data: 'page_date', name: 'page_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false}

            ],
            "lengthMenu": [5, 10, 20, "All"],
            "autowidth": false
        });


        $("input.featuredImg").change(function (e) {

            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

                var file = e.originalEvent.srcElement.files[i];

                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function () {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $(".uploaded-img").empty();
                $(".uploaded-img").append(img);
            }
        });
    });
</script>