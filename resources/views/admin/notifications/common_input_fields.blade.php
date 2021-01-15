<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="title">Title {{ requiredSpan() }}</label>
                <input type="text" id="title" name="title" required minlength="2" maxlength="150"
                       class="form-control" placeholder="Title...." value="{{ old('title') ?? optional($notification)->title }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="short-description">Short Description {{ requiredSpan() }}</label>
                <input type="text" id="short-description" name="short_description" required minlength="2" maxlength="230"
                       class="form-control" placeholder="Short Description...." value="{{ old('short_description') ?? optional($notification)->short_description }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="multi-select2">Users (Leave this, if notification for all users)</label>
                <select class="form-control select2-multi" name="user_ids[]" id="multi-select2" multiple="multiple">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if(in_array($user->id, (old('users_ids') ??
                            (($notification && $notification->user_ids) ? $notification->user_ids : [] )))) selected @endif>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description">{{ old('description') ?? optional($notification)->description }}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3 text-right">
                <a href="{{ $backUrl }}" type="submit" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $btn }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description');
</script>
