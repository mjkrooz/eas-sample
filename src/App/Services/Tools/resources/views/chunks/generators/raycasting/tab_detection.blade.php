<div class="card mb-3">
    <div class="card-body">
        <!-- DETECTION METHOD -->

        <div class="form-group row">
            <label for="abc" class="col-sm-4 col-form-label sb-required"><span>Detection method</span></label>
            <input type="hidden" v-model="form.detection.method" id="detectionMethodInput" name="detection[method]" value="entity">
            <div id="detectionMethodSelection" class="col-sm-8 d-flex">
                <button type="button" v-bind:class="form.detection.method === 'entity' ? 'active' : ''" v-on:click="detect().selectMethod('entity')" id="selectEntityMethod" class="btn btn-outline-secondary flex-fill" style="border-bottom-right-radius: 0;border-top-right-radius: 0;">Entity</button>
                <button type="button" v-bind:class="form.detection.method === 'block' ? 'active' : ''" v-on:click="detect().selectMethod('block')" id="selectBlockMethod" class="btn btn-outline-secondary flex-fill rounded-0 border-left-0 border-right-0">Block</button>
                <button type="button" v-bind:class="form.detection.method === 'both' ? 'active' : ''" v-on:click="detect().selectMethod('both')" id="selectBothMethod" class="btn btn-outline-secondary flex-fill" style="border-bottom-left-radius: 0;border-top-left-radius: 0;">Both</button>
            </div>
        </div>

        <!-- MAX CAST DISTANCE -->

        <div class="form-group row">
            <label for="detectionMaxDistance" class="col-sm-4 col-form label sb-required"><span>Maximum travel distance</span></label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input class="form-control" v-model="form.detection.max_distance" type="number" min="1" name="detection[max_distance]" id="detectionMaxDistance" value="10" required>
                    <div class="input-group-append">
                        <select name="detection[units]" v-model="form.detection.units" v-on:change="detect().calculateTravelDistance()" id="detectionUnits" class="custom-select" style="border-bottom-left-radius: 0;border-top-left-radius: 0;" required>
                            <option value="blocks">blocks</option>
                            <option value="steps">steps</option>
                        </select>
                    </div>
                </div>
                <div class="alert alert-warning" role="alert" v-if="'detection.max_distance' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['detection.max_distance'][0] }}
                    @endverbatim
                </div>
                <div class="alert alert-warning" role="alert" v-if="'detection.units' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['detection.units'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>

        <!-- STEP DISTANCE -->

        <div class="form-group row">
            <label for="detectionMaxDistance" class="col-sm-4 col-form label sb-required"><span>Blocks per step</span></label>
            <div class="col-sm-8">
                <input class="form-control" v-model="form.detection.step_distance" type="number" min="0" step="0.01" name="detection[step_distance]" id="detectionStepDistance" value="0.1" required>
                <div class="alert alert-warning" role="alert" v-if="'detection.step_distance' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['detection.step_distance'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 font-italic">
                Maximum steps possible
            </div>
            <div class="col-sm-8" v-cloak>
                @verbatim
                    {{ total_steps }}
                @endverbatim
            </div>
        </div>

        <hr>

        <!-- ENTITY OPTIONS -->

        <div id="detectEntityOptions" v-bind:class="form.detection.method === 'entity' || form.detection.method === 'both' ? '' : 'd-none'">
            @include('tools::chunks.generators.raycasting.method_entity_options')
        </div>

        <!-- BLOCK OPTIONS -->

        <div id="detectBlockOptions" v-bind:class="form.detection.method === 'block' || form.detection.method === 'both' ? '' : 'd-none'" v-cloak>
            @include('tools::chunks.generators.raycasting.method_block_options')
        </div>

    </div>
</div>

@include('tools::chunks.generators.raycasting.method_tips')

<div id="detectEntityCommands" v-if="form.detection.method === 'entity' || form.detection.method === 'both'">
    @include('tools::chunks.generators.raycasting.method_entity')
</div>

<div id="detectBlockCommands" v-if="form.detection.method === 'block' || form.detection.method === 'both'" v-cloak>
    @include('tools::chunks.generators.raycasting.method_block')
</div>
