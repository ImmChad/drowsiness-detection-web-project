@extends('Backend.index')
@section('contentAdmin')

    <style>
        .section-info-media::-webkit-scrollbar-thumb {
            background-color: #0e5904;
            border-radius: 6px;
        }
        .section-info-media::-webkit-scrollbar {
            width: 8px;
        }
        .section-info-media
        {
            width: 70%;
            min-height: 70%;
            overflow: auto;
            max-height: 95%;
        }
        .part-input.time-rest
        {
            display: flex;
            justify-content: space-between;
        }
        .mess-media
        {
            display: flex;
            width: 100%;
            height: 100%;
            font-size: 40px;
            justify-content: center;
            align-items: center;
        }
        .section-info-media {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .form-update-image, .form-update-video {
            width: 100%;
        }
    </style>
    <div class="section-update-video">
        <div class="card-title" style="display: flex;justify-content: space-between">
            <div class=" col-sm-7" style="font-size: 30px; font-weight: 900;">
                All Videos
            </div>
            <div class="col-sm-5" style="display: flex; justify-content: flex-end;">
                <button style="display: none" class="button-ads btn-all-photos" style="margin-right: 0.5rem;">
                    All Photos
                </button>
                <button class="button-ads btn-add-media-ads">
                    Add Media
                </button>
            </div>
        </div>
        <div class="body-update-video ">
            <div class="form-update-all">
                <div class="section-info-base">
                    <div class="row" style="font-size: 22px; font-weight: 900; margin-bottom: 0.5rem;">
                        Choose a group of vehicle:
                    </div>
                    <div class="row" style="height: 350px; width: 250px; justify-content: center;">
                        <div class="col-md-12" style="width: 100%; height: 100%; border: 5px solid #0e5904; border-radius: 20px; padding: 0px !important; overflow: hidden;">
                            <div class="scroll-div-all-group" style="display: flex; width: 100%; height: 100%; flex-direction: column; justify-content: flex-start; align-items: flex-start;   font-size: 20px; overflow-y: scroll;">
                                <span class="choose-group-company" style="width: 100%; font-weight: 700; color: #0e5904; cursor: pointer;" company_id="0">&nbsp;All</span>
                                @foreach($dataCompany as $subListDataCompany)
                                    @if($subListDataCompany->parent_id == 0)
                                        <span class="choose-group-company" style="width: 100%; font-weight: 700; color: #0e5904; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}">&nbsp;{{ $subListDataCompany->company_group }}</span>
                                    @else
                                        <span class="choose-group-company" style="width: 100%; font-weight: 450; color: #0e5904; cursor: pointer;" company_id="{{ $subListDataCompany->company_id }}">&nbsp;&nbsp; {{ $subListDataCompany->company_group }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-info-media">
                    @if(count($companyMedias['videos'])>0)
                        @foreach($companyMedias['videos'] as $companyVideo)
                            <div class="form-update-video">
                                {{-- <video class ="preview-video"src="https://drive.google.com/uc?export=view&id=1ncjsdmFYV9WKawcEfYAYvce4rf8lsgL_" controls muted></video> --}}
                                <video class ="preview-video" src="{{$companyVideo['detail']['video_path']}}" controls muted></video>

                                <div class="right-form-update-media">
                                    <div class="part-input">
                                        <div class="label-ipt-field label-ipt-media">Video Name: {{$companyVideo['detail']['video_name']}}</div>
                                        <div class="form-ipt-field form-ipt-media" >
                                            <input class="ipt-update-field ipt-url-video"
                                                   value="{{$companyVideo['detail']['video_path']}}"
                                                   id="video_path" type="text" placeholder="Enter link video ..." disabled>
                                        </div>
                                    </div>

                                    <div class="part-input time-rest">
                                        <div class="label-ipt-field label-ipt-media">Time Rest</div>
                                        <div class="form-ipt-field form-ipt-media">
                                            <div class="ipt-update-field select-update-field">
                                                <div class="value-select-update-field" data-value="15" style="display: flex; justify-content: center; align-items: center;">
                                                    {{$companyVideo['change_time']}} minutes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mess-media">
                            No videos yet!!!
                        </div>
                    @endif
                    @if(count($companyMedias['photos'])>0)
                        @foreach($companyMedias['photos'] as $companyPhoto)
                            <div class="form-update-image">
                                {{-- <img class="preview-img" src="https://i.ytimg.com/vi/kC4Sj8NIq-g/maxresdefault.jpg" alt="" srcset=""> --}}
                                <img class="preview-img" src="{{$companyPhoto['detail']['photo_path']}}" alt="" srcset="">
                                <div class="right-form-update-media" style="    display: flex;
                                    flex-direction: column;
                                    align-items: flex-end;">
                                    <div class="part-input">
                                        <div class="label-ipt-field label-ipt-media">Name Photo: {{$companyPhoto['detail']['photo_name']}}
                                        </div>
                                        <div class="form-ipt-field form-ipt-media">
                                            <input class="ipt-update-field ipt-url-img" value="{{$companyPhoto['detail']['photo_path']}}" id="photo_path" type="text" placeholder="Enter link image ..." disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mess-media">
                            No photos yet!!!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>

    <script>

        $('.btn-all-photos').click(function() {
            window.location.href = "/video/list-company-photo";
        });

        $('.btn-add-media-ads').click(function() {
            window.location.href = "/video/add-video";
        });
        const itemCompanies =  document.querySelectorAll('.choose-group-company')

        itemCompanies.forEach(itemCompany=>{
                itemCompany.addEventListener('click',(event)=>{
                    location.href = `/video/list-company-video/${event.currentTarget.getAttribute('company_id')}`
                })
        })

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

    <style>

        .section-update-video
        {
            width: 95%;
            height: 85%;
            padding: 10px 0px;

        }
        .header-update-video {
            display: flex;
            height: 20%;
            align-items: center;
            margin: 0px 40px;
            position: relative;
            margin-top: -10px;
        }
        .body-update-video
        {
            height: 85%;
            box-shadow: 1px 1px 8px 1px grey;
            min-width: 100%;
            border-radius: 12px;
        }
        .btn-update-video
        {
            background: #0e5904;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            width: max-content;
            position: absolute;
            right: 0;
            padding: 5px 20px;
            font-size: 20px;
            cursor: pointer;
        }
        .name-video
        {
            color: black;
            font-weight: bold;
            font-size: 40px;
            margin-left: 20px;

        }
        .btn-navigate-main-video *,.btn-navigate-main-video *:hover
        {
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            color: #0e5904!important;
        }
        .form-update-all {
            display: flex;
            justify-content: space-between;
            height: 100%;
            padding: 40px;
        }

        .form-ipt-field,.ipt-update-field
        {
            font-weight: 600;
        }
        .section-info-base
        {
            width: 30%;
            height: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        .section-info-media
        {
            width: 70%;
            min-height: 70%;
        }
        .preview-img,.preview-video
        {
            width: 270px;
            height: 165px;
            background: black;
            border-radius: 20px;
        }

        .preview-img {
            object-fit: cover;
        }

        .form-update-image,.form-update-video
        {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 20px;
        }
        .right-form-update-media
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
            height: 35px;
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
            display: flex;
            align-items: center;
        }
        .ipt-update-field
        {
            outline: none;
            border-radius: 20px;
            border: 3px solid #0e5904;
            padding: 0 20px;
        }
        .form-ipt-media .ipt-update-field
        {
            min-width: 400px;
        }
        .form-ipt-text .ipt-update-field
        {
            min-width: 300px;
        }
        .select-update-field
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
        }

        .drop-list-select::-webkit-scrollbar
        {
            width: 6px;
        }
        .drop-list-select::-webkit-scrollbar-track {
            /* background-color: rgb(253, 162, 162); */
        }

        .drop-list-select::-webkit-scrollbar-thumb {
            background-color: #0e5904 ;
            border-radius: 6px;
        }


        .item-select-update-field
        {

            cursor: pointer;
            width: max-content;

        }


        .scroll-div-all-group::-webkit-scrollbar {
            display: none;
        }

        .choose-group-company.active,.choose-group-company[company_id='{{($companySelectedID)}}'] {
            background-color: #0e5904;
            color: #fff !important;
        }

        .table-bordered thead tr th:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }
        .table-bordered thead tr th:last-child {
            border-radius: 0px 20px 20px 0px;
        }


        .table-parent-div::-webkit-scrollbar-track-piece:start {
            margin-top: 50px;
        }

        .row_data_news {
            cursor: pointer;
        }


    </style>

@endsection
