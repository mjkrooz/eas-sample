<div class="form-group row">
    <label for="detectBlockList" class="col-sm-4 col-form label sb-required"><span>Blocks to detect</span></label>
    <div class="col-sm-8">
            <input type="hidden" name="detection[block][blocks][]" v-for="block in form.detection.block.blocks" :value="block">
        <div class="input-group">
            <select id="detectBlockList" v-model="form.detection.block.blocks" class="selectpicker form-control" data-style="border text-dark" title="Select blocks." data-actions-box="true" data-size="8" data-live-search="true" data-width="auto" data-selected-text-format="count > 3" multiple>
                @foreach($blocks as $block)
                    <option value="{{ $block }}">{{ $block }}</option>
                @endforeach
            </select>
        </div>
        <div class="alert alert-warning" role="alert" v-if="'detection.block.blocks' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['detection.block.blocks'][0] }}
            @endverbatim
        </div>
    </div>
</div>

<div class="my-3 row">
    <div class="offset-md-4 col-md-8">
        <input type="hidden" v-model="form.detection.block.inverted" name="detection[block][inverted]" value="false">
        <div class="custom-control custom-radio">
            <input type="radio" v-model="state.detection.block.blocks_inverted_radio" v-on:change="detect().setBlocksInverted(false)" id="detectBlockInvertedA" class="custom-control-input" value="false" style="cursor: pointer;" checked>
            <label class="custom-control-label" for="detectBlockInvertedA" style="cursor: pointer;">Detect when these blocks are found.</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" v-model="state.detection.block.blocks_inverted_radio" v-on:change="detect().setBlocksInverted(true)" id="detectBlockInvertedB" class="custom-control-input" value="true" style="cursor: pointer;">
            <label class="custom-control-label" for="detectBlockInvertedB" style="cursor: pointer;">Detect when any blocks <strong>other than these</strong> are found.</label>
        </div>
        <div class="alert alert-warning" role="alert" v-if="'detection.block.inverted' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['detection.block.inverted'][0] }}
            @endverbatim
        </div>
    </div>
</div>
