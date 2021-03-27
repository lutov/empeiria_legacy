<template>
    <div class="world">
        <div class="world-header">World {{worldId}}</div>
        <world-map-component v-bind:world="world"></world-map-component>
    </div>
</template>

<script>
    import WorldMapComponent from "./WorldMapComponent";

    export default {
        name: 'world-component',
        components: {
            'world-map-component': WorldMapComponent
        },
        props: {
            worldId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                world: {}
            };
        },
        methods: {
            async fetchWorld() {
                try {
                    this.world = await axios.get('/worlds/' + this.worldId);
                } catch (error) {
                    console.error(error);
                }
            }
        },
        mounted() {
            console.log('World Component mounted');
            this.fetchWorld();
        }
    }
</script>

<style>


</style>
