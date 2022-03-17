<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }} - {{ $offer->title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Gallet CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
        
        <style>
            html {
                scroll-behavior: smooth;
            }
            body {
                font-family: 'Nunito';
                background-color: #f5f3f3;
            }
            .card, .details-card, .bg-white {
                background-color: #ffffff!important;
                border-radius: 15px!important;
            }
            #mainCarousel {
                max-width: 100%;
                margin: auto;

                --carousel-button-color: #170724;
                --carousel-button-bg: #fff;
                --carousel-button-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
                    0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);

                --carousel-button-svg-width: 20px;
                --carousel-button-svg-height: 20px;
                --carousel-button-svg-stroke-width: 2.5;
            }

            #mainCarousel .carousel__slide {
                width: 100%;
                padding: 0;
                max-height: 600px;
                overflow-y: hidden;
                display: flex;
                align-content: middle;
                justify-content: center
            }
            
            #mainCarousel .carousel__slide img {
                object-fit: cover;
            }

            #mainCarousel .carousel__button.is-prev {
                left: -1.5rem;
            }

            #mainCarousel .carousel__button.is-next {
                right: -1.5rem;
            }
            
            @media only screen and (max-width: 600px) {
                
                #mainCarousel .carousel__button.is-prev {
                    left: 10px;
                }

                #mainCarousel .carousel__button.is-next {
                    right: 10px;
                }
            }

            #mainCarousel .carousel__button:focus {
                outline: none;
                box-shadow: 0 0 0 4px #3B90D3;
            }

            #thumbCarousel .carousel__slide {
                opacity: 0.5;
                padding: 0;
                margin: 0.25rem;
                width: 96px;
                height: 64px;
            }

            #thumbCarousel .carousel__slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 5px;
            }

            #thumbCarousel .carousel__slide.is-nav-selected {
                opacity: 1;
            }
            .border-carousell {
                /* border: 1px solid #3B90D3; */
                border-radius: 6px;
                box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            }
            img {
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
            }
            .details-card {
                box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
                padding: 20px;
                border-radius: 5px;
            }
            a {
                color: #3B90D3;
            }
            .play-video-poster {
                height: 50px!important;
                width: 100px!important;
            }
            
            .fancybox__button--thumbs {
                display: none;
            }
            .cursor-pointer {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container mt-2">
            <br>
            <div style="max-width: 300px;" class="m-auto">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
            </div>
            <br>
            <div class="w-100 m-auto">
                <div class="row d-flex align-items-stretch justify-content-between">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="bg-white pt-4 pb-4 p-2 pl-lg-5 pr-lg-5 border-carousell h-100">
                            <h3 class="mb-3">
                                <b>{{ $offer->title }}</b>
                            </h3>
                            
                            <div id="mainCarousel" class="carousel w-10/12 max-w-5xl mx-auto cursor-pointer">
                                
                                @if($offer->video && $offer->video->getFullUrl())
                                    <div class="carousel__slide"
                                        data-src="{{ $offer->video->getFullUrl() }}"
                                        data-fancybox="gallery">
                                        <video controls="true" class="w-100">
                                            <source src="{{ $offer->video->getFullUrl() }}" type="video/mp4" />
                                            Video cannot be played
                                        </video>
                                    </div>
                                @elseif($offer->video_url)
                                    {{-- <div class="carousel__slide" data-fancybox="gallery">
                                        <iframe src="{{ $offer->video_url }}" class="h-100 w-100" allow="fullscreen;">
                                            Video cannot be played
                                        </iframe>
                                    </div> --}}
                                    {{-- example --}}
                                    {{-- <a class="carousel__slide w-100 h-100" data-fancybox="gallery" href="https://www.youtube.com/watch?v=z2X2HaTvkl8">
                                        <img src="http://i3.ytimg.com/vi/z2X2HaTvkl8/hqdefault.jpg" class="w-100 h-100" />
                                    </a> --}}
                                    
                                      <a class="carousel__slide w-100 h-100" data-fancybox="gallery" href="{{ $offer->video_url }}">
                                        @php
                                            $videoCode = substr($offer->video_url, strpos($offer->video_url, "?v=") + 3);
                                        @endphp
                                        @if($videoCode)
                                            <img src="http://i3.ytimg.com/vi/{{$videoCode}}/hqdefault.jpg" class="w-100 h-100" />
                                        @endif
                                      </a>
                                @endif
                                
                                {{-- <div class="carousel__slide" data-fancybox="gallery" 
                                    data-src="{{ $offer->video->getFullUrl() }}">

                                    <video controls="true" class="w-100 h-100">
                                        <source src="{{ $offer->video->getFullUrl() }}" type="video/mp4" />
                                        Video cannot be played
                                    </video>
                                </div> --}}
                                
                                {{-- <div class="carousel__slide"
                                    data-src="{{  $offer->video->getFullUrl() }}"
                                    data-fancybox="gallery">
                                    <img class="w-100" src="{{  $offer->video->getFullUrl() }}" />
                                </div> --}}
                                
                                @foreach ($offer->image as $image)
                                    <div class="carousel__slide"
                                        data-src="{{ $image->getFullUrl() }}"
                                        data-fancybox="gallery">
                                        <img class="w-100" src="{{ $image->getFullUrl() }}" />
                                    </div>
                                @endforeach
                            </div>
                            
                            <div id="thumbCarousel" class="carousel max-w-xl mx-auto mt-2 mb-1">
                                
                                @if($offer->video && $offer->video->getFullUrl())
                                    <div class="carousel__slide">
                                        <img class="panzoom__content play-video-image" src="/images/video-poster.png" />
                                    </div>
                                @elseif($offer->video_url)
                                    <div class="carousel__slide">
                                        <img class="panzoom__content play-video-image" src="/images/video-poste-yt.png" />
                                    </div>
                                @endif
                                
                                @foreach ($offer->image as $image)
                                    <div class="carousel__slide">
                                        <img class="panzoom__content" src="{{ $image->getFullUrl() }}" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 d-none d-lg-block">
                        <div class="details-card h-100">
                            <h4 class="mt-1">
                                Some tehnical details
                            </h4>
                            
                            <table class="table table-bordered mb-0 mt-3">
                                <tbody>
                                    @foreach ($offer->offerOfferFields->take(8) as $key => $offerFields)
                                        <tr>
                                            <th>
                                                {{ $offerFields->field->name }}
                                            </th>
                                            <td>
                                                {{ $offerFields->value }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($offer->offerOfferFields) > 6)
                                <div class="text-center mt-3">
                                    <a href="#allTehnicalDetails">
                                        <i class="fas fa-arrow-down"></i>
                                        View all details (+{{ count($offer->offerOfferFields)-7 }})
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div> --}}
                </div>
            </div>
            
            <div id="allTehnicalDetails" class="w-100 mt-5">
                <div class="details-card h-100">
                    <h4 class="mt-1">
                        Tehnical details
                    </h4>
                    
                    <table class="table table-bordered mb-0 mt-3">
                        <tbody>
                            @foreach ($offer->offerOfferFields as $key => $offerFields)
                                <tr>
                                    <th>
                                        {{ $offerFields->field->name }}
                                    </th>
                                    <td>
                                        {{ $offerFields->value }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="details-card mt-5 mb-5">
                <h5 class="w-100">
                   Description
                </h5>
                <hr>
                
                <div class="w-100">
                    {!! $offer->description !!}
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <!-- Gallet CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        
        <script>
            
            // Initialise Carousel
            const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
                Dots: false,
            });

            // Thumbnails
            const thumbCarousel = new Carousel(document.querySelector("#thumbCarousel"), {
                Sync: {
                    target: mainCarousel,
                    friction: 0,
                },
                Dots: false,
                Navigation: false,
                center: true,
                slidesPerPage: 1,
                infinite: false,
            });

            // Customize Fancybox
            Fancybox.bind('[data-fancybox="gallery"]', {
                Thumbs: {
                    autoStart: false,
                },
                Carousel: {
                    on: {
                        change: (that) => {
                            mainCarousel.slideTo(mainCarousel.findPageForSlide(that.page), {
                                friction: 0,
                            });
                        },
                        init: ( instance ) => {
                           console.log(instance);
                        }
                    },
                }
            });
            // Fancybox.bind('[data-fancybox="gallery"]', {
            //     {
            //         src: "https://www.youtube.com/watch?v=z2X2HaTvkl8",
            //         thumb: "http://i3.ytimg.com/vi/z2X2HaTvkl8/hqdefault.jpg",
            //     },
            // });
        </script>
    </body>
</html>
