<template>
    <div class="card">
        <div class="card-header">Worlds</div>
        <div class="card-body">
            <div class="card-deck">
                <world-card-component v-for="world in worlds" v-bind:key="world.id"
                                      v-bind:world="world"
                                      v-on:update-world="updateWorld"
                                      v-on:destroy-world="destroyWorld"></world-card-component>
            </div>
            <new-world-form-component v-on:store-world="storeWorld"></new-world-form-component>
        </div>
    </div>
</template>

<script>
    import WorldCardComponent from "./WorldCardComponent";
    import NewWorldFormComponent from "./NewWorldFormComponent";

    export default {
        name: "WorldsComponent",
        components: {
            'world-card-component': WorldCardComponent,
            'new-world-form-component': NewWorldFormComponent
        },
        data() {
            return {
                api: {
                    worlds: '/api/worlds'
                },
                worlds: {},
            };
        },
        methods: {
            async fetchWorlds() {
                try {
                    let result = await axios.get(this.api.worlds);
                    this.worlds = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
            async updateWorld(world) {
                try {
                    await axios.post(this.api.worlds + '/' + world.id, world);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            },
            async destroyWorld(world) {
                try {
                    await axios.delete(this.api.worlds + '/' + world.id, world);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            },
            async storeWorld(world) {
                try {
                    await axios.post(this.api.worlds, world);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            }
        },
        mounted() {
            console.log('Worlds Component mounted');
            this.fetchWorlds();
        }
    }
</script>

<style>

</style>
