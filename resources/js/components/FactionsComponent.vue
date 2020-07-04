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
                        <form :action="'/factions/'+faction.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-outline-warning"
                                    v-on:click.prevent="updateFaction(faction.id)">Edit
                            </button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/factions/'+faction.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger"
                                    v-on:click.prevent="destroyFaction(faction.id)">Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_faction_name">Create new Faction</label>
            <form action="/factions" class="form-inline" method="POST">
                <input class="form-control form-control-sm mr-2" id="new_faction_name"
                       placeholder="New faction's name" v-model="new_faction_name">
                <button class="btn btn-sm btn-success" v-on:click.prevent="storeFaction()">Create</button>
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
                    this.factions = await axios.post('/factions/' + id, params);
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
                    this.factions = await axios.delete('/factions/' + id, params);
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
