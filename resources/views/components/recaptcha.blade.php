{!! NoCaptcha::renderJs() !!}
{!! NoCaptcha::display() !!}
@error('g-recaptcha-response')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror