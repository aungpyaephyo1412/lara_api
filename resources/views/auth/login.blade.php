@extends("layout.master")
@section("title")
    Login
@endsection
@section("content")
    <section class="min-vh-100">
            <form action="{{route("auth.check")}}" method="POST" class="w-50 mx-auto my-auto">
                @if(session("message"))
                    <p class="alert alert-danger">{{session("message")}}</p>
                @endif
                @csrf
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
                <button class="btn btn-primary w-100">Login</button>
            </form>
    </section>
@endsection
