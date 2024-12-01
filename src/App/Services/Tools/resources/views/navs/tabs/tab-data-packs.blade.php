<div class="text-center">
    <div class="row">
        <div class="col-10">
            <div class="custom-file">
                <input type="file" class="custom-file-input rounded-0" id="customFile" disabled>
                <label class="custom-file-label text-left text-dark bg-light rounded-0 shadow-sm text-muted" for="customFile">Select data pack to evaluate (coming soon&trade;)</label>
            </div>
        </div>
        <div class="col-2">
            <input type="submit" class="btn btn-light shadow-sm btn-block" value="Evaluate">
        </div>
    </div>
</div>
<div class="mt-5 mb-4">
    <div class="card shadow-sm">

        <div class="card-header bg-success">
            <span class="h5 text-monospace text-light"><i class="fas fa-chess-queen"></i> Raycasting Generator</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="{{ route('tools:data-packs/raycasting-generator') }}" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a raycasting data pack.
            </a>
        </div>
    </div>
</div>
<div class="card-columns mt-5 mb-4 sb-tool-belt sb-data-packs">
    <div class="card shadow-sm">

        <div class="card-header">
            <span class="h5 text-monospace text-light"><i class="fas fa-trophy"></i> Advancements</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="#!" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a new advancement
            </a>
            <a href="{{ route('tools:data-packs/advancement-evaluator') }}"
               class="btn btn-block sb-tool-evaluator rounded-0 bg-info text-dark p-3 m-0">
                <span class="text-uppercase font-weight-bold">Evaluate</span><br>Debug an advancement
            </a>
        </div>
    </div>
    <div class="card shadow-sm">

        <div class="card-header">
            <span class="h5 text-monospace text-light"><i class="fas fa-gem"></i> Loot tables</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="#!" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a new loot table
            </a>
            <a href="{{ route('tools:data-packs/loot-table-evaluator') }}" class="btn btn-block sb-tool-evaluator rounded-0 bg-info text-dark p-3 m-0">
                <span class="text-uppercase font-weight-bold">Evaluate</span><br>Debug a loot table
            </a>
        </div>
    </div>
    <div class="card shadow-sm">

        <div class="card-header">
            <span class="h5 text-monospace text-light"><i class="fas fa-cubes"></i> pack.mcmeta</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="#!" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a new <code>pack.mcmeta</code>
            </a>
            <a href="{{ route('tools:data-packs/packmcmeta-evaluator') }}" class="btn btn-block sb-tool-evaluator rounded-0 bg-info text-dark p-3 m-0">
                <span class="text-uppercase font-weight-bold">Evaluate</span><br>Debug a <code>pack.mcmeta</code>
            </a>
        </div>
    </div>
</div>
<div class="card-columns mb-3 sb-tool-belt sb-data-packs">
    <div class="card shadow-sm">

        <div class="card-header">
            <span class="h5 text-monospace text-light"><i class="fas fa-exchange-alt"></i> Recipes</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="#!" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a new recipe
            </a>
            <a href="{{ route('tools:data-packs/recipe-evaluator') }}" class="btn btn-block sb-tool-evaluator rounded-0 bg-info text-dark p-3 m-0">
                <span class="text-uppercase font-weight-bold">Evaluate</span><br>Debug a recipe
            </a>
        </div>
    </div>
    <div class="card shadow-sm">

        <div class="card-header">
            <span class="h5 text-monospace text-light"><i class="fas fa-object-group"></i> Tags</span>
        </div>
        <div class="card-footer border-0 p-0">
            <a href="#!" class="btn btn-block rounded-0 bg-light text-dark p-3">
                <span class="text-uppercase font-weight-bold">Generate</span><br>Create a new tag
            </a>
            <a href="{{ route('tools:data-packs/tag-evaluator') }}" class="btn btn-block sb-tool-evaluator rounded-0 bg-info text-dark p-3 m-0">
                <span class="text-uppercase font-weight-bold">Evaluate</span><br>Debug a tag
            </a>
        </div>
    </div>
</div>
