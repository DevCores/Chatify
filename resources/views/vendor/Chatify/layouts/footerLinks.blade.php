<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>

<script >
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  
  var pusher = new Pusher("{{ config('chatify.pusher.key') }}", {
      encrypted: "{{ config('chatify.pusher.options.encrypted') }}",
      key: "{{ config('chatify.pusher.key') }}",
      wsHost: window.location.hostname,
      wsPort: "{{ config('chatify.pusher.options.port') }}",
      wssPort: "{{ config('chatify.pusher.options.port') }}",
      forceTLS: "{{ config('chatify.pusher.options.useTLS') }}",
      schema: "{{ config('chatify.pusher.options.schema') }}",
      cluster: "{{ config('chatify.pusher.options.cluster') }}",
      enabledTransports: ['ws','wss'],
      disableStats: true,
      authEndpoint: '{{route("pusher.auth")}}',
      auth: {
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      }
    
    });

    // Bellow are all the methods/variables that using php to assign globally.
    const allowedImages = {!! json_encode(config('chatify.attachments.allowed_images')) !!} || [];
    const allowedFiles = {!! json_encode(config('chatify.attachments.allowed_files')) !!} || [];
    const getAllowedExtensions = [...allowedImages, ...allowedFiles];
    const getMaxUploadSize = {{ Chatify::getMaxUploadSize() }};
</script>
<script src="{{ asset('js/chatify/code.js') }}"></script>
@vite('resources/js/app.js')
