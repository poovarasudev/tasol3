<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="name">Menu Name {{ requiredSpan() }}</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="30"
                       class="form-control" placeholder="Name...." value="{{ old('name') ?? optional($menu)->name }}">
            </div>
            <div class="form-group mb-3">
                <label for="for">Menu For {{ requiredSpan() }}</label>
                <select class="form-control select2" id="for" name="for" required>
                    <option value="">Please select a option</option>
                    <option value="{{ MENU_FOR_BREAKFAST }}" {{ ((old('for') ?? optional($menu)->for) == MENU_FOR_BREAKFAST) ? 'selected' : '' }}>{{ MENU_FOR_BREAKFAST }}</option>
                    <option value="{{ MENU_FOR_LUNCH }}" {{ ((old('for') ?? optional($menu)->for) == MENU_FOR_LUNCH) ? 'selected' : '' }}>{{ MENU_FOR_LUNCH }}</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="for">Order Type {{ requiredSpan() }}</label>
                <select class="form-control select2" id="order_type" name="order_type" required>
                    <option value="">Please select a option</option>
                    <option value="{{ ORDER_TYPE_SINGLE }}" {{ ((old('order_type') ?? optional($menu)->order_type) == ORDER_TYPE_SINGLE) ? 'selected' : '' }}>{{ ORDER_TYPE_SINGLE }}</option>
                    <option value="{{ ORDER_TYPE_MULTIPLE }}" {{ ((old('order_type') ?? optional($menu)->order_type) == ORDER_TYPE_MULTIPLE) ? 'selected' : '' }}>{{ ORDER_TYPE_MULTIPLE }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="price">Price (per unit) {{ requiredSpan() }}</label>
                <input type="number" id="price" name="price" class="form-control" placeholder="Price...."
                       required value="{{ old('price') ?? optional($menu)->price }}">
            </div>
            <div class="form-group mb-3">
                <label for="for">Bill Type {{ requiredSpan() }}</label>
                <select class="form-control select2" id="bill_type" name="bill_type" required>
                    <option value="">Please select a option</option>
                    <option value="{{ BILL_TYPE_EQUALLY_DIVIDED }}" {{ ((old('bill_type') ?? optional($menu)->bill_type) == BILL_TYPE_EQUALLY_DIVIDED) ? 'selected' : '' }}>{{ BILL_TYPE_EQUALLY_DIVIDED }}</option>
                    <option value="{{ BILL_TYPE_PER_UNIT }}" {{ ((old('bill_type') ?? optional($menu)->bill_type) == BILL_TYPE_PER_UNIT) ? 'selected' : '' }}>{{ BILL_TYPE_PER_UNIT }}</option>
                </select>
            </div>
            <div class="form-group mb-3 text-right crud-btn-top-padding">
                <a href="{{ $backUrl }}" type="submit" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $btn }}</button>
            </div>
        </div>
    </div>
</div>
