<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label text-right">
        <strong>Tag</strong>
    </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Tag" name="name"
               value="{{ old('name') ?? optional($tag)->name }}">
    </div>
</div>
