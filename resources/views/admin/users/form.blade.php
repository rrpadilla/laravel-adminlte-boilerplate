<div class="col-md-7">
    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name *</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email *</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', $record->email) }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

</div>
<!-- /.col-md-7 -->

<div class="col-md-5">

    <div class="col-xs-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="is_admin">
                <input type="checkbox" class="square-blue" name="is_admin" value="1" {{ old('is_admin', $record->is_admin) == 1 ? 'checked' : '' }}>
                Is Admin
            </label>
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-xs-12 -->

    <div class="col-xs-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="logo_number">Logo</label><br/>
            <div class="box box-info">
                <div class="box-body no-padding">
                    <ul class="logo-number users-list clearfix">
                    @foreach (\App\Utils::getLogosNumber() as $logoNumber)
                        <li>
                            <img class="profile-user-img img-responsive img-circle" src="{{ \App\Utils::logoPath($logoNumber) }}" alt="Profile picture {{ $logoNumber }}">
                            <span class="users-list-date">
                                <input type="radio" name="logo_number" value="{{ $logoNumber }}" {{ old('logo_number', $record->logo_number) == $logoNumber ? 'checked' : '' }}>
                            </span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-xs-12 -->

</div>
<!-- /.col-md-5 -->
