<!-- Modal -->
<div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateModalLabel">Generate raycasting data pack</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Use the following command to activate the raycast:</p>

                <div class="input-group">
                    <textarea rows="1" ref="activationCommand" v-on:focus="$event.target.select()" class="form-control bg-light text-dark border text-monospace" style="overflow-x: scroll;overflow-y: hidden;resize: none;overflow-wrap: normal;white-space: pre;" readonly>execute as &lt;shooter&gt; at &commat;s anchored eyes positioned ^ ^ ^ anchored feet run function vdv_raycast:start_ray</textarea>
                    <div class="input-group-append">
                        <button type="button" id="copyActivationCommandButton" v-on:click="generate().copyActivationCommand()" class="btn btn-outline-light text-dark btn-sm border px-3" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fas fa-copy"></i></button>
                    </div>
                </div>

                <div class="text-center p-3 mt-3">
                    <div class="btn-group">
                        <button type="button" id="copyLecternButton" v-on:click="generate().copyLecternSource()" class="btn btn-light btn-ldg py-3" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fas fa-copy mr-3"></i>Lectern Source</button>
                        <button type="button" v-on:click="generate().download()" class="btn btn-primary btn-lg py-3"><i class="fas fa-download mr-3"></i>Download Data Pack</button>
                    </div>
                </div>

                <div class="d-nonfe">
                    <hr>

                    <p><strong>Lectern source:</strong></p>

                    <textarea id="lecternSource" v-model="data.lectern" v-on:focus="$event.target.select()" ref="lectern" rows="8" class="form-control bg-light text-dark text-monospace mb-0" readonly></textarea>
                </div>

                <div class="modal-footer">
                    <a href="https://github.com/mcbeet/lectern" target="_blank">Lectern on GitHub <i class="fas fa-external-link-alt fa-sm"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
