<template>
    <div class="container-fluid">
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Squads</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <squad-card-component v-for="squad in squads" v-bind:key="squad.id"
                                                      v-bind:squad="squad"
                                                      v-on:destroy-squad="destroySquad"></squad-card-component>
                            </div>
                            <div class="col-6">
                                <faction-characters-component v-if="faction.id"
                                                              v-bind:faction="faction"></faction-characters-component>
                            </div>
                        </div>
                        <new-squad-form-component v-on:store-squad="storeSquad"></new-squad-form-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import NewSquadFormComponent from "../squads/NewSquadFormComponent";
    import SquadCardComponent from "../squads/SquadCardComponent";
    import FactionCharactersComponent from "../faction/FactionCharactersComponent";

    export default {
        name: 'faction-component',
        components: {
            "faction-characters-component": FactionCharactersComponent,
            "new-squad-form-component": NewSquadFormComponent,
            "squad-card-component": SquadCardComponent
        },
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                faction: {},
                squads: {}
            };
        },
        methods: {
            async fetchFaction() {
                try {
                    let result = await axios.get('/factions/' + this.id);
                    this.faction = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
            async fetchSquads() {
                try {
                    let result = await axios.get('/squads');
                    this.squads = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
            async storeSquad(squad) {
                try {
                    await axios.post('/squads', squad);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }
            },
            async updateSquad(squad) {
                try {
                    await axios.post('/squads/' + squad.id, squad);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }
            },
            async destroySquad(squad) {
                try {
                    await axios.delete('/squads/' + squad.id, squad);
                    this.fetchSquads();
                } catch (error) {
                    console.error(error);
                }
            }
        },
        mounted() {
            console.log('Squads Component mounted');
            this.fetchFaction();
            this.fetchSquads();
        }
    }
</script>
