<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            @foreach($col_heads as $col_head)
                @if($col_head == 'অপশন')
                    <th style="width:130px;">{!! $col_head !!}</th>
                @elseif($col_head == 'Description')
                    <th style="width:25% ;">{!! $col_head !!}</th>
                @else
                    <th>{!! $col_head !!}</th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($col_data as $data)
            <tr>
                @foreach($data as $row)
                    <td>{!! $row !!}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>