<template>
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{squad.name}} [{{squad.id}}]</h5>
            <div class="row">
                <character-card-component v-for="character in characters" v-bind:key="character.id"
                                          v-bind:character="character"></character-card-component>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="Squad Actions">
                <button type="button" class="btn btn-danger" v-on:click.prevent="$emit('destroy-squad', squad)">
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import CharacterCardComponent from "../characters/CharacterCardComponent";

    export default {
        name: "squad-card-component",
        components: {
            "character-card-component": CharacterCardComponent
        },
        props: {
            squad: {
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
                    let result = await axios.get('/squads/' + this.squad.id + '/characters');
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
