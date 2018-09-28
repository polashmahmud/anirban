@extends('layouts.app')

@section('title', 'Debit')

@push('header-script')
    <link href={{ asset("assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css") }} rel="stylesheet" />
@endpush

@push('footer-script')
    <script src={{ asset("assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }} type="text/javascript"></script>
    <script type="text/javascript">
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
                        @if($collection->exists)
                           জমা/খরচ এডিট করুন
                        @else
                            নতুন জমা/খরচ যুক্ত করুন
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    @if($collection->exists)
                        <form method="POST" action="{{ route('debit-credit.update', $collection->id) }}">
                            @method('PATCH')
                    @else
                        <form action="{{ route('debit-credit.store') }}" method="POST">
                    @endif
                    @csrf

                        @if($collection->exists)
                            <div class="form-group" id="date_1">
                                <label class="font-normal">তারিখ</label>
                                <div class="input-group date">
                                    <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ $collection->date }}" name="date" required>
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

                        @if($collection->exists)
                            <div class="form-group">
                                <label>টাইপ</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="type" value="0" @if($collection->amount < 0) checked @endif >
                                                <span class="input-span"></span>খরচ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="type" value="1" @if($collection->amount > 0) checked @endif>
                                                <span class="input-span"></span>জমা
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>টাইপ</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="type" value="0" checked>
                                                <span class="input-span"></span>খরচ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="ui-radio ui-radio-success">
                                                <input type="radio" name="type" value="1">
                                                <span class="input-span"></span>জমা
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>টাকার পরিমান</label>
                            <input class="form-control" type="number" placeholder="টাকার পরিমান" name="amount" value="{{ old('amount',$collection->amount) }}" required>
                        </div>

                        <div class="form-group">
                            <label>বর্ণনা</label>
                            <textarea class="form-control" rows="3" name="description" required>{{ old('description',$collection->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            @if($collection->exists)
                                <button class="btn btn-default" type="submit">জমা/খরচ এডিট করুন</button>
                                <a href="{{ route('debit-credit.index') }}" class="btn btn-primary">প্রস্তান</a>
                            @else
                                <button class="btn btn-default" type="submit">জমা/খরচ যুক্ত করুন</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল জমা খরচ</div>
                </div>
                <div class="ibox-body">
                    @include('common.table')


                    {{ $collections->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection