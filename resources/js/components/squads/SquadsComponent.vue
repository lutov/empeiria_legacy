<template>
    <div class="container-fluid">
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Squads</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
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
                                            <form :action="'/squads/'+squad.id" class="form-inline" method="POST">
                                                <input name="_method" type="hidden" value="PUT">
                                                <button class="btn btn-sm btn-outline-warning"
                                                        v-on:click.prevent="updateSquad(squad.id)">
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form :action="'/squads/'+squad.id" class="form-inline" method="POST">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-sm btn-outline-danger"
                                                        v-on:click.prevent="destroySquad(squad.id)">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>

                        <label for="new_squad_name">Create new Squad</label>
                        <form action="/squads" class="form-inline" method="POST">
                            <input class="form-control form-control-sm mr-2" id="new_squad_name"
                                   placeholder="New squad's name"
                                   v-model="new_squad_name">
                            <button class="btn btn-sm btn-success" v-on:click.prevent="storeSquad()">Create</button>
                        </form>

                    </div>
                </div>
            </div>
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

            async storeSquad() {

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
                    this.squads = await axios.post('/squads/' + id, params);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }

            },

            async destroySquad(id) {

                let params = {
                    id: id
                };

                try {
                    this.squads = await axios.delete('/squads/' + id, params);
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
