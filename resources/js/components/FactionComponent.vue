<template>

    <div class="card">
        <div class="card-header">Faction</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>
    export default {
        name: 'faction-component',
        data() {
            return {
                loadFaction: {}
            };
        },
        methods: {

        },
        mounted() {
            console.log('Faction Component mounted');
        }
    }
</script>
