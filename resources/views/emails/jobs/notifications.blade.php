@component('mail::message')
# New Job Posting

Title: {{ $title }}

Description: {{ $description }}

@component('mail::button', ['url' => $approveLink ])
Approve (Publish)
@endcomponent

@component('mail::button', ['url' => $spamLink ])
Mark as Spam
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
