@extends('cms.parent')
@section('title')
    Home
@endsection
@section('thePage','Home')
@section('content')

<div class="row">

    <div class="col-lg-3 col-6">

    <div class="small-box bg-info">
    <div class="inner">
    <h3>{{$categories_count}}</h3>
    <p>Categories</p>
    </div>
    <div class="icon">
    <i class="nav-icon fas fa-sitemap"></i>
    </div>
    <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-success">
    <div class="inner">
    {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
    <h3>{{$campaigns_count}}</h3>
    <p>Campaigns</p>
    </div>
    <div class="icon">
    <i class="nav-icon fas fa-heart"></i>
    </div>
    <a href="{{route('campaigns.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
    <div class="inner">
    <h3>{{$users_count}}</h3>
    <p>Users</p>
    </div>
    <div class="icon">
    <i class="nav-icon fas fa-user-alt"></i>
    </div>
    <a href="{{route('cms.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
    <div class="inner">
    <h3>{{$admins_count}}</h3>
    <p>Admins</p>
    </div>
    <div class="icon">
    <i class="nav-icon fas fa-user-alt"></i>
    </div>
    <a href="{{route('cms.admins')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    </div>
@endsection
