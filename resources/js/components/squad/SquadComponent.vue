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
                            <draggable class="draggable" :list="characters" group="squad" tag="tbody" @end="end">
                                <tr v-for="character in characters" :key="character.squad_order">
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
                    <v-card-title class="white--text" v-if="squad.faction">
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
                            <draggable class="draggable" :list="squad.characters" group="squad" tag="tbody"
                                       @sort="sort">
                                <tr v-for="(character, index) in squad.characters" :key="index">
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
                squad: {},
                characters: []
            };
        },
        methods: {
            async fetchCharacters() {
                try {
                    let params = {"without": 'squad'};
                    axios.get(this.api.characters, {params}).then(response => this.characters = response.data);
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
            change: function (evt) {
                //console.log(evt);
            },
            //start, end, add, update, sort, remove all get the same
            start: function (evt) {
                //console.log(evt.item._underlying_vm_);
            },
            sort: function (evt) {
                //console.log(evt);
                let oldCharacter = this.squad.characters[evt.oldIndex];
                oldCharacter.squad_order = evt.oldIndex + 1;
                let character = this.squad.characters[evt.newIndex];
                character.squad_order = evt.newIndex + 1;
                axios.put(this.api.characters + '/' + oldCharacter.id, oldCharacter).then(response => {
                    axios.put(this.api.characters + '/' + character.id, character).then(response => {
                        this.fetchSquad();
                    }).catch(error => console.log(error));
                }).catch(error => console.log(error));
            },
            end: function (evt) {
                //console.log(evt.item._underlying_vm_);
                //console.log(evt.oldIndex);
                //console.log(evt.from);
                //console.log(evt.newIndex);
                //console.log(evt.to);
                let character = evt.item._underlying_vm_;
                character.squad_id = this.squad.id;
                character.squad_order = evt.newIndex + 1;
                axios.put(this.api.characters + '/' + character.id, character).then(response => {
                    this.fetchCharacters();
                    this.fetchSquad();
                }).catch(error => console.log(error));
            },
            move: function (evt, originalEvent) {
                //console.log(evt)
                //console.log(originalEvent) //Mouse position
            }

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
