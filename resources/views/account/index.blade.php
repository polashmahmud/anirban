@extends('layouts.app')

@section('title', 'Account')

@push('header-script')
    <link href={{ asset("assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css") }} rel="stylesheet" />
    <link href={{ asset("assets/vendors/select2/dist/css/select2.min.css") }} rel="stylesheet" />
@endpush

@push('footer-script')
    <script src={{ asset("assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }} type="text/javascript"></script>
    <script src={{ asset("assets/vendors/select2/dist/js/select2.full.min.js") }} type="text/javascript"></script>
    <script type="text/javascript">
        $('#date_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy/mm/dd'
        });
        $(".select2_demo_1").select2();
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        @if($account->exists)
                           একাউন্ট এডিট করুন
                        @else
                            নতুন একাউন্ট যুক্ত করুন
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if($account->exists)
                        <form method="POST" action="{{ route('account.update', $account->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                    @else
                        <form action="{{ route('account.store') }}" method="POST">
                    @endif
                    @csrf

                        @if($account->exists)
                            <div class="form-group">
                                <label>সদস্য নাম</label>
                                <select class="form-control select2_demo_1" name="user_id">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($account->user_id == $user->id) selected @endif >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label>সদস্য নাম</label>
                                <select class="form-control select2_demo_1" name="user_id">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($account->exists)
                            <div class="form-group">
                                <label>প্যাকেজ</label>
                                <select class="form-control select2_demo_1" name="package_id">
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" @if($account->package_id == $package->id) selected @endif >{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label>প্যাকেজ</label>
                                <select class="form-control select2_demo_1" name="package_id">
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <div class="form-group">
                            <label>কিস্তির টাকার পরিমান</label>
                            <input class="form-control" type="number" placeholder="কিস্তির টাকার পরিমান" name="amount" value="{{ old('amount',$account->amount) }}">
                        </div>
                        @if($account->exists)
                            <div class="form-group" id="date_1">
                                <label class="font-normal">তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ $account->date }}" name="date" required>
                                </div>
                            </div>
                        @else
                            <div class="form-group" id="date_1">
                                <label class="font-normal">তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ date('Y/m/d') }}" name="date" required>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            @if($account->exists)
                                <button class="btn btn-default" type="submit">একাউন্ট এডিট করুন</button>
                                <a href="{{ route('account.index') }}" class="btn btn-primary">প্রস্তান</a>
                            @else
                                <button class="btn btn-default" type="submit">একাউন্ট যুক্ত করুন</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল একাউন্ট</div>
                </div>
                <div class="ibox-body">
                    @include('common.table')


                    {{ $accounts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection