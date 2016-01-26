
<!doctype html>
<html class="no-js" lang="">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Google's material design UI components built with React.">
      <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MTC5</title>
        <!-- CSS -->
        {!! HTML::style('css/app.css') !!}

        <!-- js -->
        {!! HTML::script('js/vendor.js') !!}


        <meta name="csrf-token" content="{{ csrf_token() }}" />




<body>
  <div id="content"></div>
  {!! HTML::script('js/app.js') !!}
</body>

</html>
