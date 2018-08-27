@extends('laraflat::admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('laraflat::laraflat.Laraflat Import')
            <small>
                @lang('laraflat::laraflat.Here you Can Upload any module you generated with laraflat')
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('laraflat::laraflat.Home')</a></li>
            <li><a class="active"> @lang('laraflat::laraflat.Laraflat Import')</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            <h4> @lang('laraflat::laraflat.Laraflat Import') !</h4>
            <p>@lang('laraflat::laraflat.Here you Can Upload any module you generated with laraflat')</p>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('laraflat::laraflat.Laraflat Import')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            {!! Form::open(['route' => 'post-import', 'role' => 'form' , 'files' => true]) !!}
                <div class="box-body">
                    @include('laraflat::fileds.php.file' , ['name' => 'module' , 'value' => ''])
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {!! Form::submit(trans('laraflat::laraflat.Save') , ['class' => 'btn btn-info']) !!}
                </div>
            {!! Form::close() !!}
        <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
@endsection