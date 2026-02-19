@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Jelszó változtatás</h2>
    <form method="POST" action="{{ route('password.change') }}">
        @csrf
        <div class="mb-3">
            <label for="new_password" class="form-label">Új jelszó</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Új jelszó megerősítése</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Jelszó módosítása</button>
    </form>
</div>
@endsection
