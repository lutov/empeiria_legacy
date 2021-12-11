<template>

    <div class="card">
        <div class="card-header">Characters</div>

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="character in characters.data">
                    <td>{{character.id}}</td>
                    <td>{{character.name}}</td>
                    <td>
                        <form :action="'/characters/'+character.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-outline-warning"
                                    v-on:click.prevent="updateCharacter(character.id)">Edit
                            </button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/characters/'+character.id" class="form-inline" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger"
                                    v-on:click.prevent="destroyCharacter(character.id)">Delete
                            </button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_character_name">Create new Character</label>
            <form action="/characters" class="form-inline" method="POST">
                <input class="form-control form-control-sm mr-2" id="new_character_name"
                       placeholder="New character's name" v-model="new_character_name">
                <button class="btn btn-sm btn-success" v-on:click.prevent="storeCharacter()">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'characters-component',
        data() {
            return {
                api: '/api/characters',
                characters: {},
                new_character_name: ''
            };
        },
        methods: {

            async fetchCharacters() {
                try {
                    this.characters = await axios.get(this.api);
                } catch (error) {
                    console.error(error);
                }
            },

            async storeCharacter() {

                let params = {
                    name: this.new_character_name
                };

                try {
                    this.characters = await axios.post(this.api, params);
                    this.new_character_name = '';
                    this.fetchCharacters();
                } catch (error) {
                    console.error(error);
                }

            },

            async updateCharacter(id) {

                let params = {
                    id: id
                };

                try {
                    this.characters = await axios.post(this.api + id, params);
                    this.fetchCharacters();
                } catch (error) {
                    console.error(error);
                }

            },

            async destroyCharacter(id) {

                let params = {
                    id: id
                };

                try {
                    this.characters = await axios.delete(this.api + id, params);
                    this.fetchCharacters();
                } catch (error) {
                    console.error(error);
                }

            }

        },
        mounted() {
            console.log('Characters Component mounted');
            this.fetchCharacters();
        }
    }
</script>
