<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ url('css/reg.css') }}" />
    <title>DewyDolt</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="POST" action="{{ route('registerButton') }}">
                    @csrf
                    <h2>Register</h2>

                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input id="email" type="email" name="email" :value="old('email')" required />
                        <label for="email">Email</label>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input id="username" type="text" name="username" :value="old('username')" required />
                        <label for="username">Username</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="call-outline"></ion-icon>
                        <input id="phone" type="tel" name="phone" pattern="[0-9]{11}" title="Please enter 11 digits" required />
                        <label for="phone">Phone Number</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input id="password" type="password" name="password" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$" title="Password must contain at least one uppercase letter, one digit, and one special character. Minimum length is 8 characters." required />
                        <label for="password">Password</label>
                    </div>
                    
                
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                        <label for="password_confirmation">Confirm Password</label>
                    </div>

                    <button>Register</button>
                </form>
            </div>
        </div>

        <div class="error">
            @if ($errors->any())
            <div class="error-messages">
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
