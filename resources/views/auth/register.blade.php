@if ($error->any())
    <div>{{$error->first()}}</div>
@endif
<form method="POST" action="{{route('register')}}">
    @csrf
    <input type="text" style="text-transform: capitalize" name="name" required placeholder="Enter your Name">
    <input type="email" name="email" required placeholder="Enter your email">
    <input type="password" name="password" required placeholder="Enter your password">
    <input type="password" name="password_confirmation" required placeholder="Confirm your password">
    <button type="submit">Register</button>