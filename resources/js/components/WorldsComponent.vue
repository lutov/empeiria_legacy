<template>
    <div>
        <div class="card-deck">
            <world-card-component v-for="world in worlds.data" v-bind:key="world.id"
                                  v-bind:world="world"></world-card-component>
        </div>
        <new-world-form-component v-bind:name="new_world_name"></new-world-form-component>
    </div>
</template>

<script>
    import WorldCardComponent from "./world/WorldCardComponent";
    import NewWorldFormComponent from "./world/NewWorldFormComponent";

    export default {
        name: "WorldsComponent",
        components: {
            'world-card-component': WorldCardComponent,
            'new-world-form-component': NewWorldFormComponent,
        },
        data() {
            return {
                worlds: {},
                new_world_name: ''
            };
        },
        methods: {
            async fetchWorlds() {
                try {
                    this.worlds = await axios.get('/worlds');
                } catch (error) {
                    console.error(error);
                }
            },
            async updateWorld(id) {
                let params = {
                    id: id
                };
                try {
                    this.worlds = await axios.post('/worlds/' + id, params);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            },
            async destroyWorld(id) {
                let params = {
                    id: id
                };
                try {
                    this.worlds = await axios.delete('/worlds/' + id, params);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            },
            async storeWorld() {
                let params = {
                    name: this.new_world_name
                };
                try {
                    this.worlds = await axios.post('/worlds', params);
                    this.new_world_name = '';
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

<style scoped>

</style>
