<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<h>, initial-scale=1.0">
    <title>Splash Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        html,
        body {
            background-color: lightblue;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .LogoImg {
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: 2in;
            opacity: 0;
            animation: zoomFadeIn 1s ease-in-out forwards;
        }

        .fade-in {
            opacity: 6;
            animation: fadeIn 1s ease-in-out forwards;
        }

        .fade-out {
            opacity: 1;
            animation: fadeOut 1s ease-in-out forwards;
        }

        .motion-up {
            transform: translateY(100%);
            animation: motionUp 1s ease-in-out forwards;
        }
        .motion-up2 {
            transform: translateY(0%);
            animation: fadeOut 1s ease-in-out forwards;
        }
        @keyframes motionDown {
            0% {
                transform: translateY(0%);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        

        .motion-down {
            transform: translateY(-100%);
            animation: motionDown 1s ease-in-out forwards;
        }

        @keyframes zoomFadeIn {
            0% {
                opacity: 0;
                transform: scale();
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(.5);
            }
        }

        @keyframes motionUp {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes motionDown {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(100%);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body  class="d-flex justify-content-center align-items-center">
    <div>
        <img class="LogoImg" src="logo_only.png" alt="DICT logo">
        <h1 class="fade-in motion-up" style="text-align:center">CONTROL NUMBER GENERATOR</h1>
        <h3 class="fade-in motion-down" style="text-align:center">DICT DEPARTMENT OF INFORMATION AND COMMUNICATIONS
            TECHNOLOGY</h3>
    </div>

    <script>
        setTimeout(function () {
            var body = document.querySelector('body');

            body.classList.add('motion-up2');
        }, 2000);


        setTimeout(function () {
            var elements = document.querySelectorAll('.LogoImg, h1, h3');

            elements.forEach(function (element) {
                element.classList.add('fade-out');
            });

            setTimeout(function () {
                // Redirect to another page
                window.location.href = "home.php";
            }, 700);
        }, 2000);
    </script>
</body>

</html>