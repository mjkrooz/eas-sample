<div class="card">
    <div class="card-header bg-secondary text-light">
        <h5 class="card-title mb-0">Block commands</h5>
    </div>
    <div class="card-body">
        <p>Specify the commands you wish to run when the <strong>block</strong> raycasting succeeds.</p>

        <p>The execution position is at the block that was found, such that writing <code>setblock ~ ~ ~ minecraft:air</code> will delete the block.</p>

        <textarea name="commands[block_found]" v-model="form.commands.block_found" id="commandsBlockFound" rows="5" class="form-control bg-light text-dark text-monospace" placeholder="say Block found."></textarea>
        <div class="alert alert-warning" role="alert" v-if="'commands.block_found' in state.errors" v-cloak>
            @verbatim
                {{ state.errors['commands.block_found'][0] }}
            @endverbatim
        </div>
    </div>
</div>
