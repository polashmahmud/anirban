@extends('layouts.app')

@section('title', 'Show Details')

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
                            জমা এডিট করুন
                        @else
                            নতুন জমা যুক্ত করুন
                        @endif
                    </div>
                </div>
                <div class="ibox-body">
                    <p class="text-info">আপনি যদি এখান থেকে টাকা ইনপুট দেন তাহলে তারিখ অটো বসবে না, আপনি যে তারিখ সেট করে দিবেন সেটাই বসবে। এটা শুধু মাত্র যে সকল একাউন্টে নির্দিষ্ট টাকা জমা দেওয়ার দরকার পরে না তাদের জন্য। উদাহরন স্বরুপ: ইনভেস্টমেন্ট একাউন্ট। </p>
                @if($collection->exists)
                        <form method="POST" action="{{ route('collection.update', $collection->id) }}">
                            @csrf
                            @method('PATCH')
                            @else
                                <form action="{{ route('collection.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="account_id" value="{{ $account_id }}">
                                    @endif
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

                                    <div class="form-group">
                                        <label>টাকার পরিমান</label>
                                        <input class="form-control" type="number" placeholder="টাকার পরিমান" name="amount" value="{{ old('amount',$collection->amount) }}" required>
                                    </div>

                                    <div class="form-group">
                                        @if($collection->exists)
                                            <button class="btn btn-default" type="submit">জমা এডিট করুন</button>
                                            <a href="{{ route('collection.show', $collection->account_id) }}" class="btn btn-primary">প্রস্তান</a>
                                        @else
                                            <button class="btn btn-default" type="submit">জমা যুক্ত করুন</button>
                                        @endif
                                    </div>
                                </form>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">প্রস্তান করুন</div>
                </div>
                <div class="ibox-body">
                    <a href="{{ route('collection.index') }}?type=done" class="btn btn-outline-primary">স্থগিত</a>
                    <a href="{{ route('collection.index') }}" class="btn btn-outline-success">সকল একাউন্ট</a>
                    <a href="{{ route('collection.index') }}?type=investment" class="btn btn-outline-info">ইনভেস্টমেন্ট</a>
                    <a href="{{ route('collection.index') }}?type=saving" class="btn btn-outline-warning">সঞ্চয়</a>
                    <a href="{{ route('collection.index') }}?type=lone"" class="btn btn-outline-danger">লোন</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">সকল জমা খরচ</div>
                </div>
                <div class="ibox-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>তারিখ</th>
                                <th>জমা করেছেন</th>
                                <th>টাকা</th>
                                <th>বর্ণনা</th>
                                <th style="width:130px;">অপশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($collections as $collection)
                                <tr>
                                    <td>{{ $collection->date }}</td>
                                    <td>{{ $collection->user->name }}</td>
                                    <td>{{ $collection->amount }}</td>
                                    <td>{{ $collection->description }}</td>
                                    <td>
                                        <a class='btn btn-default btn-xs m-r-5' data-toggle="tooltip" data-original-title="Edit" href="{{ route('collection.edit', $collection->id) }}?account_id={{ $collection->account_id }}"><i class="ti-pencil-alt color-success font-14"></i></a>

                                        <form id="delete-form-{{ $collection->id }}" method="post" action="{{ route('collection.destroy', $collection->id) }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <a class='btn btn-default btn-xs m-r-5' data-toggle="tooltip" data-original-title="Delete" href="" onclick="
                                        if(confirm('Are you sure, You Want to delete this?'))
                                          {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $collection->id }}').submit();
                                          }
                                          else{
                                            event.preventDefault();
                                          }" ><i class="ti-trash color-danger font-14"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $collections->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection