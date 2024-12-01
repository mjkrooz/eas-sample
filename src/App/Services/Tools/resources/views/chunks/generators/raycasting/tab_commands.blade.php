
<div class="alert alert-info d-flex align-items-center" role="alert">
    <i class="fas fa-info-circle fa-lg text-primary flex-shrink-0 mr-3"></i>
    <div>
        Tip: select the entity performing the raycast with <code>@s</code>
    </div>
</div>

<!-- PRE-RAYCAST -->

<div class="card mb-2">
    <div class="card-header bg-secondary text-light"><h5 class="card-title mb-0">Before raycasting</h5></div>
    <div class="card-body">

        <p>Specify the optional commands to run <strong>before</strong> the selected entity begins the raycast. You can use this to, for example, play a sound to indicate that the raycast has started (such as a sound of a laser being fired).</p>

        <textarea name="commands[pre_raycast]" v-model="form.commands.pre_raycast" id="commandsBlockFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say Before raycasting"></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.pre_raycast' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.pre_raycast'][0] }}
            @endverbatim
        </div>
    </div>
</div>

<!-- FAILED -->

<div class="card mb-2">
    <div class="card-header bg-secondary text-light"><h5 class="card-title mb-0">Raycasting failed</h5></div>
    <div class="card-body">
        <p>Specify the optional commands you wish to run when the raycast finishes <strong>without succeeding</strong>. The execution position will be at the end of the raycast. Use <code>execute at @s</code> to go back to the executor if needed.</p>

        <textarea name="commands[failed]" v-model="form.commands.failed" id="commandsBlockFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say Raycasting failed"></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.failed' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.failed'][0] }}
            @endverbatim
        </div>
    </div>
</div>

<!-- POST-RAYCAST -->

<div class="card mb-2">
    <div class="card-header bg-secondary text-light"><h5 class="card-title mb-0">After raycasting</h5></div>
    <div class="card-body">

        <p>Specify the optional commands to run <strong>after</strong> the raycast fully ends for the entity, regardless of whether or not the raycast succeeded. The position will be at the original entity that started the raycast.</p>

        <textarea name="commands[post_raycast]" v-model="form.commands.post_raycast" id="commandsBlockFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say After raycasting"></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.post_raycast' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.post_raycast'][0] }}
            @endverbatim
        </div>
    </div>
</div>

<!-- STEP -->

<div class="card mb-2">
    <div class="card-header bg-secondary text-light"><h5 class="card-title mb-0">Per-step</h5></div>
    <div class="card-body">
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fa-lg text-primary flex-shrink-0 mr-3"></i>
            @verbatim
                <div class="d-block">
                    <p>Tip: check the current step by checking the <code>{{ form.options.objective }}</code> score for the fake player <code>#hit</code>, e.g.:</p>

                    <code>execute if score #hit {{ form.options.objective }} matches 40 run ...</code>
                </div>
            @endverbatim
        </div>
        <p>Specify the optional commands to run at each step of the raycast. This can be used to, for example, create a line of particles.</p>

        <textarea name="commands[step]" v-model="form.commands.step" id="commandsBlockFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say One step in the raycast"></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.step' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.step'][0] }}
            @endverbatim
        </div>
    </div>
</div>
