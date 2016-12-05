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