<template>

    <div class="card">
        <div class="card-header">Worlds</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="world in worlds.data">
                    <td>{{world.id}}</td>
                    <td>{{world.name}}</td>
                    <td>
                        <form :action="'/worlds/'+world.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-outline-warning" v-on:click.prevent="updateWorld(world.id)">
                                Edit
                            </button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/worlds/'+world.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger" v-on:click.prevent="destroyWorld(world.id)">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_world_name">Create new World</label>
            <form action="/worlds" class="form-inline" method="POST">
                <input class="form-control form-control-sm mr-2" id="new_world_name" placeholder="New world's name"
                       v-model="new_world_name">
                <button class="btn btn-sm btn-success" v-on:click.prevent="storeWorld()">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'worlds-component',
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

            }

        },
        mounted() {
            console.log('Worlds Component mounted');
            this.fetchWorlds();
        }
    }
</script>
