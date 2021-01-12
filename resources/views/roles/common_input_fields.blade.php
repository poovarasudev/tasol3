<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="name">Role Name {{ requiredSpan() }}</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="30"
                       class="form-control" placeholder="Name...." value="{{ old('name') ?? optional($role)->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="multi-select2">Permissions</label>
                <select class="form-control select2-multi" name="permission_ids[]" id="multi-select2" multiple="multiple">
                    @foreach($permissions as $group => $groupedPermissions)
                        <optgroup label="{{ $group }}">
                            @foreach($groupedPermissions as $permission)
                                <option value="{{ $permission->id }}"
                                        @if(in_array($permission->id, (old('permission_ids') ?? ($role ? $role->permissions->pluck('id')->toArray() : [])))) selected @endif>
                                    {{ formattedPermissionName($permission->name) }}</option>
                            @endforeach
                        </optgroup>
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
