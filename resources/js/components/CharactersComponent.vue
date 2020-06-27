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
                        <form :action="'/characters/'+character.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="PUT">
                            <button v-on:click.prevent="updateCharacter(character.id)" class="btn btn-sm btn-outline-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form :action="'/characters/'+character.id" method="POST" class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button v-on:click.prevent="destroyCharacter(character.id)" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <label for="new_character_name">Create new Character</label>
            <form action="/characters" method="POST" class="form-inline">
                <input v-model="new_character_name" placeholder="New character's name" class="form-control form-control-sm mr-2" id="new_character_name">
                <button v-on:click.prevent="storeCharacter()" class="btn btn-sm btn-success">Create</button>
            </form>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'characters-component',
        data() {
            return {
                characters: {},
                new_character_name: ''
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

            async storeCharacter() {

                let params = {
                    name: this.new_character_name
                };

                try {
                    this.characters = await axios.post('/characters', params);
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
                    this.characters = await axios.post('/characters/'+id, params);
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
                    this.characters = await axios.delete('/characters/'+id, params);
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
