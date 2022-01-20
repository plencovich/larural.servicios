<!DOCTYPE html>
<html lang="es" data-footer="true">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
</head>

<body style="margin: 0; padding: 0; background-color: #f9f9f9; padding-top: 10px">
    <div style="
      height: auto !important;
      width: 600px !important;
      font-family: Helvetica, Arial, sans-serif !important;
      margin-bottom: 40px;
      margin-left: auto;
      margin-right: auto;
    ">
        <!-- Basic Start -->
        <div style="margin-bottom: 100px">
            <table style="
          width: 600px;
          background-color: #ffffff;
          border: none;
          border-collapse: separate !important;
          border-radius: 16px;
          border-spacing: 0;
          color: #4e4e4e;
          margin: 0;
          padding: 32px;
          font-size: 14px;
          font-weight: 400;
          line-height: 1.5;
          box-shadow: 0 4px 10px rgb(0 0 0 / 3%) !important;
        ">
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('/img/logo/logo-larural.svg') }}" alt="logo"
                                style="width: 128px; margin-bottom: 30px; clear: both; display: inline-block" />
                            <br />
                            @yield('content')
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="margin-top: 30px; padding-bottom: 20px; margin-bottom: 40px; width: 600px">
                <tbody>
                    <tr>
                        <td style="text-align: center; vertical-align: center">
                            @include('emails._layout.email_footer')
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Basic End -->
    </div>
</body>

</html>
