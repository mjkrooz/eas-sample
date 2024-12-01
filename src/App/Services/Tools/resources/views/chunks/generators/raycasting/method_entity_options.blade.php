<div class="form-group row">
    <label for="detectEntitiesList" class="col-sm-4 col-form label">Entities to detect</label>
    <div class="col-sm-8">
        <div class="input-group">
            <select id="detectEntitiesList" v-model="form.detection.entity.entities" name="detection[entity][entities][]" class="selectpicker form-control" data-style="border text-dark" title="Select entities. Leave blank for all." data-actions-box="true" data-size="8" data-live-search="true" data-width="auto" data-selected-text-format="count > 3" multiple>
                @foreach($entities as $entity)
                    <option value="{{ $entity }}">{{ $entity }}</option>
                @endforeach
            </select>
        </div>
        <div class="alert alert-warning" role="alert" v-if="'detection.entity.entities' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['detection.entity.entities'][0] }}
            @endverbatim
        </div>
    </div>
</div>

<div class="my-3 row">
    <div class="offset-md-4 col-md-8">
        <div class="custom-control custom-switch">
            <input type="checkbox" v-model="state.detection.entity.non_air" v-on:click="detect().toggleNonAir()" class="custom-control-input" id="nonAirCheckSwitch" style="cursor: pointer;">
            <label class="custom-control-label" for="nonAirCheckSwitch" style="cursor: pointer;">Also stop raycast when hitting a block</label>
        </div>
    </div>
</div>
