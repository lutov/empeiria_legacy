<template>
    <div class="container-fluid">
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <component v-bind:is="currentComponent" v-on:play-world="playWorld"
                           v-bind:worldId="world.id"></component>
            </div>
        </div>
    </div>
</template>

<script>
    import WorldsComponent from "./WorldsComponent";
    import WorldComponent from "./world/WorldComponent";

    export default {
        name: "GameComponent",
        components: {
            'worlds-component': WorldsComponent,
            'world-component': WorldComponent
        },
        data() {
            return {
                currentComponent: 'worlds-component',
                worlds: {},
                world: {}
            };
        },
        methods: {
            playWorld(world) {
                this.world = world;
                this.currentComponent = 'world-component';
            }
        }
    }
</script>

<style scoped>

</style>
