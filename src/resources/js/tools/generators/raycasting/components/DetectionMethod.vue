<script>
export default {
    name: "DetectionMethod",
    data() {
        return {
            method: 'entity',
            tabBeingViewed: 'entity',
            blocks: [],
            blocks_inverted: false,
            blocks_before_switch: [],
            blocks_inverted_before_switch: false,
            nonAirCheck: false,
        }
    },
    methods: {
        selectMethod(type) {

            this.method = type;
        },
        toggleNonAirCheck() {

            if (this.nonAirCheck) {

                //alert('it was on before toggling, so now it is off.');

                // Turn off the air check.
                // Show the relevant detection methods. If the user had selected "both" prior, it should show that.
                // It should also list the blocks the user selected before clicking that, as well as whether they chose
                // to invert the block selection.
                // Otherwise, it should show "entity". It is not possible for them to have been viewing "block" first.

                if (this.tabBeingViewed === 'both') {

                    // Do something to switch to the "both" tab.
                } else {

                    // Do something to switch to the "entity" tab.
                }

                // Do something to return the original data for the "block" tab.

                this.setBlocks(this.blocks_before_switch, false);
                this.blocks_inverted = this.blocks_inverted_before_switch;
            } else {

                // Show the "both" tab, remember the original data, and change it to inverted air.

                this.blocks_before_switch = this.blocks;
                this.blocks_inverted_before_switch = this.blocks_inverted;

                this.setBlocks(['minecraft:air', 'minecraft:cave_air', 'minecraft:void_air'], true);
                this.blocks_inverted = true;
            }
        },
        setNonAirCheck(selected) {

            this.nonAirCheck = selected;
        },
        setBlocks(blocks, disable) {

            this.blocks = blocks;

            $('#detectBlockList').attr('disabled', disable);
            $('#detectBlockList').selectpicker('val', blocks);
            $('#detectBlockList').selectpicker('hide');
            $('#detectBlockList').selectpicker('refresh');
        }
    }
}
</script>

<style scoped>

</style>
