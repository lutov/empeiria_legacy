<template>

    <v-card>
        <v-card>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">
                            Name
                        </th>
                        <th class="text-left">
                            Last Name
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <draggable class="draggable" :list="characters" group="squad">
                        <tr
                            v-for="character in characters"
                            :key="character.id"
                        >
                            <td>{{ character.name }}</td>
                            <td>{{ character.last_name }}</td>
                        </tr>
                    </draggable>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card>
        <v-card>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">
                            Name
                        </th>
                        <th class="text-left">
                            Last Name
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <draggable class="draggable" :list="squad.characters" group="squad">
                        <tr
                            v-for="character in squad.characters"
                            :key="character.id"
                        >
                            <td>{{ character.name }}</td>
                            <td>{{ character.last_name }}</td>
                        </tr>
                    </draggable>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card>
    </v-card>

</template>

<script>
    import draggable from 'vuedraggable';
    export default {
        components: {
            draggable,
        },
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
                squad: [],
                characters: []
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
<style scoped>
    .draggable {
        min-height: 5vh;
    }
</style>
