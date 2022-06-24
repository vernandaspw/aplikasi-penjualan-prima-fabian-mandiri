<div>
    <div class=" d-flex justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col-sm-10">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <h4>Login Masuk</h4>
                    </div>
                    @if (session()->has('msg_success'))
                        <div class="alert alert-success">{{ session('msg_success') }}</div>
                    @endif
                    @if (session()->has('msg_error'))
                        <div class="alert alert-danger">{{ session('msg_error') }}</div>
                    @endif
                    <br>
                    <form wire:submit.prevent='login'>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input wire:model='email' type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                aria-describedby="emailHelp">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input wire:model='password' type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input checked type="checkbox" wire:model='ingat' class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <button type="submit" class="btn form-control rounded-pill shadow-sm text-white"
                            style="background-color: {{ env('COLOR_PRIMARY') }};">Login</button>
                    </form>
                    <a href="{{ url('daftar') }}" class="btn btn-transparent rounded-pill form-control shadow-sm mt-2">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    body {
        background-color: {{ env('COLOR_PRIMARY') }};
    }
</style>
