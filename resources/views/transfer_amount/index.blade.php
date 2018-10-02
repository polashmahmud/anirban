@extends('layouts.app')

@section('title', 'Transfer Amount')

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
                        @if($transferAmount->exists)
                            টাকা ট্রান্সফার এডিট করুন
                        @else
                            টাকা ট্রান্সফার
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if($transferAmount->exists)
                        <form method="POST" action="{{ route('transfer-amount.update', $transferAmount->id) }}">
                            @method('PATCH')
                    @else
                        <form action="{{ route('transfer-amount.store') }}" method="POST">
                    @endif
                    @csrf

                        @if($transferAmount->exists)
                            <div class="form-group">
                                <label>টাকা দিবেন</label>
                                <select class="form-control select2_demo_1" name="user_from">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label>টাকা দিবেন</label>
                                <select class="form-control select2_demo_1" name="user_from">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($transferAmount->exists)
                            <div class="form-group">
                                <label>টাকা পাবেন</label>
                                <select class="form-control select2_demo_1" name="user_to">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label>টাকা পাবেন</label>
                                <select class="form-control select2_demo_1" name="user_to">
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>টাকার পরিমান</label>
                            <input class="form-control" type="number" placeholder="টাকার পরিমান" name="amount" value="{{ old('amount',$transferAmount->amount) }}">
                        </div>

                        @if($transferAmount->exists)
                            <div class="form-group" id="date_1">
                                <label class="font-normal">তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ $transferAmount->date }}" name="date" required>
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
                            @if($transferAmount->exists)
                                <button class="btn btn-default" type="submit">টাকা ট্রান্সফার এডিট করুন</button>
                                <a href="{{ route('transfer-amount.index') }}" class="btn btn-primary">প্রস্তান</a>
                            @else
                                <button class="btn btn-default" type="submit">টাকা ট্রান্সফার যুক্ত করুন</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল ট্রান্সফার</div>
                </div>
                <div class="ibox-body">
                    @include('common.table')


                    {{ $transferAmounts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection