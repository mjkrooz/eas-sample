
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Oxygen|Roboto|Abel|Didact+Gothic|Crimson+Text"
    rel="stylesheet">

<style>
    .nav-link {
        font-family: "Open Sans" !important;
        font-size: 1.0em !important;
    }

    .list-group-item {
        font-family: "Open Sans" !important;
        font-size: 1.0em !important;
    }

    .ext-link {
        font-family: "Roboto" !important;
        font-size: 1.2em !important;
    }

    .navbar-brand {
        font-family: "Abel" !important;
    }

    .copyright {
        font-family: "Oxygen" !important;
    }

    .sb-tooltip-underline {
        border-bottom: 1px dotted #000000;
    }

    @if(isset($feature_color))
        .bg-primary {
            background-color: #7986cb  !important;
            /*background-color: {{ $feature_color->brighten() }} !important;
            background: url({{ image_asset('back_mid.png') }});
            background-size: cover;
            background-position: bottom;*/
        }

        {{-- TODO: figure out what to do with this. --}}
        /*.text-primary {
            color: {{ $feature_color->brighten() }} !important;
        }*/

        .sb-guide-link:hover {
            background-color: {{ $feature_color->getColorHex() }} !important;
        }
    @endif
</style>
