@extends('master')
@section('content')
<div class="fullwidthbanner">
    <div class="bannercontainer">
        <div class="banner">
            <section id="slider"><!--slider-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($slide as $index => $slideItem)
                                    <li data-target="#slider-carousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($slide as $index => $slideItem)
                                    <div class="item {{ $index === 0 ? 'active' : '' }}">
                                        <div class="col-sm-12">
                                            <img src="source/image/slide/{{ $slideItem->image }}" class="girl img-responsive" alt="" />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#slider-carousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a style="padding-top:-20px" class="right carousel-control" href="#slider-carousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/slider-->
        </div>
    </div>
    <div class="tp-bannertimer"></div>
</div>
<!--slider-->
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>New Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">438 styles found {{count($new_product)}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <br> <br>
                        <div class="row">
                            @foreach($new_product as $new)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($new->promotion_price!=0)
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon-sale">I love you</div>
                                    </div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="product.html"><img src="source/image/product/{{$new->image}}" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$new-> name}}</p>
                                        <p class="single-item-price">
                                            @if($new->promotion_price==0)
                                            <span class="flash-sale">{{$new-> unit_price}} đồng</span>
                                            @endif
                                            <span class="flash-del">{{$new-> unit_price}} đồng</span>
                                            <span class="flash-sale">{{$new-> promotion_price}} đồng</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div>
    @php $gio = gmdate("H", time() + 3600*7); @endphp
    @if($gio < 12) Chào buổi sáng @elseif($gio < 18) Chào buổi chiều @else Chào buổi tối <!-- {{$gio}} -->
<!-- @endif -->
<!-- </div> -->
<!-- <div>
    @php
    $dayOfWeek = \Carbon\Carbon::now()->dayOfWeek;
    switch ($dayOfWeek) {
    case 0:
    echo 'Hôm nay là Chủ nhật';
    break;
    case 1:
    echo 'Hôm nay là Thứ 2';
    break;
    case 2:
    echo 'Hôm nay là Thứ 3';
    break;
    case 3:
    echo 'Hôm nay là Thứ 4';
    break;
    case 4:
    echo 'Hôm nay là Thứ 5';
    break;
    case 5:
    echo 'Hôm nay là Thứ 6';
    break;
    default:
    echo 'Hôm nay là Thứ 7';
    break;
    }
    @endphp
</div> -->
<!-- <div>
    @php

    @endphp
</div> -->
@endsection