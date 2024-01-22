<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <center>
        <div class="container">
            <h1 class="my-3">Toko Uuy</h1>
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Detail Pesanan</h5>
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>: {{ $order->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $order->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>: {{ $order->number_phone }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>: {{ $order->date }}</td>
                        </tr>
                        <tr>
                            <td>price</td>
                            <td>: {{ $order->price }}</td>
                        </tr>
                    </table>
                    <button id="pay-button" class="btn btn-primary mt-3">Bayar Sekarang</button>
                    <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <div id="snap-container">
            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
                    // Also, use the embedId that you defined in the div above, here.
                    window.snap.embed('{{ $snapToken }}', {
                        embedId: 'snap-container',
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            alert("payment success!");
                            console.log(result);
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    });
                });
            </script>
        </div>
    </center>
</body>

</html>
