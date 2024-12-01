<h2 class="text-monospace" id="sec-changed-dimension"><span class="text-muted">minecraft:</span>changed_dimension</h2>
<p>This triggers whenever the player switches to another dimension.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChangedDimension::class, 'main')])

<p>There are 3 conditions for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, <code>to</code>, <code>from</code>.</p>

<h3 class="text-monospace" id="sec-to">to</h3>
<hr>

<p>The <code>to</code> string specifies the dimension the player is traveling to, accepting values "overworld", "the_nether", and "the_end". The following triggers if the player travels to the end (regardless of their original dimension).</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChangedDimension::class, 'to', $example_data)])

<h3 class="text-monospace" id="sec-from">from</h3>
<hr>

<p>The <code>from</code> string specifies the dimension the player traveled from, accepting values "overworld", "the_nether", and "the_end". The following triggers if the player travels to the end, though specifically from the nether.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\ChangedDimension::class, 'from', $example_data)])