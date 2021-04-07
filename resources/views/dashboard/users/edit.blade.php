@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="text" name="name" class="form-control" placeholder="@lang('site.name')" value="{{ $user->name }}">
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
                                    <input type="text" name="address" class="form-control" placeholder="@lang('site.address')" value="{{ $user->address }}">
                                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('address') : '' }}</div>
                                </div>

                                <!-- Birthday Input -->
                                <div class="form-group has-feedback">
                                    <input type="date" name="birthday" class="form-control" placeholder="@lang('site.birthday')" style="line-height: 17px;" value="{{ $user->birthday }}">
                                    <span class="glyphicon glyphicon-heart form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('birthday') : '' }}</div>
                                </div>

                                <!-- Gender Input -->
                                <div class="form-group has-feedback">
                                    <label for="gender">@lang('site.gender')</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }} >Female</option>
                                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('gender') : '' }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Email Input -->
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('site.email')" value="{{ $user->email }}">
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
                                    <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')" value="{{ $user->phone }}">
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
                                        <option value="single" {{ $user->status == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="in relation" {{ $user->status == 'in relation' ? 'selected' : '' }}>In Relation</option>
                                        <option value="married" {{ $user->status == 'married' ? 'selected' : '' }}>Married</option>
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('status') : '' }}</div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <img src="{{ $user->image_path }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
                                </div>
                            </div>
                        </div>

                        <!-- Role Input -->
                        <div class="form-group has-feedback">
                            <label for="type">@lang('site.role')</label>
                            <select name="role" id="type" class="form-control">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->all() ? $errors->first('role') : '' }}</div>
                        </div>

                        <!-- permissions Input -->
                        <div class="form-group" id="permissions">
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
                                                {{--create_users--}}
                                                <label><input type="checkbox" name="permissions[]" {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }} value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                            @endforeach

                                        </div>

                                    @endforeach
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('permissions') : '' }}</div>
                                </div><!-- end of tab content -->

                            </div><!-- end of nav tabs -->

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
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
            if($('#type').val() === 'admin'){
                $("input[type=checkbox]").removeAttr("disabled");
                $('#permissions').slideDown(450);
            }else if($('#type').val() === 'user'){
                $('#permissions').slideUp(450);
            }

            $('#type').change(function(){
                if($(this).val() === 'admin'){
                    $("input[type=checkbox]").removeAttr("disabled");
                    $('#permissions').slideDown(450);
                }else if($(this).val() === 'user'){
                    $('#permissions').slideUp(450);
                }
            });

            $('form').on('submit', function(e){
                if($('#type').val() === 'user')
                {
                    $("input[type=checkbox]").prop('checked', false).attr("disabled", 'disabled');
                }
            });
        })
    </script>
@endpush
