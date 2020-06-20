<template>

    <div class="card">
        <div class="card-header">Squads</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="squad in squads.data">
                    <td>{{squad.id}}</td>
                    <td>{{squad.name}}</td>
                    <td>
                        <form :action="'/squads/'+squad.id" method="POST" class="form-inline">
                            <button v-on:click.prevent="updateSquad(squad.id)" class="btn btn-sm btn-outline-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/squads/'+squad.id" method="POST" class="form-inline">
                            <button v-on:click.prevent="deleteSquad(squad.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_squad_name">Create new Squad</label>
            <form action="/squads" method="POST" class="form-inline">
                <input v-model="new_squad_name" placeholder="New squad's name" class="form-control form-control-sm mr-2" id="new_squad_name">
                <button v-on:click.prevent="createSquad()" class="btn btn-sm btn-success">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'squads-component',
        data() {
            return {
                squads: {},
                new_squad_name: ''
            };
        },
        methods: {

            async fetchSquads() {
                try {
                    this.squads = await axios.get('/squads');
                } catch (error) {
                    console.error(error);
                }
            },

            async createSquad() {

                let params = {
                    name: this.new_squad_name
                };

                try {
                    this.squads = await axios.post('/squads', params);
                    this.new_squad_name = '';
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }

            },

            async updateSquad(id) {

                let params = {
                    id: id
                };

                try {
                    this.squads = await axios.post('/squads/'+id, params);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }

            },

            async deleteSquad(id) {

                let params = {
                    id: id
                };

                try {
                    this.squads = await axios.delete('/squads/'+id, params);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }

            }

        },
        mounted() {
            console.log('Squads Component mounted');
            this.fetchSquads();
        }
    }
</script>
