@extends('Backend.index')
@section('contentAdmin')
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

    <div class="aboutAuthor">
        <div class="K2_bio">
            <img src="{{asset('uploads/images/drowsines-removebg-logo.png')}}" alt="">

            <h2>Safe Driver</h2>
            <div class="h-divider">
                <div class="shadow"></div>
                <div class="text2"></div>
            </div>
            <p> We are a team of experts in technology and artificial intelligence, committed to ensuring road safety. Our driver drowsiness detection project utilizes advanced algorithms to identify signs of fatigue and provide timely alerts. Our goal is to reduce traffic accidents caused by drowsy driving, contributing to a safer driving environment. We are dedicated to delivering effective and reliable technological solutions to the <community class=""></community></p>
            <div class="h-divider">
                <div class="shadow"></div>
            </div>
        </div>
    </div>
    <style>
        .aboutAuthor {
            padding: 60px 0 20px 0;
        }

        .aboutAuthor .K2_bio {
            justify-content: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            align-items: center;
            max-width: 70%;
            margin: auto;
            padding: 80px 15px 65px 15px;
            /*background-color: #FFF;*/
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            border-radius: 10px;
            border: 2px solid #404040;
            font-family: 'Oswald', serif;
        }

        .aboutAuthor .K2_bio img {
            padding: 0;
            width: 120px;
            height: 120px;
            position: absolute;
            border-radius: 50%;
            top: -60px;
            pointer-events: none;

        }

        .aboutAuthor .K2_bio h2 {
            margin: 0px !important;
            padding: 0;
        }

        .aboutAuthor .K2_bio p {
            margin: 1em 0 !important;
            text-align: center;
        }

        .aboutAuthor .K2_bio .k2About-bt {
            text-align: center;
            position: absolute;
            bottom: 10px;
        }

        .k2About-bt {
            width: 100px;
            height: 30px;
            background: #C8102E;
            text-align: center;
            padding: 0 10px;
            line-height: 1.8em;
            border-radius: 5px;
        }

        .k2About-bt :link {
            text-decoration: none;
        }

        .h-divider {
            margin: auto;
            margin-top: 15px;
            width: 80%;
            position: relative;
        }

        .h-divider .shadow {
            overflow: hidden;
            height: 20px;
        }

        .h-divider .shadow:after {
            content: '';
            display: block;
            margin: -25px auto 0;
            width: 100%;
            height: 25px;
            border-radius: 125px/12px;
            box-shadow: 0 0 8px black;
        }

        .h-divider .text2 {
            width: 20px;
            height: 20px;
            position: absolute;
            bottom: 100%;
            margin-bottom: -10px;
            left: 50%;
            margin-left: -10px;
            border-radius: 100%;
            box-shadow: 0 2px 4px #999;
            background: white;
            border: 1px dashed #777;
        }
    </style>
@endsection
