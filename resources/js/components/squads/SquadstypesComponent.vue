<template>

    <div class="card">
        <div class="card-header">Squads Types</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="squads_type in squads_types.data">
                    <td>{{squads_type.id}}</td>
                    <td>{{squads_type.name}}</td>
                    <td>
                        <form :action="'/squads_types/'+squads_type.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-outline-warning"
                                    v-on:click.prevent="updateSquadsType(squads_type.id)">Edit
                            </button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/squads_types/'+squads_type.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger"
                                    v-on:click.prevent="destroySquadsType(squads_type.id)">Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_squads_type_name">Create new Squads Type</label>
            <form action="/squads_types" class="form-inline" method="POST">
                <input class="form-control form-control-sm mr-2" id="new_squads_type_name"
                       placeholder="New squads type's name" v-model="new_squads_type_name">
                <button class="btn btn-sm btn-success" v-on:click.prevent="storeSquadsType()">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'squadstypes-component',
        data() {
            return {
                squads_types: {},
                new_squads_type_name: ''
            };
        },
        methods: {

            async fetchSquadsTypes() {
                try {
                    this.squads_types = await axios.get('/squads_types');
                } catch (error) {
                    console.error(error);
                }
            },

            async storeSquadsType() {

                let params = {
                    name: this.new_squads_type_name
                };

                try {
                    this.squads_types = await axios.post('/squads_types', params);
                    this.new_squads_type_name = '';
                    this.fetchSquadsTypes();
                } catch (error) {
                    console.error(error);
                }

            },

            async updateSquadsType(id) {

                let params = {
                    id: id
                };

                try {
                    this.squads_types = await axios.post('/squads_types/' + id, params);
                    this.fetchSquadsTypes();
                } catch (error) {
                    console.error(error);
                }

            },

            async destroySquadsType(id) {

                let params = {
                    id: id
                };

                try {
                    this.squads_types = await axios.delete('/squads_types/' + id, params);
                    this.fetchSquadsTypes();
                } catch (error) {
                    console.error(error);
                }

            }

        },
        mounted() {
            console.log('Squads Types Component mounted');
            this.fetchSquadsTypes();
        }
    }
</script>
