<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                @if($user)
                    <label for="email">User</label>
                    <input type="email" id="email" class="form-control" disabled value="{{ $user->name }}">
                @else
                    <label for="user-select2">User {{ requiredSpan() }}</label>
                    <select class="form-control select2" name="user_id" required id="user-select2">
                        <option value="">Please select a User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($user->id == old('user_id')) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="multi-select2">Roles {{ requiredSpan() }}</label>
                <select class="form-control select2" name="role_id" required>
                    <option value="">Please select a Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @if($role->id == $oldRoleId) selected @endif>
                            {{ $role->name . ' (' . $role->permissions_count . ' ' . getSingularOrPlural('permission', $role->permissions_count) . ')' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 text-right">
                <a href="{{ $backUrl }}" type="submit" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $btn }}</button>
            </div>
        </div>
    </div>
</div>
