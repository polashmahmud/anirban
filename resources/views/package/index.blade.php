@extends('layouts.app')

@section('title', 'Package')

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
                        @if($package->exists)
                           প্যাকেজ এডিট করুন
                        @else
                            নতুন প্যাকেজ যুক্ত করুন
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if($package->exists)
                        <form method="POST" action="{{ route('package.update', $package->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                    @else
                        <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                    @csrf
                        <div class="form-group">
                            <label>নাম</label>
                            <input class="form-control" type="text" placeholder="নাম" name="name" value="{{ old('name',$package->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>বর্ণনা</label>
                            <textarea class="form-control" rows="3" name="description">{{ old('description',$package->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>শুরুর টাকার পরিমান</label>
                                        <input class="form-control" type="number" placeholder="শুরুর টাকার পরিমান" name="start_amount" value="{{ old('start_amount',$package->start_amount) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>শেষ টাকার পরিমান</label>
                                        <input class="form-control" type="number" placeholder="শেষ টাকার পরিমান" name="end_amount" value="{{ old('end_amount',$package->end_amount) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>কিস্তি টাকা</label>
                                        <input class="form-control" type="number" placeholder="মোট সময়" name="collection_amount" value="{{ old('collection_amount',$package->collection_amount) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>মোট সময় (দিন/সপ্তাহ/মাস)</label>
                                        <input class="form-control" type="number" placeholder="মোট সময়" name="installment" value="{{ old('installment',$package->installment) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($package->exists)
                            <div class="form-group">
                                <label>প্যাকেজ টাইপ</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="type" value="0" @if($package->type == 0) checked @endif >
                                                <span class="input-span"></span>লোন
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="type" value="1" @if($package->type == 1) checked @endif>
                                                <span class="input-span"></span>সঞ্চয়
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-danger">
                                                <input type="radio" name="type" value="2" @if($package->type == 2) checked @endif>
                                                <span class="input-span"></span>ইনভেস্টমেন্ট
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>প্যাকেজ টাইপ</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="type" value="0" checked>
                                                <span class="input-span"></span>লোন
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="type" value="1">
                                                <span class="input-span"></span>সঞ্চয়
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-danger">
                                                <input type="radio" name="type" value="2">
                                                <span class="input-span"></span>ইনভেস্টমেন্ট
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($package->exists)
                            <div class="form-group">
                                <label>প্যাকেজ ধরন</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="period" value="0" @if($package->period == 0) checked @endif>
                                                <span class="input-span"></span>দৈনিক
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="period" value="1" @if($package->period == 1) checked @endif>
                                                <span class="input-span"></span>সাপ্তাহিক
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="period" value="2" @if($package->period == 2) checked @endif>
                                                <span class="input-span"></span>মাসিক
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>প্যাকেজ ধরন</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="period" value="0" checked >
                                                <span class="input-span"></span>দৈনিক
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="period" value="1">
                                                <span class="input-span"></span>সাপ্তাহিক
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="period" value="2">
                                                <span class="input-span"></span>মাসিক
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($package->exists)
                            <div class="form-group">
                                <label>স্টাটার্স</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="1" @if($package->status == 1) checked @endif>
                                                <span class="input-span"></span>একটিভ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="0" @if($package->status == 0) checked @endif>
                                                <span class="input-span"></span>ডিএকটিভ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>স্টাটার্স</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="1" checked >
                                                <span class="input-span"></span>একটিভ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="status" value="0">
                                                <span class="input-span"></span>ডিএকটিভ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            @if($package->exists)
                                <button class="btn btn-default" type="submit">প্যাকেজ এডিট করুন</button>
                                <a href="{{ route('package.index') }}" class="btn btn-primary">প্রস্তান</a>
                            @else
                                <button class="btn btn-default" type="submit">প্যাকেজ যুক্ত করুন</button>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল প্যাকেজ</div>
                </div>
                <div class="ibox-body">
                    @include('common.table')


                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection