<template>
    <div class="container-fluid">
        <div class="row justify-content-center mb-4">
            <div class="col-6">
                <character-doll-component v-bind:character="character"></character-doll-component>
            </div>
            <div class="col-6">
                <character-inventory-component v-if="character.id"
                                               v-bind:character="character"></character-inventory-component>
            </div>
        </div>
    </div>
</template>

<script>
    import CharacterInventoryComponent from "./CharacterInventoryComponent";
    import CharacterDollComponent from "./CharacterDollComponent";

    export default {
        name: 'character-component',
        components: {
            "character-doll-component": CharacterDollComponent,
            "character-inventory-component": CharacterInventoryComponent
        },
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                character: {}
            };
        },
        methods: {
            async fetchCharacter() {
                try {
                    let result = await axios.get('/characters/' + this.id);
                    this.character = result.data;
                } catch (error) {
                    console.error(error);
                }
            },
        },
        mounted() {
            console.log('Character Component mounted');
            this.fetchCharacter();
        }
    }
</script>
