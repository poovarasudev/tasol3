<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="name">Team Name {{ requiredSpan() }}</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="30"
                       class="form-control" placeholder="Name...." value="{{ old('name') ?? optional($team)->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="description">Short Description {{ requiredSpan() }}</label>
                <input type="text" id="description" name="description" required minlength="10" maxlength="200"
                       class="form-control" placeholder="Description...." value="{{ old('description') ?? optional($team)->description }}">
            </div>
            <div class="form-group mb-3 text-right">
                <a href="{{ $backUrl }}" type="submit" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $btn }}</button>
            </div>
        </div>
    </div>
</div>
