<template>
    <div>
        <div class="card-deck">
            <world-card-component v-for="world in worlds" v-bind:key="world.id"
                                  v-bind:world="world"></world-card-component>
        </div>
        <new-world-form-component v-on:store-world="storeWorld"></new-world-form-component>
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
            };
        },
        methods: {
            async fetchWorlds() {
                try {
                    let result = await axios.get('/worlds');
                    this.worlds = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
            async updateWorld(id) {
                let params = {
                    id: id
                };
                try {
                    await axios.post('/worlds/' + id, params);
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
                    await axios.delete('/worlds/' + id, params);
                    this.fetchWorlds();
                } catch (error) {
                    console.error(error);
                }
            },
            async storeWorld(world) {
                try {
                    await axios.post('/worlds', world);
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
