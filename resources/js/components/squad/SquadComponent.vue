<template>

    <div class="card">
        <div class="card-header">Squad {{ id }}</div>

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
                        <form :action="'/squads/characters/detach'" class="form-inline" method="POST">
                            <button class="btn btn-sm btn-outline-danger" v-on:click.prevent="detachCharacters([character.id])">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_characters">Add Characters</label>
            <form :action="'/squads/characters/attach'" method="POST">
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
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                api: {
                    characters: '/api/characters',
                    squad: '/api/squads/' + this.id
                },
                squad: {},
                characters: {}
            };
        },
        methods: {
            async fetchCharacters() {
                try {
                    axios.get(this.api.characters).then(response => this.characters = response.data);
                } catch (error) {
                    console.error(error);
                }
            },
            async fetchSquad() {
                try {
                    axios.get(this.api.squad).then(response => this.squad = response.data);
                } catch (error) {
                    console.error(error);
                }
            },
        },
        mounted() {
            console.log('Squad Component mounted');
            this.fetchCharacters();
            this.fetchSquad();
        }
    }
</script>
