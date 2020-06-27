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
                        <form :action="'/worlds/'+world.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="PUT">
                            <button v-on:click.prevent="updateWorld(world.id)" class="btn btn-sm btn-outline-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/worlds/'+world.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button v-on:click.prevent="destroyWorld(world.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_world_name">Create new World</label>
            <form action="/worlds" method="POST" class="form-inline">
                <input v-model="new_world_name" placeholder="New world's name" class="form-control form-control-sm mr-2" id="new_world_name">
                <button v-on:click.prevent="storeWorld()" class="btn btn-sm btn-success">Create</button>
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
                    this.worlds = await axios.post('/worlds/'+id, params);
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
                    this.worlds = await axios.delete('/worlds/'+id, params);
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
