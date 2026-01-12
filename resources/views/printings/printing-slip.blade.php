<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="ie=edge" http-equiv="X-UA-Compatible">

  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

  <title>Z - Systems</title>
</head>

<style>
  body {
    margin: 2px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
  }

  h6 {
    font-size: 14px;
  }

  .th {
    font-size: 14px;
  }

  .text-left {
    text-align: left;
  }

  .text-right {
    text-align: right;
  }

  .text-center {
    text-align: center;
  }

  .text-bold {
    font-weight: bold;
  }

  .text-underline {
    text-decoration: underline;
  }

  .text-italic {
    font-style: italic;
  }

  @media print {
    td {
      border: none !important;
    }
  }

  table {
    border: 0 !important;
    border-collapse: collapse !important;
    border-spacing: 0;
    padding: 0;
  }

  table tr,
  table td,
  table th {
    border: 0 !important;
    border-style: none !important;
  }

  table.no-border {
    border-style: hidden !important;
  }
</style>

<body>
  <div class="p-2">
    <div class="container">
      <div>
        @yield('content')
      </div>
    </div>
  </div>
</body>

</html>