@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <p><span class="fe fe-alert-triangle fe-16 mr-2"></span>{{ $error }}</p>
        @endforeach
    </div>
@endif
