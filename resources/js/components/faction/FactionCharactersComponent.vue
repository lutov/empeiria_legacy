<template>
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">Faction Characters</h5>
            <div class="row">
                <character-card-component v-for="character in characters" v-bind:key="character.id"
                                          v-bind:character="character"></character-card-component>
            </div>
        </div>
    </div>
</template>

<script>
    import CharacterCardComponent from "../characters/CharacterCardComponent";

    export default {
        name: "faction-characters-component",
        components: {
            "character-card-component": CharacterCardComponent
        },
        props: {
            faction: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                characters: {},
            };
        },
        methods: {
            async fetchCharacters() {
                try {
                    let result = await axios.get('/factions/' + this.faction.id + '/characters?no_squad=true');
                    this.characters = result.data;
                } catch (error) {
                    console.error(error);
                }
            }
        },
        mounted() {
            this.fetchCharacters();
        }
    }
</script>

<style scoped>

</style>
