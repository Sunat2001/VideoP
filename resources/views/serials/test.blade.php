@extends('layouts.app')

@section('content')
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select-js@1.0.2/dist/multiple-select.css">
    <!-- JS -->
    <script src="https://unpkg.com/multiple-select-js@1.0.2/dist/assets/js/multiple-select.js"></script>
    <div class="form-group">
        <label for="select-language">Multiple Select</label>
        <select id="select-multiple-language" multiple>
            <option value="php">PHP</option>
            <option value="javascript">Javascript</option>
            <option value="python">Python</option>
            <option value="java">Java</option>
        </select>
    </div>

    <script>
        let multipleSelect = new MultipleSelect('#select-multiple-language', {
            placeholder: 'Select Language'
        })
    </script>
@endsection
