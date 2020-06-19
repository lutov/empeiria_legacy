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
                </tr>
                </tbody>
            </table>

        </div>
    </div>

</template>

<script>
    export default {
        name: 'characters-component',
        data() {
            return {
                characters: {}
            };
        },
        methods: {

            async fetchCharacters() {
                try {
                    this.characters = await axios.get('/characters');
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
