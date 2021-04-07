@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="text" name="name" class="form-control" placeholder="@lang('site.name')">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('name') : '' }}</div>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('site.password')">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('password') : '' }}</div>
                                </div>

                                <!-- Address Input -->
                                <div class="form-group has-feedback">
                                    <input type="text" name="address" class="form-control" placeholder="@lang('site.address')">
                                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('address') : '' }}</div>
                                </div>

                                <!-- Birthday Input -->
                                <div class="form-group has-feedback">
                                    <input type="date" name="birthday" class="form-control" placeholder="@lang('site.birthday')" style="line-height: 17px;">
                                    <span class="glyphicon glyphicon-heart form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('birthday') : '' }}</div>
                                </div>

                                <!-- Gender Input -->
                                <div class="form-group has-feedback">
                                    <label for="gender">@lang('site.gender')</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('gender') : '' }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Email Input -->
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('email') : '' }}</div>
                                </div>

                                <!-- Confirmed Password Input -->
                                <div class="form-group has-feedback">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('site.password_confirmation')">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('password_confirmation') : '' }}</div>
                                </div>

                                <!-- Phone Input -->
                                <div class="form-group has-feedback">
                                    <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')">
                                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('phone') : '' }}</div>
                                </div>

                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <input type="file" name="image" class="form-control image" placeholder="@lang('site.image')">
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                </div>

                                <!-- Status Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.status')</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="single">Single</option>
                                        <option value="in relation">In Relation</option>
                                        <option value="married">Married</option>
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('status') : '' }}</div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <img src="{{ asset('uploads/users_images/default.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
                                </div>
                            </div>
                        </div>

                        <!-- Role Input -->
                        <div class="form-group has-feedback">
                            <label for="type">@lang('site.type')</label>
                            <select name="role" id="type" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->all() ? $errors->first('role') : '' }}</div>
                        </div>

                        <!-- Permissions Inputs -->
                        <div class="form-group" id="permissions">
                            <!-- Permissions -->
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

                                @php
                                    $models = ['dashboard', 'users', 'categories', 'courses', 'videos', 'posts', 'sliders'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                            @endforeach

                                        </div>

                                    @endforeach
                                </div><!-- end of tab content -->
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('permissions') : '' }}</div>

                            </div><!-- end of nav tabs -->

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#type').change(function(){
                if($(this).val() === 'admin'){
                    $('#permissions').slideDown(450);
                }else if($(this).val() === 'user'){
                    $('#permissions').slideUp(450);
                }
            });

            $('form').on('submit', function() {
                if($('#type').val() == 'user'){
                    $("input[type=checkbox]").prop('checked', false).attr("disabled", 'disabled');
                }
            });
        })
    </script>
@endpush
