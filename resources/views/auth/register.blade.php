@extends("layout.master")
@section("title")
    Register
@endsection
@section("content")
    <section class="w-100 min-vh-100">
        <form action="{{route("auth.store")}}" method="POST" class="w-50 mx-auto my-auto">
            @csrf
            <div class="mb-2">
                <label for="Name" class="form-label">Name</label>
                <input value="{{old("name")}}" type="text" id="Name" name="name" class="form-control @error("name") is-invalid @enderror">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="Email" class="form-label">Email</label>
                <input value="{{old("email")}}" type="text" id="Email" name="email" class="form-control @error("email") is-invalid @enderror">
                @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="Password" class="form-label">Password</label>
                <input type="password" id="Password" name="password" class="form-control @error("password") is-invalid @enderror">
                @error('password')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="Password_confirmation" class="form-label">Password_Confirmation</label>
                <input type="password" id="Password_confirmation" name="password_confirmation" class="form-control @error("password_confirmation") is-invalid @enderror">
                @error('password_confirmation')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary w-100">Register</button>
        </form>
    </section>
@endsection
