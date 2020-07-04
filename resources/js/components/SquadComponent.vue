<template>

    <div class="card">
        <div class="card-header">Squad</div>

        <div class="card-body">
            I'm an example component.
        </div>
    </div>

</template>

<script>
    export default {
        name: 'squad-component',
        data() {
            return {
                loadSquad: {}
            };
        },
        methods: {},
        mounted() {
            console.log('Squad Component mounted');
        }
    }
</script>
