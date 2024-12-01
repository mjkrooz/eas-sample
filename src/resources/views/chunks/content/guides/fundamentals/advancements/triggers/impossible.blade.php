<h2 class="text-monospace" id="sec-impossible"><span class="text-muted">minecraft:</span>impossible</h2>
<p>This does <b>not</b> trigger naturally. The only way to trigger this is in vanilla to use the <code>/advancement</code> command. This supplements command mechanisms as it allows more complex requirements that can be met with commands.</p>

<p>For example, given the following advancement, assuming resource location "custom:missions":</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(AdvancementTriggers\Impossible::class, 'main')])

<p>The following commands will individually trigger each specific criterion, completing the advancement, but only for players that have the "winner" tag:</p>

<pre class="pre-scrollable bg-dark text-light"><code class="px-4 py-3">/advancement grant @a[tag=winner] custom:missions mission1
/advancement grant @a[tag=winner] custom:missions mission2
</code class="json px-4 py-3"></pre class="pre-scrollable bg-dark text-light">

<p>There are 0 conditions for this trigger.</p>