{{-- resources/views/emails/contact-form.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h1>New Contact Message from your Portfolio</h1>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    @if(isset($subject) && $subject)
        <p><strong>Subject:</strong> {{ $subject }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{!! nl2br(e($message)) !!}</p> {{-- nl2br preserves newlines, e for escaping HTML --}}
</body>
</html>
