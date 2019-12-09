@if ($errors->any())
    <div class="ui error message">
        <div class="items text-center">
            @foreach ($errors->all() as $error)
                <div class="item">{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif