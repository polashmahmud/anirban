@if ($errors->any())
    <div class="alert alert-danger alert-bordered">
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>Error!</strong> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif