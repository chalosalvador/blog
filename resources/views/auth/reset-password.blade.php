<form action="{{route('password.update')}}" method = 'post'>

    <h4 style = 'text-align:center'>Reset Your Password</h4>
    <div class="form-group">

        <label for="email">Email</label><input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Here" style = 'text-align:center'>
        <label for="password">Clave</label><input type="password" class="form-control" id="password" name="password" placeholder="Clave" style = 'text-align:center'>
        <label for="password_confirmation">Confirmar clave</label><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar clave" style = 'text-align:center'>
        <input type="hidden" class="form-control" id="token" name="token" value="{{$token}}" />
    </div>

    <div>
        <button type="submit" value="submit">Send Email To Reset Password
        </button>
    </div>
</form>
