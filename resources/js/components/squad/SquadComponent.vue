<template>

    <div class="card">
        <div class="card-header">Squad {{squadId}}</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="character in squadCharacters.data">
                    <td>{{character.id}}</td>
                    <td>{{character.name}}</td>
                    <td>
                        <form :action="'/squads/'+squadId+'/characters/detach'" class="form-inline" method="POST">
                            <button class="btn btn-sm btn-outline-danger" v-on:click.prevent="detachCharacters([character.id])">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_characters">Add Characters</label>
            <form :action="'/squads/'+squadId+'/characters/attach'" method="POST">
                <select :multiple="true" class="form-control form-control-sm mr-2" id="new_characters" v-model="newCharacters">
                    <option :value="character.id" v-for="character in characters.data">{{character.name}}</option>
                </select>
                <button class="btn btn-sm btn-success" v-on:click.prevent="attachCharacters()">Add</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'squad-component',
        data() {
            return {
                squadId: 1,
                characters: {},
                squadCharacters: {},
                newCharacters: []
            };
        },
        methods: {

            async fetchCharacters() {
                try {
                    this.characters = await axios.get('/characters');
                } catch (error) {
                    console.error(error);
                }
            },

            async fetchSquadCharacters() {
                try {
                    this.squadCharacters = await axios.get('/squads/' + this.squadId + '/characters');
                } catch (error) {
                    console.error(error);
                }
            },

            async attachCharacters() {
                let params = {
                    characters: this.newCharacters
                };
                try {
                    this.characters = await axios.post('/squads/' + this.squadId + '/characters/attach', params);
                    this.fetchSquadCharacters();
                    this.newCharacters = [];
                    this.fetchCharacters();
                } catch (error) {
                    console.error(error);
                }
            },

            async detachCharacters(characters) {
                let params = {
                    characters: characters
                };
                try {
                    this.characters = await axios.post('/squads/' + this.squadId + '/characters/detach', params);
                    this.fetchSquadCharacters();
                    this.newCharacters = [];
                    this.fetchCharacters();
                } catch (error) {
                    console.error(error);
                }
            }

        },
        mounted() {
            console.log('Squad Component mounted');
            this.fetchCharacters();
            this.fetchSquadCharacters();
        }
    }
</script>
