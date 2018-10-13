@extends('laraflat::admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('laraflat::laraflat.build menu')
            <small>
                @lang('laraflat::laraflat.Here you Can build your menu')
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('laraflat::laraflat.Home')</a></li>
            <li><a class="active"> @lang('laraflat::laraflat.menu builder')</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="callout callout-info">
            <h4> @lang('laraflat::laraflat.menu controller') !</h4>
            <p> @lang('laraflat::laraflat.Here you Can control your menu')</p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('laraflat::laraflat.add item')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    {!! Form::open(['route' => 'itmes.store', 'role' => 'form']) !!}
                        <div class="box-body">
                            @include('laraflat::fileds.php.text' , ['name' => 'name_ar' , 'label' => trans('laraflat::laraflat.Item name Arabic')])
                            @include('laraflat::fileds.php.text' , ['name' => 'name_en' , 'label' => trans('laraflat::laraflat.Item name English')])
                            @include('laraflat::fileds.php.text' , ['name' => 'icon' , 'label' => trans('laraflat::laraflat.icon') , 'placeholder' => '<i class="fa fa-trash"></i>'])
                            @include('laraflat::fileds.php.text' , ['name' => 'link' , 'label' => trans('laraflat::laraflat.link')])
                            @include('laraflat::fileds.php.select' , ['name' => 'parent_id' , 'label' => trans('laraflat::laraflat.Parent Item') , 'array' => [ 0 => trans('laraflat::laraflat.No parent menu')] + $parents])
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            {!! Form::submit(trans('laraflat::laraflat.Save') , ['class' => 'btn btn-info']) !!}
                        </div>
                     {!! Form::close() !!}
                <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('laraflat::laraflat.menu builder') {{ $menu->name }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <table class="table table-borderd table-stripped">
                        @foreach($menu->items as $item)
                            <tr>
                                <td>
                                    {{ $item->name_ar }}
                                </td>
                                <td>
                                    {{ $item->name_en }}
                                </td>
                                <td>
                                    {!! Form::open(['route' => [ 'itmes.destroy' , $item->id], 'role' => 'form' , 'class' => 'form-inline']) !!}
                                        {{ method_field('delete') }}
                                        <button  class="btn btn-danger" ><i class="fa fa-trash"></i></button>
                                        <span class="btn btn-success" onclick="showEditForm(this)"><i class="fa fa-edit"></i></span>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <tr style="display: none">
                                <td colspan="4">
                                    {!! Form::model( $item , ['route' => ['itmes.update' , $item->id ], 'role' => 'form']) !!}
                                    {{ method_field('patch') }}
                                    <div class="box-body">
                                        @include('laraflat::fileds.php.text' , ['name' => 'name_ar' , 'value' => $item->name_ar , 'label' => trans('laraflat::laraflat.Item name Arabic')])
                                        @include('laraflat::fileds.php.text' , ['name' => 'name_en' , 'value' => $item->name_en , 'label' => trans('laraflat::laraflat.Item name English')])
                                        @include('laraflat::fileds.php.text' , ['name' => 'icon' , 'value' => $item->icon , 'label' => trans('laraflat::laraflat.icon'), 'placeholder' => '<i class="fa fa-trash"></i>'])
                                        @include('laraflat::fileds.php.text' , ['name' => 'link', 'value' => $item->link  , 'label' => trans('laraflat::laraflat.link')])
                                        @include('laraflat::fileds.php.select' , ['name' => 'parent_id', 'value' => $item->parent_id  ,  'label' => trans('laraflat::laraflat.Parent Item') , 'array' => [ 0 => trans('laraflat::laraflat.No parent menu')] + array_except( $parents, $item->id)])
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        {!! Form::submit(trans('laraflat::laraflat.Save') , ['class' => 'btn btn-info']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
    <script>
        function showEditForm(e) {
            $(e).closest('tr').next('tr').toggle(1000);
        }
    </script>
@endpush
