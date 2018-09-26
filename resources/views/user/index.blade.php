@extends('layouts.app')

@section('title', 'Dashboard')

@push('header-script')
    <link href={{ asset("assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css") }} rel="stylesheet" />
@endpush

@push('footer-script')
    <script src={{ asset("assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }} type="text/javascript"></script>
    <script src={{ asset("assets/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js") }} type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('#ex-phone2').mask('88 01999 999 999');
        });
        $('#date_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        @if($user->exists)
                           সদস্য ইডিট করুন
                        @else
                            নতুন সদস্য যুক্ত করুন
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if($user->exists)
                        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                    @else
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                    @csrf
                        <div class="form-group">
                            <label>নাম</label>
                            <input class="form-control" type="text" placeholder="নাম" name="name" value="{{ old('name',$user->name) }}" required>
                        </div>
                        @if($user->exists)
                            <div class="form-group" id="date_1">
                                <label class="font-normal">যোগদানের তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ $user->join }}" name="join" required>
                                </div>
                            </div>
                        @else
                            <div class="form-group" id="date_1">
                                <label class="font-normal">যোগদানের তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ date('Y/m/d') }}" name="join" required>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>ইমেল</label>
                            <input class="form-control" type="text" placeholder="ইমেল" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label>মোবাইল নম্বর</label>
                            <input class="form-control" id="ex-phone2" type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        @if($user->exists)
                            <div class="form-group">
                                <label>পাসওয়ার্ড</label>
                                <input class="form-control" type="password" placeholder="পাসওয়ার্ড" name="password">
                            </div>
                        @else
                            <div class="form-group">
                                <label>পাসওয়ার্ড</label>
                                <input class="form-control" type="password" placeholder="পাসওয়ার্ড" name="password" required>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>ছবি</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                        @if($user->exists)
                            <div class="form-group">
                                <label>Role</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="role" value="0" @if($user->role == 0) checked @endif >
                                                <span class="input-span"></span>User
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="role" value="1" @if($user->role == 1) checked @endif>
                                                <span class="input-span"></span>Member
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-danger">
                                                <input type="radio" name="role" value="2" @if($user->role == 2) checked @endif>
                                                <span class="input-span"></span>Admin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Role</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="role" value="0" checked="">
                                                <span class="input-span"></span>User
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="role" value="1">
                                                <span class="input-span"></span>Member
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-danger">
                                                <input type="radio" name="role" value="2">
                                                <span class="input-span"></span>Admin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($user->exists)
                            <div class="form-group">
                                <label>Status</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="status" value="1" @if($user->status == 1) checked @endif>
                                                <span class="input-span"></span>Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="0" @if($user->status == 0) checked @endif>
                                                <span class="input-span"></span>Suspend
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Status</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="status" value="1" checked="">
                                                <span class="input-span"></span>Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="0">
                                                <span class="input-span"></span>Suspend
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <button class="btn btn-default" type="submit">সদস্য যুক্ত করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল সদস্য</div>
                </div>
                <div class="ibox-body">
                    @include('common.table')
                </div>
            </div>
        </div>
    </div>
@endsection