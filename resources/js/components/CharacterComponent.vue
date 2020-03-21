<template>

    <div class="card">
        <div class="card-header">Character</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>
    export default {
        name: 'character-component',
        data() {
            return {
                loadCharacter: {}
            };
        },
        methods: {

        },
        mounted() {
            console.log('Character Component mounted');
        }
    }
</script>
