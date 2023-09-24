<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/reset-css@5.0.2/reset.min.css">
        <style>
            .header {
                position: relative;

                margin: 0 48px;
                margin-top: 12px;
                padding-bottom: 24px;

                height: 100px;

                border-bottom: 1px solid rgba(0, 0, 0, .5);
            }

            .header-logo {
                position: absolute;
                top: 12px;
                left: 0;
            }

            .header-cover {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .header-cover-title, .header-cover-subtitle {
                text-align: center;
                font-size: 1.2rem;
                font-weight: bold;
            }

            .header-cover-subtitle {
                margin-top: 1rem;
            }

            .body {
                font-family: sans-serif;
            }

            .data {
                width: 100%;
                border-collapse: collapse;
            }

            .data th, .data td {
                padding: 8px;
            }

            .data th {
                font-size: 0.8rem;
                font-weight: bold;
            }

            .data td {
                font-size: 0.8rem;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img
                class="header-logo"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Politeknik_Negeri_Padang_%282014%29.svg/1200px-Logo_Politeknik_Negeri_Padang_%282014%29.svg.png"
                alt="Logo Politeknik Negeri Padang"
                width="100px"
            />
            <div class="header-cover">
                <div class="header-cover-title">@yield('title')</div>
                <div class="header-cover-subtitle">@yield('subtitle')</div>
            </div>
        </div>
        <div class="body">
            @yield('content')
        </div>
    </body>
</html>
