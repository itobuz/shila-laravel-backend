<script type="text/javascript">
    /* Stripe Response handler */
    function stripeResponseHandler(status, response) {
        // Grab the form:
        var $form = $('#payment-form');

        if (response.error) { // Problem!

            // Show the errors on the form:
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.submit').prop('disabled', false); // Re-enable submission

        } else { // Token was created!

            // Get the token ID:
            var token = response.id;

            // Insert the token ID into the form so it gets submitted to the server:
            $form.append($('<input type="hidden" name="stripeToken">').val(token));

            // Submit the form:
            $form.get(0).submit();
        }
    }

    /* Stripe form submission */
    function submitPaymentForm() {
        var $form = $('#payment-form');
        $form.submit(function (event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Stripe:
            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from being submitted:
            return false;
        });
    }
    $(document).ready(function () {
        var API_TOKEN = $('input[name=_token]').val();

        $("#rolecheck input[type='checkbox']").on("change", function (e) {
            var $this = $(this);
            var payload = {
                status: e.target.checked,
                roleId: e.target.value,
                permissionId: $(this).data('permission')
            };
            var request = $.ajax({
                url: "{!! url('/admin/permission/attachment') !!}",
                headers: {'X-CSRF-TOKEN': API_TOKEN},
                method: "POST",
                data: payload,
                dataType: "html"
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
                $this.prop("checked", !$this.prop("checked"));
            });
        });

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


        /*Payment option radio button */
        $('.payment-option input[type="radio"]').click(function () {
            if ($(this).attr("value") == "Cash on dailivary") {
                $(".credit-card-form").hide();
            }
            if ($(this).attr("value") == "Credit card") {
                $(".credit-card-form").show();
                submitPaymentForm();
            }

        });

    });
</script>