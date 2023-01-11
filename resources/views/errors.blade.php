@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@error('alert-danger')
    <div class="w-100 p-1 label-danger">
        <span class="tag label fs-5">{{$message }}</span>
    </div>
@enderror
@error('alert-info')
    <div class="w-100 p-1 label-info">
        <span class="tag label fs-5">{{$message }}</span>
    </div>
@enderror
@error('alert-warning')
    <div class="w-100 p-1 label-warning">
        <span class="tag label fs-5">{{$message }}</span>
    </div>
@enderror
@error('alert-auth-success')
    <div class="w-100 p-1 label-success">
        <span class="tag label fs-5">{{$message }}</span>
    </div>
@enderror
@error('alert-success')
    <div class="w-50 p-1 m-auto text-center alert alert-success" role="alert">
        <span class="fs-5">{{$message }}</span>
    </div>
@enderror
<script>
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
}, 2000); // <-- time in milliseconds
</script>

