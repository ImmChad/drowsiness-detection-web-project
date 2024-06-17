@extends('Backend.index')
@section('contentAdmin')
    <style>

        .section-add-vehicle
        {
            width: 95%;
            height: 85%;
            padding: 10px 0px;

        }
        .header-add-vehicle {
            display: flex;
            height: 20%;
            align-items: center;
            margin: 0px 40px;
            position: relative;
            margin-top: -10px;
        }
        .body-add-vehicle
        {
            height: 85%;
            min-width: 100%;
            border-radius: 12px;
            display: flex;
            justify-content: center;
        }
        .btn-add-vehicle
        {
            background: #0e5904;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            width: max-content;
            right: 0;
            padding: 5px 20px;
            font-size: 20px;
            cursor: pointer;
        }
        .name-vehicle
        {
            color: black;
            font-weight: bold;
            font-size: 40px;
            margin-left: 20px;

        }
        .btn-navigate-main-vehicle *,.btn-navigate-main-vehicle *:hover
        {
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            color: #0e5904!important;
        }
        .form-add-vehicle {
            display: flex;
            justify-content: space-between;
            height: 100%;
            padding: 40px;
            width: 500px;
            box-shadow: 1px 1px 7px 1px grey;
            border-radius: 20px;
        }

        .form-ipt-field,.ipt-add-field
        {
            font-weight: 600;
        }
        .section-info-base
        {
            width: 90%;
            height: 100px;
        }
        .section-info-media
        {
            width: 70%;
            min-height: 70%;
            display:none;
        }
        .preview-img,.preview-video
        {
            width: 270px;
            height: 165px;
            background: black;
            border-radius: 20px;
        }
        .form-add-image,.form-add-video
        {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 20px;
        }
        .right-form-add-media
        {
        }
        .part-input
        {
            margin-bottom: 10px;
        }
        .label-ipt-media {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .form-ipt-media
        {
            display:flex;
            position: relative;
        }
        .btn-apply-media
        {
            background: #0e5904;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            width: max-content;
            padding: 1px 20px;
            vertical-align: middle;
            position: absolute;
            height: 100%;
            right: 0;
            cursor:pointer;
        }
        .ipt-add-field
        {
            outline: none;
            border-radius: 20px;
            border: 3px solid #0e5904;
            padding: 0 20px;
            height: 32px;
        }
        .form-ipt-media .ipt-add-field
        {
            min-width: 400px;
        }
        .form-ipt-text .ipt-add-field
        {
            min-width: 300px;
        }
        .select-field
        {

            cursor: pointer;
            position: relative;
            display: flex;
            justify-content: space-between;
            min-width: 150px !important;
        }
        .btn-drop-select
        {
            color:#0e5904;
            cursor: pointer;
            margin-left:20px;
        }
        .form-ipt-select
        {
            width: max-content;
            max-width:300px;
        }
        .drop-list-select
        {
            display: none;
            position: absolute;
            width: 100%;
            left: 0;
            top: 100%;
            margin-top: 4px;
            background: white;
            z-index: 1;
            border-radius: 4px 4px 20px 20px;
            border: 1px solid #0e5904;
            padding: 0px 20px;
            max-height: 250px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .drop-list-select::-webkit-scrollbar {
            width: 8px;
        }

        .drop-list-select::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .drop-list-select::-webkit-scrollbar-thumb {
            background-color: #0e5904 ;
            border-radius: 6px;
        }



        .item-select-field
        {

            cursor: pointer;
            width: max-content;

        }
    </style>
    <div class="section-add-vehicle">
        {{-- <div class="row header-add-vehicle">
            <div class="btn-navigate-main-vehicle">
                <i class="fa-solid fa-circle-left"></i>
                <a href="/vehicle/all-vehicle">BACK</a>
            </div>
            <div class="name-vehicle">
                Add Vehicle
            </div>
            <div class="btn-add-vehicle ">
                Add
            </div>
        </div> --}}
        <div class="card-title" style="display: flex;justify-content: space-between">
            <div class=" col-sm-2" style="font-size: 18px;  font-weight: 900; display: flex; justify-content: center; align-items: center; ">
                <div class="btn-navigate-main-vehicle">
                    <i class="fa-solid fa-circle-left"></i>
                    <a >BACK</a>
                </div>
            </div>
            <div class=" col-sm-5" style="font-size: 30px; font-weight: 900;">
                Vehicle
            </div>
            <div class="col-sm-5">
                <div data-value = ""class="btn-add-vehicle ">
                    ADD VEHICLE
                </div>
            </div>
        </div>
        <div class="body-add-vehicle ">
            <div class="form-add-vehicle">
                <div class="section-info-base">
                    <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Vehicle Number
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input id="ipt_vehicle_number" placeholder="79F4959" class="ipt-add-field ipt-url-img" value="" type="text">
                        </div>
                    </div>
                    <div class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Group
                        </div>
                        <div class="form-ipt-field form-ipt-select">
                        <div class="ipt-add-field select-field">
                                    <div id="ipt_group_id" class="value-select-field" data-value="">
                                        Choose Company
                                    </div>
                                    <div class="btn-drop-select">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                    <div class="drop-list-select">
                                        @foreach($dataAllCompanyMinimum as $itemCompanyMinimum)
                                        <div class="item-select-field" data-value="{{$itemCompanyMinimum->company_id}}">
                                        {{$itemCompanyMinimum->dataParent->company_group}}-{{$itemCompanyMinimum->company_group}}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div style="display:none;"class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Tablet
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input id="ipt_tablet_id" class="ipt-add-field ipt-url-img"  value=""type="text">
                        </div>
                        </div>
                        <div  class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            Number Phone
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input id="ipt_number_phone" class="ipt-add-field ipt-url-img" placeholder="0583152783" value=""type="text">
                        </div>
                        </div>
                        <div style="display:none" class="part-input">
                        <div class="label-ipt-field label-ipt-media">
                            App ID
                        </div>
                        <div class="form-ipt-field form-ipt-text">
                            <input id="ipt_app_id" class="ipt-add-field ipt-url-img"  value=""type="text">
                        </div>
                    </div>
                </div>
                <div class="section-info-media">
                    <div class="form-add-video">
                        <video class ="preview-video"src="https://drive.google.com/uc?export=view&id=1ncjsdmFYV9WKawcEfYAYvce4rf8lsgL_" controls muted></video>
                    <div class="right-form-add-media">
                        <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">add Video</div>
                                <div class="form-ipt-field form-ipt-media">
                                    <input class="ipt-add-field ipt-url-video" type="text">
                                    <div class="btn-apply-media">Apply</div>
                                </div>
                        </div>

                        <div class="part-input">
                                <div class="label-ipt-field label-ipt-media">Select Time Rest</div>
                                <div class="form-ipt-field form-ipt-media">
                                    <div class="ipt-add-field select-field">
                                        <div class="value-select-field" data-value="15">
                                            15 minutes
                                        </div>
                                        <div class="btn-drop-select">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                        <div class="drop-list-select">
                                            <div class="item-select-field" data-value="15">15 minutes</div>
                                            <div class="item-select-field" data-value="10">10 minutes</div>
                                            <div class="item-select-field" data-value="5">5 minutes</div>
                                            <div class="item-select-field" data-value="3">3 minutes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-add-image">
                        <img class="preview-img" src="https://i.ytimg.com/vi/kC4Sj8NIq-g/maxresdefault.jpg" alt="" srcset="">
                            <div class="right-form-add-media">
                                <div class="part-input">
                                    <div class="label-ipt-field label-ipt-media">add Photo
                                    </div>
                                    <div class="form-ipt-field form-ipt-media">
                                        <input class="ipt-add-field ipt-url-img" type="text">
                                        <div class="btn-apply-media">Apply</div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script>

        $('.btn-navigate-main-vehicle').click(function() {
            window.location.href = "/vehicle/all-vehicle";
        });

        $('.btn_add_vehicle').click(function() {

            let listCompany = document.querySelector('.list-company');
            let listDriver = document.querySelector('.list-driver');

            let id_vehicle = $('#id_vehicle').val();
            let id_company = listCompany.options[listCompany.selectedIndex].getAttribute('id_company');
            let id_ud = listDriver.options[listDriver.selectedIndex].getAttribute('id_ud');
            let vehical_num = $('#vehical_num').val();


            if(vehical_num == '' || id_company == 0) {
                displayToast('Enter fully, Please !');
            } else {

                var form  = new FormData();
                form.append('id_vehicle', id_vehicle);
                form.append('vehical_num', vehical_num);
                form.append('id_company', id_company);
                form.append('id_ud', id_ud);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{URL::to("/vehicle/add-new-vehicle")}}',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        window.location.href = '{{URL::to("car/all-vehicle")}}';
                    },
                    error: function(data) {
                        displayToast(data.responseText);
                        console.log(data.responseText);
                    }
                });
            }

        });


    </script>

    <style>
        #news_image {
            display: none;
        }
        /* CSS */
        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FCFCFD;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: "JetBrains Mono",monospace;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            transition: box-shadow .15s,transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow,transform;
            font-size: 18px;
        }

        .button-30:focus {
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }


    </style>
    <script src="{{ asset('backend/js/vehicle/managerVehicle.js') }}"></script>

@endsection
