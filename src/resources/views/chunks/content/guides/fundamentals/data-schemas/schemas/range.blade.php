<h2>Range schema</h2>
<p>A large number of advancement features make use of a "range" object, which is a comparison of an incoming number (such as the number of occupied inventory slots) to the specified range of numbers.</p>

<p>To check for an exact value, simply declare the field as a number. The following checks if the incoming value is exactly 3.</p>
{{-- TODO: this doesn't work because if the JSON example is just 3, it throws an error for not being \stdClass. --}}
@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Range::class, 'exact')])

<p>To check between two values, the field must be specified as an object containing <code>min</code> and <code>max</code> numbers. The following checks if the incoming value is between 1 and 3.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Range::class, 'between', $example_data)])

<p>You can alternatively specify only the minmum or only the maximum, which will ignore a check for the opposing limiter. For example, the following checks if the incoming value is <b>at least 3</b>.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Range::class, 'min', $example_data)])

<p>Versus the opposite, where the following checks if the incoming number is <b>at most 2</b>.</p>

@include('sourceblock::chunks.json-code-block', ['code' => guide_example(DataSchemas\Range::class, 'max', $example_data)])