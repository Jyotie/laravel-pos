<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    </head>
    <body>
       <div class="container">
        <div class="form-group">
          <label for="customers">Select customer</label>
            <select name="cid" id="customers" class="form-control">
              @foreach($customers as $key => $customer)
              <option value="{{ $key }}">{{ $customer }}</option>
              @endforeach
            </select>
        </div>
      </div>
    
    <script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#customers').select2({
                placeholder : 'Please select Customer'
                
                
            });
        });
    </script>
    </body>
</html>