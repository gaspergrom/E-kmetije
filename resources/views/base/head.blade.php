<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes"/>

    <script>
        const baseApi = "{{ get_rest_url() . API_PREFIX }}";
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    @php wp_head() @endphp
    {!! get_field('code_head', 'options') !!}
</head>
