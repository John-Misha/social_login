@extends('component.layout')

@section('content')
    <div id="contentWrapper">
        <h5>Profile</h5>

        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')

            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name"  value="{{ old('name', $user->name) }}">

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" readonly disabled>

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-custom">Update</button>
            </div>

        </form>
    </div>
@endsection
