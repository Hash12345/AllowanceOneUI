<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toaster|Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body>

    <script>
        $(document).ready(function(){
            @if(Session::has('success'))
                console.log("Hello")
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success("{{ session('success') }}");
            @endif
            @if(Session::has('warning'))
                console.log("warning")
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                        toastr.warning("{{ session('warning') }}");
            @endif
            @if(Session::has('error'))
                console.log("error")
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.error("{{ session('error') }}");
            @endif
        })
    </script>
</body>
</html>