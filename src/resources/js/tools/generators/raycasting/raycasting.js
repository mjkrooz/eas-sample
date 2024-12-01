/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('generator', require('./components/RaycastingGenerator.vue').default);
// Vue.component('detection-method', require('./components/DetectionMethod.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#raycastingGenerator',
    data() {
        return {
            lingual_form: ' ',
            form: {
                options: {
                    namespace: 'vdv_raycast',
                    subfolder: '',
                    objective: 'vdvcasttemp',
                    create_objective: true,
                    tag: 'vdvray'
                },
                detection: {
                    method: 'entity',
                    max_distance: 10,
                    step_distance: 0.1,
                    units: 'blocks',
                    block: {
                        blocks: [],
                        inverted: false,
                    },
                    entity: {
                        entities: [],
                    }
                },
                commands: {
                    entity_found: '',
                    block_found: '',
                    pre_raycast: '',
                    post_raycast: '',
                    step: '',
                    failed: ''
                }
            },
            state: {
                submitting: false,
                detection: {
                    tab_being_viewed: 'entity',
                    block: {
                        blocks_inverted_radio: false,
                        blocks_before: [],
                        inverted_before: false
                    },
                    entity: {
                        non_air: false
                    }
                },
                errors: {

                }
            },
            data: {
                lectern: '',
                zip: '',
                download_uri: '#!',
                download_name: 'vdvman1_raycast.zip'
            }
        }
    },
    computed: {
        total_steps() {

            let step = this.form.detection.step_distance;
            let max = this.form.detection.max_distance;

            if (this.form.detection.units === 'blocks') {

                return Math.ceil(max / ((step > 0) ? step : 0.1));
            } else {

                return max;
            }
        }
    },
    beforeMount() {
        //this.detection.travel_distance = document.getElementById('detectionMaxDistance').value;
    },
    methods: {

        /**
         * Methods specific to the "detection" tab.
         *
         * @returns {{calculateTravelDistance: calculateTravelDistance, setBlocks: setBlocks, setBlocksInverted: setBlocksInverted, selectMethod: selectMethod, toggleNonAir: toggleNonAir, switchTab: switchTab}}
         */

        detect() {
            return {

                /**
                 * Changes the value of the travel distance based on the travel type.
                 */

                calculateTravelDistance: () => {

                    switch (this.form.detection.units) {

                        case 'steps':
                            this.form.detection.max_distance = this.form.detection.max_distance * 10;
                            break;
                        default:
                            this.form.detection.max_distance = Math.floor(this.form.detection.max_distance / 10);
                    }
                },

                /**
                 * Changes the type of detection method.
                 *
                 * @param type The ID of the method tab being switched to ('entity', 'block', 'both').
                 */

                selectMethod: (type) => {

                    this.form.detection.method = type;
                    this.detect().switchTab(type);
                    this.state.detection.tab_being_viewed = type;
                },

                /**
                 * Extra functions to run when switching the detection method tab.
                 *
                 * @param tab The ID of the method tab being switched to ('entity', 'block', 'both').
                 */

                switchTab: (tab) => {

                    // If the tab was switched while non_air was true, then toggleNonAir must be called.

                    if (tab !== 'both' && this.state.detection.entity.non_air) {

                        this.detect().toggleNonAir(false);
                        this.state.detection.entity.non_air = false;
                    }
                },

                /**
                 * Toggles the option to detect when any non-air block is found.
                 *
                 * @param switchTab Whether or not to also switch the method tab while toggling the option.
                 */

                toggleNonAir: (switchTab = true) => {

                    if (this.state.detection.entity.non_air) {

                        // Turn off the air check.

                        this.detect().setBlocks(this.state.detection.block.blocks_before, false);
                        this.detect().setBlocksInverted(this.state.detection.block.inverted_before);

                        // Switch tabs if needed.

                        if (switchTab) {

                            if (this.state.detection.tab_being_viewed === 'both') {

                                this.form.detection.method = 'both';
                            } else {

                                this.form.detection.method = 'entity';
                            }
                        }
                    } else {

                        // Show the "both" tab, remember the original data, and change it to inverted air.

                        this.form.detection.method = 'both';

                        this.state.detection.block.blocks_before = this.form.detection.block.blocks;
                        this.state.detection.block.inverted_before = this.form.detection.block.inverted;

                        this.detect().setBlocks(['minecraft:air', 'minecraft:cave_air', 'minecraft:void_air'], true); // TODO: use API to get air blocks.
                        this.detect().setBlocksInverted(true, true);
                    }
                },

                /**
                 * Fixes up the selectpicker input to include the supplied list of blocks.
                 *
                 * @param blocks The blocks to modify the form to use.
                 * @param disable Whether or not to disable the form.
                 */

                setBlocks: (blocks, disable) => {

                    //this.blocks = blocks;

                    $('#detectBlockList').attr('disabled', disable);
                    $('#detectBlockList').selectpicker('val', blocks);
                    $('#detectBlockList').selectpicker('refresh');
                },

                /**
                 * Marks the blocks to detect as being inverted, such that any blocks other than those selected will be
                 * the ones to detect.
                 *
                 * @param inverted Whether or not the block list is inverted.
                 * @param disable Whether or not to disable the selection for inversion.
                 */

                setBlocksInverted: (inverted = true, disable = false) => {

                    this.form.detection.block.inverted = inverted;
                    this.state.detection.block.blocks_inverted_radio = inverted;

                    let detectBlockInvertedA = document.getElementById('detectBlockInvertedA');
                    let detectBlockInvertedB = document.getElementById('detectBlockInvertedB');
                    detectBlockInvertedA.disabled = disable;
                    detectBlockInvertedB.disabled = disable;
                }
            };
        },

        /**
         * Functions dealing with errors.
         */

        errors() {
            return {

                hasErrors: () => {

                    return this.errors().hasOptionErrors() || this.errors().hasDetectionErrors() || this.errors().hasOptionalCommandErrors();
                },

                hasOptionErrors: () => {

                    return 'options.subfolder' in this.state.errors
                        || 'options.namespace' in this.state.errors
                        || 'options.objective' in this.state.errors
                        || 'options.create_objective' in this.state.errors
                        || 'options.tag' in this.state.errors;
                },

                hasDetectionErrors: () => {

                    return 'detection.method' in this.state.errors
                        || 'detection.max_distance' in this.state.errors
                        || 'detection.units' in this.state.errors
                        || 'detection.create_objective' in this.state.errors
                        || 'detection.block.blocks' in this.state.errors
                        || 'detection.block.inverted' in this.state.errors
                        || 'detection.entity.entities' in this.state.errors
                        || 'commands.block_found' in this.state.errors
                        || 'commands.entity_found' in this.state.errors;
                },

                hasOptionalCommandErrors: () => {

                    return 'commands.pre_raycast' in this.state.errors
                        || 'commands.post_raycast' in this.state.errors
                        || 'commands.step' in this.state.errors
                        || 'commands.failed' in this.state.errors;
                }
            }
        },

        /**
         * Functions to run once the generator is fully submitted.
         */

        generate() {
            return {

                submit: async () => {

                    // Set spinner on generate button.

                    this.state.submitting = true;
                    $('#raycastingGeneratorOriginalSubmit').attr('disabled', true);

                    // Compile the data and send it.

                    const body = this.form;
                    body.format = 'lectern';

                    const request = {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(body)
                    };

                    // Download the Lectern source. This will also determine if there are issues in the form.

                    const responseLectern = await fetch("/beta/api/v1/tools/data-packs/raycasting-generator", request);

                    // If the response was not ok, then fill in errors.

                    if (!responseLectern.ok) {

                        this.generate().pushErrors(await responseLectern.json());
                        this.state.submitting = false;
                        $('#raycastingGeneratorOriginalSubmit').attr('disabled', false);
                    } else {


                        // Otherwise, stop the spinner and open the modal.

                        this.state.errors = {};
                        this.data.lectern = await responseLectern.text();
                        this.state.submitting = false;
                        $('#generateModal').modal('show');
                        $('#raycastingGeneratorOriginalSubmit').attr('disabled', false);
                    }
                },

                pushErrors: (json) => {

                    this.state.errors = json.errors;
                },

                copyActivationCommand: () => {

                    this.$refs.activationCommand.focus();
                    document.execCommand('copy');

                    let btn = $('#copyActivationCommandButton');

                    btn.attr('title', 'Copied!');
                    btn.attr('data-original-title', 'Copied!');
                    btn.tooltip('update');
                    btn.tooltip('show');

                    // Update but don't show the change.

                    btn.attr('title', 'Copy to clipboard');
                    btn.attr('data-original-title', 'Copy to clipboard');
                    btn.tooltip('update');
                },

                copyLecternSource: () => {

                    this.$refs.lectern.focus();
                    document.execCommand('copy');

                    let btn = $('#copyLecternButton');

                    btn.tooltip();
                    btn.attr('title', 'Copied!');
                    btn.attr('data-original-title', 'Copied!');
                    btn.tooltip('update');
                    btn.tooltip('show');

                    // Update but don't show the change.

                    btn.attr('title', 'Copy to clipboard');
                    btn.attr('data-original-title', 'Copy to clipboard');
                    btn.tooltip('update');
                },

                download: () => {

                    $('#raycastingGeneratorForm').submit();
                    // Officially submit the form.
                    //alert('there it is');
                    //$('#detectBlockList').attr('disabled', false);
                }
            }
        },

        /**
         * Creates a human-readable sentence describing what the generated raycast will do.
         */

        generateLingualForm() {

            let blocks = (this.form.detection.units === 'blocks') ? this.form.detection.max_distance : Math.floor(this.form.detection.max_distance / 10);
            let form = 'When activated, the raycast will check up to ' + blocks + ' blocks away until it finds ';

            switch (this.form.detection.method) {

                case "entity":
                    form += 'an entity (e.g. ' + this.form.detection.entity.entities[0] + ').';
                    break;
                case 'block':
                    form += 'a block (e.g. ' + this.form.detection.block.blocks[0] + ').';
                    break;
                case 'both':
                    form += 'either an entity (e.g. ' + this.form.detection.entity.entities[0] + ') or a block (e.g. ' + this.form.detection.block.blocks[0] + ').';
                    break;
            }

            this.lingual_form = form;
        }
    },
    created() {
        setInterval(this.generateLingualForm, 500);
    }
});
