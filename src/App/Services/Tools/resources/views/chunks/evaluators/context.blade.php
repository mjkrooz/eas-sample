<?php
    use JsonPath\JsonObject;
?>

<p class="mb-0 bg-light font-italic p-3 mb-3 border-left shadow-sm">{{ $message }}</p>

@switch($type)
    @case('json')
        <?php
                if ($raw[0] == 'null') {

                    $str = '$';
                } else {

                    $jsonObject = new JsonObject($raw[0]);
                    $str = $context->path . ': ' . json_encode($jsonObject->get($context->path)[0], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                }
        ?>
        <p>The following <a href="https://goessner.net/articles/JsonPath/" target="_blank">JSON path</a> and associated value contains the issue.</p>

        <pre><code>{{ $str }}</code></pre>
    @break
    @case('audit')
        <p>The following audit is used in this context.</p>
        <pre><code>{{ $context->audit }}</code></pre>
    @break
    @case('generic')
        <p>The following strings, if any, are used in this context.</p>
        <ul>
        @foreach($context->values as $value)
            <li>{{ $value }}</li>
        @endforeach
        </ul>
    @break
    @case('structure')
        <p>The following structure is used in this context.</p>
        <pre><code>{{ $context->structure }}</code></pre>
    @break
    @case('uses_resource_location')
        <p>A resource location is a thing and then another thing.</p>
    @break
    @case('deprecated_registry')
        <p>One of the following values are expected.</p>

        <ul>
        @foreach(App\Domains\Minecraft\Registries\Registries::getRegistry(\Ramsey\Uuid\Uuid::fromString($context->registry))->getValues() as $value)
            <li>{{ $value }}</li>
        @endforeach
        </ul>
    @break
@endswitch
