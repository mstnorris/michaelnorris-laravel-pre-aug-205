@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <style>
        body {
            border-top: 1em solid #607d8b;
        }
        #MyID {
            border: none !important;
            background: none !important;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1 class="display-4">Write</h1>

                <div class="form-group"><textarea name="" id="MyID" cols="30" rows="20"></textarea></div>

                <div class="form-group"><label for="tags">Tags</label>
                    <select name="tags[]" id="tags" multiple="multiple" class="form-control">
                        @foreach ( $tags as $tag )
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select></div>

                <button class="btn btn-primary btn-block">Add</button>

            </div>
        </div>
    </div>


@endsection

@section('footer')
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        $('select').select2();
        var simplemde = new SimpleMDE({
            element: document.getElementById("MyID"),
            status: false,
            toolbar: false,
//            status: ['autosave', 'lines', 'words', 'cursor'], // Optional usage
//            toolbar: [{
//                name: "bold",
//                action: toggleBold,
//                className: "fa fa-bold",
//                title: "Bold (Ctrl+B)",
//            }, {
//                name: "italic",
//                action: toggleItalic,
//                className: "fa fa-italic",
//                title: "Italic (Ctrl+I)",
//            }, "|",
//                {
//                    name: "code",
//                    action: toggleCodeBlock,
//                    className: "fa fa-code",
//                    title: "Code (Ctrl+Alt+C)",
//                }, {
//                    name: "quote",
//                    action: toggleBlockquote,
//                    className: "fa fa-quote-left",
//                    title: "Quote (Ctrl+')",
//                }, "|",
//                {
//                    name: "unordered-list",
//                    action: toggleUnorderedList,
//                    className: "fa fa-list-ul",
//                    title: "Generic List (Ctrl+L)",
//                },
//                {
//                    name: "numbered-list",
//                    action: toggleOrderedList,
//                    className: "fa fa-list-ol",
//                    title: "Numbered List (Ctrl+Alt+L)",
//                },
//                {
//                    name: "link",
//                    action: drawLink,
//                    className: "fa fa-link",
//                    title: "Create Link (Ctrl+K)",
//                },
//                {
//                    name: "image",
//                    action: drawImage,
//                    className: "fa fa-picture-o",
//                    title: "Insert Image (Ctrl+Alt+I)",
//                },
//                {
//                    name: "horizontal-rule",
//                    action: drawHorizontalRule,
//                    className: "fa fa-minus",
//                    title: "Insert Horizontal Line",
//                }, "|",
//                {
//                    name: "fullscreen",
//                    action: toggleFullScreen,
//                    className: "fa fa-arrows-alt",
//                    title: "Toggle Fullscreen (F11)",
//                },
//                {
//                    name: "preview",
//                    action: togglePreview,
//                    className: "fa fa-eye",
//                    title: "Toggle Preview (Ctrl+P)",
//                },
//                {
//                    name: "guide",
//                    action: "http://nextstepwebs.github.io/simplemde-markdown-editor/markdown-guide",
//                    className: "fa fa-question-circle",
//                    title: "Markdown Guide",
//                },
//
//            ],
//            toolbarTips: false,
//            toolbarGuideIcon: false,
//            autofocus: true,
//            lineWrapping: false,
//            indentWithTabs: false,
//            tabSize: 4,
//            initialValue: "",
//            spellChecker: false,
//            autosave: {
//                enabled: true,
//                unique_id: "MyUniqueID",
//                delay: 1000,
//            },
        });
        simplemde.render();
    </script>
@endsection