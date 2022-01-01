<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>
                        Available Faction Characters
                    </v-card-title>
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
                            <draggable class="draggable" :list="characters" group="squad" tag="tbody">
                                <tr v-for="character in characters" :key="character.id">
                                    <td>{{ character.name }}</td>
                                    <td>{{ character.last_name }}</td>
                                </tr>
                            </draggable>
                        </template>
                    </v-simple-table>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="8">
                <v-card class="indigo">
                    <v-card-title class="white--text">
                        {{ squad.faction.name }}'s {{ squad.name }} Squad
                    </v-card-title>
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
                            <draggable class="draggable" :list="squad.characters" group="squad" tag="tbody">
                                <tr v-for="character in squad.characters" :key="character.id">
                                    <td>{{ character.name }}</td>
                                    <td>{{ character.last_name }}</td>
                                </tr>
                            </draggable>
                        </template>
                    </v-simple-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
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
