@if ($error->any())
    <div>{{$error->first() }}</div>
@endif
<form method="POST" action="{{route('login')}}">
    @csrf
    <input type="email" name="email" required placeholder="Enter your email">
    <input type="password" name="password" required placeholder="*************">
    <button type="submit">Login</button>
</form>