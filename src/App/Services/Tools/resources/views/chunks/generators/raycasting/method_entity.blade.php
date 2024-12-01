<div class="card mb-3">
    <div class="card-header bg-secondary text-light">
        <h5 class="card-title mb-0">Entity commands</h5>
    </div>
    <div class="card-body">
        <p>Specify the commands you wish to run when the <strong>entity</strong> raycasting succeeds.</p>

        <p>The entity that was found can be targeted with <code>@s</code> while the execution position is at the hit position. The position of the hit entity can be targeted with <code>execute at @s</code>.</p>

        <textarea name="commands[entity_found]" v-model="form.commands.entity_found" id="commandsEntityFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say Entity found."></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.entity_found' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.entity_found'][0] }}
            @endverbatim
        </div>
    </div>
</div>
