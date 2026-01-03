<p>Good day {{ $user->username }},</p>

<p>Your account requires activation.</p>

<p><strong>Activation Code:</strong></p>

<h2 style="letter-spacing:3px;">{{ $code }}</h2>

<p>This code will expire in 10 minutes.</p>

<p>Regards,<br>{{ config('app.name') }}</p>
