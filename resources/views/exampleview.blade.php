<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
@extends('layout.conquer')

@section('konten')

<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler">
        <i class="fa fa-gear"></i>
    </div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span>
                Theme Color </span>
            <ul>
                <li class="color-black current color-default tooltips" data-style="default"
                    data-original-title="Default">
                </li>
                <li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
                </li>
                <li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
                </li>
                <li class="color-red tooltips" data-style="red" data-original-title="Red">
                </li>
                <li class="color-light tooltips" data-style="light" data-original-title="Light">
                </li>
            </ul>
        </div>
        <div class="theme-option">
            <span>
                Layout </span>
            <select class="layout-option form-control input-small">
                <option value="fluid" selected="selected">Fluid</option>
                <option value="boxed">Boxed</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
                Header </span>
            <select class="header-option form-control input-small">
                <option value="fixed" selected="selected">Fixed</option>
                <option value="default">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
                Sidebar </span>
            <select class="sidebar-option form-control input-small">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
                Sidebar Position </span>
            <select class="sidebar-pos-option form-control input-small">
                <option value="left" selected="selected">Left</option>
                <option value="right">Right</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
                Footer </span>
            <select class="footer-option form-control input-small">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
    </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Dashboard <small>Toko Karya Sejahtera</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>

</div>
<img src="{{ asset('conquer/img/logo.jpg') }}" alt="" style="max-width:100%; height:auto;">
<!-- END PAGE HEADER-->
<!-- BEGIN OVERVIEW STATISTIC BARS-->
<div class="row stats-overview-cont"></div>
<!-- END OVERVIEW STATISTIC BARS-->
<div class="clearfix">
</div>

<!-- BEGIN OVERVIEW STATISTIC BLOCKS-->

<!-- END OVERVIEW STATISTIC BLOCKS-->
<div class="clearfix">
</div>

@endsection
