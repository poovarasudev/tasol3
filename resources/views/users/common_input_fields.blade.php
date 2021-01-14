<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="name">Name {{ requiredSpan() }}</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="30"
                       class="form-control" placeholder="Name...." value="{{ old('name') ?? optional($user)->name }}">
            </div>
            <div class="form-group mb-3 @if($user) pb-20-px @endif">
                <label for="phone">Mobile Number {{ requiredSpan() }}</label>
                <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}"
                       class="form-control" placeholder="Mobile...." value="{{ old('phone') ?? optional($user)->phone }}">
            </div>
            <div class="form-group mb-3">
                <label for="team-id">Team {{ requiredSpan() }}</label>
                <select class="form-control select2" id="team-id" name="team_id" required>
                    <option value="">Please select a Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ (old('team_id') ?? (optional($user)->team_id) == $team->id) ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="breakfast" id="breakfast" @if($user && $user->breakfast) checked @endif>
                <label class="custom-control-label" for="breakfast">Breakfast</label>
            </div>
            <div class="form-group mb-3 custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="lunch" id="lunch" @if($user && $user->lunch) checked @endif>
                <label class="custom-control-label" for="lunch">Lunch</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="email">Email {{ requiredSpan() }}</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email...."
                       required value="{{ old('email') ?? optional($user)->email }}">
            </div>
            <div class="form-group mb-3">
                <label for="password">Password {{ $user ? '' : requiredSpan() }}</label>
                <input type="password" id="password" class="form-control" minlength="6" maxlength="15"
                       @if(!$user) required @endif placeholder="{{ $user ? '***********' : 'Password....' }}">
                @if($user)
                    <span class="help-block"><small>Note: A new password will be updated, if you filled this field.</small></span>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="gender">Gender {{ requiredSpan() }}</label>
                <select class="form-control select2" id="gender" name="gender" required>
                    <option value="">Please select a Gender</option>
                    <option value="{{ GENDER_MALE }}" {{ ((old('gender') ?? optional($user)->gender) == GENDER_MALE) ? 'selected' : '' }}>{{ GENDER_MALE }}</option>
                    <option value="{{ GENDER_FEMALE }}" {{ ((old('gender') ?? optional($user)->gender) == GENDER_FEMALE) ? 'selected' : '' }}>{{ GENDER_FEMALE }}</option>
                    <option value="{{ GENDER_OTHER }}" {{ ((old('gender') ?? optional($user)->gender) == GENDER_OTHER) ? 'selected' : '' }}>{{ GENDER_OTHER }}</option>
                </select>
            </div>
            <div class="form-group mb-3 text-right crud-btn-top-padding">
                <a href="{{ $backUrl }}" type="submit" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $btn }}</button>
            </div>
        </div>
    </div>
</div>
