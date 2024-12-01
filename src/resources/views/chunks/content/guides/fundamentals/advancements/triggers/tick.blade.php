<h2 class="text-monospace" id="sec-tick"><span class="text-muted">minecraft:</span>tick</h2>
<p>This simply triggers every tick. This can be used to help simulate command block systems or automatically unlock advancements. The following activates every tick, running a function as a reward that revokes the advancement so that it may activate in the next tick.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Tick::class, 'main')])

<p>There is 1 condition for this trigger: <code><a href="{{ route('guides:fundamentals/data-packs/advancements/triggers') }}#sec-player-condition">player</a></code>, which currently cannot be used due to a bug (<a href="https://bugs.mojang.com/browse/MC-181630" target="_blank">MC-181630</a>).</p>