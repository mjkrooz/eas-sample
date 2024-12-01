<div class="card">
    <div class="card-body">
        <!-- NAMESPACE -->

        <div class="form-group row">
            <label for="namespace" class="col-sm-4 col-form-label sb-required"><span>Namespace</span></label>
            <div class="col-sm-8">
                <input class="form-control bg-light" v-model="form.options.namespace" type="text" name="options[namespace]" id="namespace" value="vdv_raycast" required>
                <div class="alert alert-warning" role="alert" v-if="'options.namespace' in state.errors">
                    @verbatim
                        {{ state.errors['options.namespace'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>

        <!-- SUBFOLDER -->

        <div class="form-group row">
            <label for="subfolder" class="col-sm-4 col-form-label">Subfolder(s)</label>
            <div class="col-sm-8">
                <input class="form-control bg-light" v-model="form.options.subfolder" type="text" name="options[subfolder]" id="subfolder" placeholder="path/to/subfolder (optional)">
                <div class="alert alert-warning" role="alert" v-if="'options.subfolder' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['options.subfolder'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>

        <!-- OBJECTIVE -->

        <div class="form-group row">
            <label for="objective" class="col-sm-4 col-form-label sb-required"><span>Objective</span></label>
            <div class="col-sm-8">
                <input class="form-control bg-light" v-model="form.options.objective" type="text" name="options[objective]" id="objective" value="vdvcasttemp" maxlength="16" required>
                <div class="alert alert-warning" role="alert" v-if="'options.objective' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['options.objective'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <div class="form-check">
                    <input id="objective-autoload" v-model="form.options.create_objective" class="form-check-input" type="checkbox" name="options[create_objective]" checked>
                    <label for="objective-autoload" class="form-check-label" style="cursor: pointer;">Auto-create objective</label>
                <div class="alert alert-warning" role="alert" v-if="'options.create_objective' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['options.create_objective'][0] }}
                    @endverbatim
                </div>
                </div>
            </div>
        </div>

        <!-- TAG -->

        <div class="form-group row">
            <label for="tag" class="col-sm-4 col-form-label sb-required"><span class="hover-info" title="The tag temporarily applied to the entity performing the raycast.">Tag name</span></label>
            <div class="col-sm-8">
                <input class="form-control bg-light" v-model="form.options.tag" type="text" name="options[tag]" id="tag" value="vdvray" required>
                <div class="alert alert-warning" role="alert" v-if="'options.tag' in state.errors" v-cloak>
                    @verbatim
                        {{ state.errors['options.tag'][0] }}
                    @endverbatim
                </div>
            </div>
        </div>
    </div>
</div>
