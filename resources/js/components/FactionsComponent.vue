<template>

    <div class="card">
        <div class="card-header">Factions</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="faction in factions.data">
                    <td>{{faction.id}}</td>
                    <td>{{faction.name}}</td>
                    <td>
                        <form :action="'/factions/'+faction.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="PUT">
                            <button v-on:click.prevent="updateFaction(faction.id)" class="btn btn-sm btn-outline-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/factions/'+faction.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button v-on:click.prevent="destroyFaction(faction.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_faction_name">Create new Faction</label>
            <form action="/factions" method="POST" class="form-inline">
                <input v-model="new_faction_name" placeholder="New faction's name" class="form-control form-control-sm mr-2" id="new_faction_name">
                <button v-on:click.prevent="storeFaction()" class="btn btn-sm btn-success">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'factions-component',
        data() {
            return {
                factions: {},
                new_faction_name: ''
            };
        },
        methods: {

            async fetchFactions() {
                try {
                    this.factions = await axios.get('/factions');
                } catch (error) {
                    console.error(error);
                }
            },

            async storeFaction() {

                let params = {
                    name: this.new_faction_name
                };

                try {
                    this.factions = await axios.post('/factions', params);
                    this.new_faction_name = '';
                    this.fetchFactions();
                } catch (error) {
                    console.error(error);
                }

            },

            async updateFaction(id) {

                let params = {
                    id: id
                };

                try {
                    this.factions = await axios.post('/factions/'+id, params);
                    this.fetchFactions();
                } catch (error) {
                    console.error(error);
                }

            },

            async destroyFaction(id) {

                let params = {
                    id: id
                };

                try {
                    this.factions = await axios.delete('/factions/'+id, params);
                    this.fetchFactions();
                } catch (error) {
                    console.error(error);
                }

            }

        },
        mounted() {
            console.log('Factions Component mounted');
            this.fetchFactions();
        }
    }
</script>
